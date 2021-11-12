<?php

namespace App\Http\Controllers\local;

use App\Models\Newsexpress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsExpressResource;

class NewsexpressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsexpresses = Newsexpress::paginate(15);

        return view('newsexpresses.index', compact('newsexpresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsexpresses.create');
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
            Newsexpress::create([
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }
        catch(\Exception $err)
        {
            $old_datas = $request->all();

            return redirect()->route('newsexpresses.create')->with('error', 'Error: '.$err->getMessage().'<br>Old datas: '.json_encode($old_datas));
            // return view('newsexpresses.create', compact('old_datas'));
        }
        return redirect()->route('newsexpresses.index')->with('success', 'newsexpress crée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsexpress  $newsexpress
     * @return \Illuminate\Http\Response
     */
    public function show(Newsexpress $newsexpress)
    {
        return view('newsexpresses.show', compact('newsexpress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsexpress  $newsexpress
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsexpress $newsexpress)
    {
        return view('newsexpresses.edit', compact('newsexpress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsexpress  $newsexpress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsexpress $newsexpress)
    {
        try{
            $newsexpress->update([
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }
        catch(\Exception $err)
        {
            return redirect()->route('newsexpresses.edit', $newsexpress->id)->with('error', 'Error: '.$err->getMessage());
        }

        return redirect()->route('newsexpresses.show', $newsexpress->id)->with('success', 'Modification éffectué avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsexpress  $newsexpress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsexpress $newsexpress)
    {
        try{
            $newsexpress->delete();
        }
        catch(\Exception $err)
        {
            return redirect()->route('newsexpresses.index')->with('error', 'Error: '.$err->getMessage());
        }

        return $this->index();
    }

    public function newsExpress()
    {
        return response()->json(NewsExpressResource::collection(Newsexpress::all()));
    }
}
