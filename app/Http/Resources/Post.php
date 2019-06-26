<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'category' => $this->category->categoryName,
            'author' => $this->user->name,
            'heading' => $this->heading,
            'body' => $this->body,
            'count' => $this->count,
            'isMedia' => $this->isMedia,
            'imagePath' => asset('images/'.$this->image),
            'created_at' => $this->created_at
        ];
        // return parent::toArray($request);
    }
}
