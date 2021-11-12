<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'event_id' => $this->id,
            'title' => $this->post->title,
            'image' => $this->post->image,
            'start' => $this->start,
            'end' => $this->end,
            'link' => $this->link,
            'location' => $this->location,
            'resume' => $this->post->resume,
            'validator' => new UserResource($this->post->author_id),
        ];
    }
}
