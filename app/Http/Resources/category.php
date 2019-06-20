<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class category extends JsonResource
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
            'categoryName' => $this->categoryName
        ];
        // return parent::toArray($request);
    }
}
