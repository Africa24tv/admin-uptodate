<?php

namespace App\Http\Controllers\posts;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Slug;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required', 'string'],
                'fichier' => ['required'],
            ],
            [
                'title.required' => "Le titre est requis !",
                'fichier.required' => "Le ficheir est requis !",
            ]
        );

        // stockage de l'image et récuperation de son lien
        $path = null;
        if ($request->hasFile('fichier')) {
            $path = time() . "." . $request->fichier->extension();
            $path = $request->fichier->storeAs('images', $path, 'public');
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => Slug::str_slug($request->title),
            'image' => $path,
            'resume' => $request->resume,
            'subject_id' => $request->subject,
            'author_id' => Auth::user()->id,
        ]);

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // $post->update([
        //     'title' => $request->title,
        //     'resume' => $request->resume,
        // ]);

        // $post->category()->dissociate();
        // $post->category()->associate($request->category);

        if (Gate::allows('publish')) {
            $post->update([
                'status' => 'publié',
                'validator_id' => Auth::user()->id,
            ]);
        } else {
            $post->update([
                'status' => 'envoyé',
            ]);
        }

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
