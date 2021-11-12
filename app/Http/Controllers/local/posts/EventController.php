<?php

namespace App\Http\Controllers\local\posts;

use App\Models\Type;
use App\Models\Event;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest()->paginate(15);

        return view('posts.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        return view('posts.events.create', compact('categories'));
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
            $creator = new PostController();

            $post = $creator->store($request);

            Event::create([
                'id' => $post->id,
                'start-date' => $request->start_date,
                'start-time' => $request->start_time,
                'end-date' => $request->end_date,
                'end-time' => $request->end_time,
                'link' => $request->link,
                'location' => $request->location,
                'organisateur' => $request->organisateur,
            ]);

        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement !');
        }

        return redirect()->route('events.index')->with('success', 'Enregistrement réussi !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $categories = Subject::whereType_id(Type::whereTitle('categorie')->first()->id)->get();

        return view('posts.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        try{
            // $creator = new PostController();

            // $post = $creator->update($request, $event);
            $event->post->update($request->all());

            $event->update([
                'start-date' => $request->start_date,
                'start-time' => $request->start_time,
                'end-date' => $request->end_date,
                'end-time' => $request->end_time,
                'link' => $request->link,
                'location' => $request->location,
                'organisateur' => $request->organisateur,
            ]);

        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Erreur lors de la modification !');
        }

        return redirect()->route('events.index')->with('success', 'Modification réussie !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        try{
            $event->post->delete();
            $event->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Erreur lors de la suppression !');
        }

        return redirect()->route('events.index')->with('success', 'Suppression réussie !');
    }

    public function articlesPubliers()
    {
        return response()->json(EventResource::collection(Event::whereStauts('publié')));
    }
}
