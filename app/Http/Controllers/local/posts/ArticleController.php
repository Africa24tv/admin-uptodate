<?php

namespace App\Http\Controllers\local\posts;

use App\Models\Post;
use App\Models\Type;
use App\Models\Article;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['articlesPubliers', 'article']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = [];

        if(Gate::allows('list-articles'))
        {
            $articles = Article::articlesEnvoyer()->latest('articles.created_at')->paginate(15);
        }

        if (Gate::allows('list-mes-articles'))
        {
            $articles = Article::userArticles(Auth::user())->latest('articles.created_at')->paginate(15);
        }

        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        // dd($articles);

        return view('posts.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $categories = Subject::all();


        return view('posts.articles.create', compact('subjects', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator = new PostController();

        try{
            $post = $creator->store($request);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

        try{
            Article::create([
                'id' => $post->id,
                'type' => $post->type,
                'body' => $request->content,
                'media_id' => $request->media,
            ]);
        }
        catch(\Exception $e)
        {
            $post->delete();

            return redirect()->route('articles.create')->with('error', 'Une erreur est survenue lors de la création de l\'article');
        }

        return redirect()->route('articles.index')->with('success', 'L\'article a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('posts.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $subjects = Subject::all();
        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        return view('posts.articles.edit', compact('article', 'subjects', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $updater = new PostController();

        $updater->update($request, $article->post);

        $article->update($request->all());

        return redirect()->route('articles.index')->with('success', 'L\'article a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $destroyer = new PostController();
        $destroyer->destroy(Post::find($article->id));

        return redirect()->route('articles.index')->with('success', 'L\'article a été supprimé avec succès');
    }

    protected function cleanImageInHtmlDoc($content)
    {
        $dom = new \DomDocument();

        @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {

            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);

            list($type, $data) = explode(',', $data);

            $data = base64_decode($data);

            $image_name = "/uploads/images/" . time() . $k . '.png';

            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');

            $img->setAttribute('src', $image_name);
        }

        return $dom->saveHTML();
    }

    public function articlesPubliers()
    {
        $publish_articles = [];
        $articles = Article::latest()->get();


        foreach($articles as $article)
        {
            if($article->post->status == 'publié')
            {
                array_push($publish_articles, $article);
            }
        }
        return response()->json(ArticleResource::collection($publish_articles));
    }

    public function article($id)
    {
        try
        {
            $article = Article::find($id);
            $other_posts = $article->post->subject->posts()->limit(4)->get();

            $articles = [];
            foreach($other_posts as $post)
            {
                if($post->article && $post->article->id != $article->id)
                {
                    $post->status == 'publié' ?
                    array_push($articles, $post->article)
                    :
                    null;
                }
            }
        }
        catch(\Exception $err)
        {
            return response(null);
        }

        // return response('okay');

        return response()->json([
            'article' => new ArticleResource($article),
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}
