<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'resume' => $this->resume,
            'type_id' => $this->type->id,
            'type' => $this->type->title,
            // 'type' => new TypeResource($this->type),
            'subject_parent' => new SubjectResource($this->parent),
        ];
    }
}
