<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;
use App\Http\Controllers\DB;
use App\Http\Resources\AllPostFromCategoryCollection as AllPostFromCategoryCollectionResource;
use App\Http\Resources\getLatestPostWithCategoryCollection as getLatestPostWithCategoryResource;
use App\Http\Resources\Post as postResource;


class GuestUserController extends Controller
{
    public function getAllPostByCategory() {
        return new AllPostFromCategoryCollectionResource(Category::all());
    }

    public function getLatestPostAllCategory() {

        return new getLatestPostWithCategoryResource(Category::take(4)->get());
    }

    public function getPost($id) {
        Post::find($id)->increment('count', 1);
        return new postResource(Post::find($id));
    }
}
