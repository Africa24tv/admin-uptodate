<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TacheController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taches = [];

        if (Gate::allows('list-taches'))
        {
            $taches = Tache::paginate(15);
        }

        if(Gate::allows('list-mes-taches'))
        {
            $taches = Auth::user()->taches()->latest()->paginate(10);
        }

        return view('taches.index', compact('taches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('taches.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $tache = Tache::create([
                'title' => $request->title,
                'level' => $request->level,
                'user_id' => Auth::user()->id,
                'body' => $request->resume,
            ]);

            $tache->acteurs()->attach($request->users);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de la tâche');
        }


        return redirect()->route('taches.index')->with('success', 'Tâche créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show(Tache $tache)
    {
        return view('taches.show', compact('tache'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tache = Tache::find($id);

        $users = User::all();

        return view('taches.edit', compact('tache', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tache = Tache::find($id);

        if (Gate::allows('edit-execution')) {
            $tache->update([
                'execution' => $request->execution,
            ]);

            return redirect()->route('taches.index')->with('success', 'Tâche en cours d\'exécution');
        }

        if(Gate::allows('create-tache'))
        {
            $tache->update([
                'title' => $request->title,
                'level' => $request->level,
                'body' => $request->resume,
                'execution' => $request->execution,
            ]);

            $tache->acteurs()->detach();

            $tache->acteurs()->attach($request->users);

            return redirect()->route('taches.index')->with('success', 'Tâche modifiée avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tache = Tache::find($id);

        $tache->acteurs()->detach();

        $tache->delete();

        return redirect()->route('taches.index')->with('success', 'Tâche supprimée avec succès');
    }
}
