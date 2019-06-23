<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post as PostCollectionResource;

class getLatestPostWithCategory extends JsonResource
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
            'categoryName' => $this->categoryName,
            'posts' => PostCollectionResource::collection($this->posts->take(-1)),
        ];
        // return parent::toArray($request);
    }
}
