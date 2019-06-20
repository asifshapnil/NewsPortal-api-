<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;

use App\Http\Resources\AllPostFromCategory as AllPostFromCategoryResource;

class EditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllPosts() {
        $myCategory = Category::find(Auth::user()->category_id);
        return new AllPostFromCategoryResource($myCategory);
    }

    public function approvePost($postId) {
        Post::find($postId)->update([
            'heading' => 'check updating',
            'body' => 'check updaing body',
            'status' => 1

        ]);
        // dd( Post::find($postId));
        return response()->json('Post Approved Successfully');
    }

}
