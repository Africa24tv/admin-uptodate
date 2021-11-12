<?php

namespace App\Http\Controllers\local;

use App\Models\Scroll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScrollResource;
use Illuminate\Support\Facades\Auth;

class ScrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'scrolls']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scrolls = Scroll::latest()->paginate(15);

        return view('scrolls.index', compact('scrolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scrolls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Scroll::create([
                'title' => $request->title,
                'user_id' => Auth::user()->id,
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Impossible de crée le scroll');
        }

        $scrolls = Scroll::paginate(15);
        return redirect()->route('scrolls.index')->with('success', 'Scroll crée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Scroll $scroll)
    {
        return view('scrolls.edit', compact('scroll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scroll $scroll)
    {
        $scroll->update($request->all());

        $scrolls = Scroll::paginate(15);
        return redirect()->route('scrolls.index')->with('success', 'Scroll modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scroll $scroll)
    {
        $scroll->delete();

        $scrolls = Scroll::paginate(15);
        return redirect()->route('scrolls.index')->with('success', 'Scroll supprimé avec succès');
    }

    public function scrolls()
    {
        return response()->json(ScrollResource::collection(Scroll::all()));
    }
}
