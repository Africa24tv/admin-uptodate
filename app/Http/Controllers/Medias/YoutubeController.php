<?php

namespace App\Http\Controllers\Medias;

use App\Models\Media;
use Illuminate\Http\Request;
use Dawson\Youtube\Facades\Youtube;
use App\Http\Controllers\Controller;

class YoutubeController extends Controller
{
    public function upload(Request $request, Media $media)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                Youtube::upload($media->path, [
                    'title' => $media->title,
                    'description' => $request->description,
                    'privacyStatus' => 'public',
                ])->withThumbnail($request->thumbnail);
            } else {
                Youtube::upload($media->path, [
                    'title' => $media->title,
                    'description' => $request->description,
                    'privacyStatus' => 'public',
                ]);
            }

            $media->youtube_video_id = Youtube::getVideoId();

            return redirect()->route('medias.index')->with('success', 'Le fichier a été uploadé sur Youtube avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement de la vidéo <br>' . $e->getMessage());
        }
    }

    public function update(Request $request, Media $media)
    {
        try {
            Youtube::update($media->youtube_video_id, [
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('medias.index')->with('success', 'Le fichier a été modifié sur Youtube avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du fichier <br>' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        try {
            Youtube::delete($media->youtube_video_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du fichier <br>' . $e->getMessage());
        }

        return redirect()->route('medias.index')->with('success', 'Le fichier a été supprimé de Youtube avec succès');
    }
}
