<?php

namespace App\Http\Controllers\local;

use App\Http\Controllers\Controller;
use App\Http\Resources\BanerResource;
use App\Models\Baner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baners = Baner::latest()->paginate(10);

        return view('baners.index', compact('baners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('baners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try{
            $path = '';
            if($request->hasFile('fichier'))
            {
                $path = Storage::disk('public')->put('bannieres', $request->fichier,);
            }

            Baner::create([
                'path' => $path,
            ]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement');
        }

        return redirect()->route('baners.index')->with('success', 'Bannieres ajoutées avec succès');
    }

    public function destroy(Baner $baner)
    {
        try{
            if(Storage::disk('public')->exists($baner->path))
            {
                Storage::disk('public')->delete($baner->path);
            }
            $baner->delete();
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression');
        }

        return redirect()->route('baners.index')->with('success', 'Bannieres supprimées avec succès');
    }

    public function baners()
    {
        return response()->json(BanerResource::collection(Baner::latest('created_at')->limit(2)->get()));
    }
}
