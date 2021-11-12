<?php

namespace App\Http\Controllers\local;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Models\Type;
use Illuminate\Http\Request;

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
        $types = Type::all();
        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        return view('subjects.create', compact('types', 'categories'));
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
        $types = Type::all();
        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        return view('subjects.edit', compact('subject', 'types', 'categories'));
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
        try{
            $subject->update([
                'title' => $request->title,
                'type_id' => $request->type,
                'resume' => $request->resume,
            ]);
        }

        catch(\Exception $e)
        {
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
        try
        {
            $subject->delete();
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Impossible de supprimer ce sujet');
        }

        return redirect()->route('subjects.index');
    }

    public function categories()
    {
        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        return response()->json($categories);
    }

    public function subjects()
    {
        return response()->json(SubjectResource::collection(Subject::all()));
    }

    public function subjectArticles($id)
    {
        $subject = Subject::findOrFail($id);

        $articles = [];
        foreach($subject->posts as $post)
        {
            if($post->article && $post->status == 'publié')
            {
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
        $subjects = Subject::whereType_id(Type::whereTitle('programme')->first()->id)->get();

        $articles = [];
        foreach($subjects as $subject)
        {
            array_push($articles, $subject->posts->latest('created_at')->first());
        }

        return response()->json(ArticleResource::collection($articles));
    }
}
