<?php

namespace App\Http\Controllers\local;

use App\Models\Media;
use Illuminate\Http\Request;
use Dawson\Youtube\Facades\Youtube;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = Media::latest()->paginate(15);

        return view('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medias.create');
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
        if ($request->hasFile('fichier')) {
            $fichier = $request->fichier;

            if ($fichier->getSize() > 100000000) {
                return redirect()->back()->with('error', 'Le fichier est trop volumineux');
            }

            $path = '';

            switch ($fichier->extension()) {
                case 'mp4';
                case 'avi';
                case 'mkv';
                    $path = Storage::disk('public')->put('videos', $request->fichier, 'public');
                    break;

                case 'mp3';
                case 'm4a';
                    $path = Storage::disk('public')->put('audios', $request->fichier, 'public');
                    break;

                case 'png';
                case 'jpg';
                    $path = Storage::disk('public')->put('images', $request->fichier, 'public');
                    break;
            }

            try {
                $media = Media::create([
                    'title' => $request->title,
                    'path' => $path,
                    'user_id' => Auth::user()->id,
                ]);

                //----------------------------------------------------------

                $channelId = "";
                $API_key = "";

                $target_url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=' . $channelId . '&key=' . $API_key . '';
                $dir = Storage::url($media->path);

                $cFile = curl_file_create($dir, 'video/mp4');
                $post = [
                    'title' => $media->title,
                    'description' => $media->description,
                    'file' => $cFile,
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $target_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = json_decode(curl_exec($ch));
                curl_close($ch);
            }
            catch (\Exception $e)
            {
                Storage::disk('public')->delete($media->path);
                $media->delete();

                return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement du fichier <br>' . $e->getMessage());
            }

            return redirect()->route('medias.index')->with('success', 'Le fichier a été enregistré avec succès');
        }
        return redirect()->back()->with('error', 'Veuillez sélectionner un fichier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        // return view('medias.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        return view('medias.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        try{
            $media->update([
                'title' => $request->title,
            ]);

            return redirect()->route('medias.index')->with('success', 'Le fichier a été modifié avec succès');
        }
        catch (\Exception $e)
        {
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
        try
        {
            Storage::disk('public')->delete($media->path);
            $media->delete();
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du fichier <br>' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Le fichier a été supprimé avec succès');
    }
}
