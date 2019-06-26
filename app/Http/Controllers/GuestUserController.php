<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;
use App\Http\Controllers\DB;
use App\Http\Resources\AllPostFromCategoryCollection as AllPostFromCategoryCollectionResource;
use App\Http\Resources\getLatestPostWithCategoryCollection as getLatestPostWithCategoryResource;
use App\Http\Resources\Post as postResource;
use App\Http\Resources\PostCollection as postCollectionResource;

use Carbon\Carbon;
use App\Http\Resources\LatestPostBycategoryCollection as LatestPostBycategoryCollectionResource;

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

    public function getWeeklyPopulars() {
        $pupolarThisWeek = Post::where('isMedia', 0)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->take(6)->orderBy('count', 'DESC')->get();
        return new postCollectionResource($pupolarThisWeek);
    }

    public function getBreakingNews() {
        $breakingNews = Post::where('isBreakingNews', 1)->get();
        return new postCollectionResource($breakingNews);
    }

    public function getMediaOfTheWeek() {
        $mediaPost = Post::where('isMedia', 1)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return new postCollectionResource($mediaPost);
    }

    public function getPopuparthisMonth() {
        // dd(Carbon::now()->startOfMonth());
        $post = Post::where('isMedia', 0)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
               ->take(6)->orderBy('count', 'DESC')->get();
                // return $post;
        return new postCollectionResource($post);

    }
}
