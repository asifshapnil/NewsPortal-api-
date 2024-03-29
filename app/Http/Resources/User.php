<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Role as RoleResource;
use App\Http\Resources\Category as CategoryResource;


class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            // 'posts' => PostResource::collection($this->posts),
            'roles' => RoleResource::collection($this->roles),
            'category' => new CategoryResource($this->category),
            'access_token' => $this->access_token
        ];

        // return parent::toArray($request);
    }
}
