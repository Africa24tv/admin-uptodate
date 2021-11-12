<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ActuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->id != 0)
        {
            $author = new UserResource(User::findorFail($this->user_id));
        }

        return [
            'actu_id' => $this->id,
            'title' => $this->title,
            'author' => $author,
        ];
    }
}
