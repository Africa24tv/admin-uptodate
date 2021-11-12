<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'article_id' => $this->id,
            'title' => $this->post->title,
            'subject' => new SubjectResource($this->post->subject),
            'image' => Storage::url($this->post->image),
            'resume' => $this->post->resume,
            'body' => $this->body,
            'media' => new MediaResource($this->media),

            'type' => $this->type,

            'status' => $this->post->status,
            'created_at' => $this->created_at,

            'author' => new UserResource($this->post->author),

            'validator' => new UserResource($this->post->validator),
        ];
    }
}
