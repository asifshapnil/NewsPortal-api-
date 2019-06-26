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
            'heading' => $this->heading,
            'body' => $this->body,
            'count' => $this->count,
            'isMedia' => $this->isMedia,
            'imagePath' => asset('images/'.$this->image)
        ];
        // return parent::toArray($request);
    }
}
