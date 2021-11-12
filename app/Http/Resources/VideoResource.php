<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $author = null;
        $validator = null;

        if($this->post->validator_id !== null)
        {
            $validator = new UserResource(User::findOrFail($this->post->validator_id));
        }

        if($this->post->author_id != null && $this->post->author->role->id != null)
        {
            $author = new UserResource(User::findOrFail($this->post->author_id));
        }

        return [
            'video_id' => $this->id,
            'title' => $this->post->title,
            'image' => Storage::url($this->post->image),

            'created_at' => $this->created_at,

            'author' => $author,
            'validator' => $validator,
        ];
    }
}
