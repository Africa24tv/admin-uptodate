<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\SubjectResource;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'categories', 'subjects', 'subjectArticles', 'programmesPresentations']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::latest()->paginate(15);

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $types = Type::all();
            $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

            return view('subjects.create', compact('types', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('types.index')->with('error', "Vueillez crée un type avant de crée un sujet !");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Subject::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'type_id' => $request->type,
            'resume' => $request->resume,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Le sujet a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        try {
            $types = Type::all();
            $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

            return view('subjects.edit', compact('subject', 'types', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('types.index')->with('error', "Vueillez crée un type avant de crée un sujet !");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        try {
            $subject->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'type_id' => $request->type,
                'resume' => $request->resume,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la modification du sujet');
        }

        return redirect()->route('subjects.index')->with('success', 'Sujet modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce sujet');
        }

        return redirect()->route('subjects.index');
    }

    public function categories()
    {
        try {
            $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

            return response()->json($categories);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération des catégories');
        }
    }

    public function subjects()
    {
        return response()->json(SubjectResource::collection(Subject::all()));
    }

    public function subjectArticles($id)
    {
        try {
            $subject = Subject::find($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Le sujet n\'existe pas'], 404);
        }

        $articles = [];
        foreach ($subject->posts as $post) {
            if ($post->article && $post->status == 'publié') {
                array_push($articles, $post->article);
            }
        }

        return response()->json([
            'subject' => new SubjectResource($subject),
            'articles' => ArticleResource::collection($articles),
        ]);
    }

    public function programmesPresentations()
    {
        try {
            $subjects = Subject::whereType_id(Type::whereTitle('programme')->first()->id)->get();

            $posts = [];
            foreach ($subjects as $subject) {
                array_push($posts, $subject->posts()->latest('created_at')->first());
            }

            $articles = [];
            foreach ($posts as $post) {
                if ($post->article && $post->status == 'publié') {
                    array_push($articles, $post->article);
                }
            }

            return response()->json(ArticleResource::collection($articles));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des articles']);
        }
    }

    public function regions()
    {
        try {
            $subjects = Subject::whereType_id(Type::whereTitle('region')->first()->id)
                ->when(
                    request('subject_slug'),
                    fn ($query) => $query->whereSlug(request('subject_slug'))
                )
                ->get();

            $posts = [];
            foreach ($subjects as $subject) {
                array_push($posts, $subject->posts()->latest('created_at')->first());
            }

            $articles = [];
            foreach ($posts as $post) {
                if ($post->article && $post->status == 'publié') {
                    array_push($articles, $post->article);
                }
            }

            return response()->json(ArticleResource::collection($articles));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des articles']);
        }
    }
}
