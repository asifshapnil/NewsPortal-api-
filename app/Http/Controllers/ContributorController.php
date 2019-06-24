<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Post;
use App\Model\Category;

use Image;


class ContributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUserCategory() {
       return response()->json(Category::find(Auth::user()->category));
    }

    public function createPost(Request $request) {
        Auth::user()->posts()->create([
            'heading' => $request->heading,
            'body' => $request->body,
            'category_id' => Auth::user()->category_id
        ]);

        return response()->json('Post created Successfully');
    }

    public function UploadImage(Request $request, $postId) {
        $post = Post::find($postId);
        
        if ($request->hasFile('postImage')) {
            $image = $request->file('postImage');
            $filename = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            image::make($image)->resize(800, 400)->save($location);
            $post->image = $filename;
          }
          $post->save();

          return response()->json('Image Uploaded Successfully');
    }

    public function updatePost(Request $request) {
        Post::find($request->id)->update([
            'heading' => $request->heading,
            'body' => $request->body,
            'category_id' => Auth::user()->category_id

        ]);

        return response()->json('Post Updated Successfully');

    }

    public function removePost($postId) {
        Post::find($postId)->delete();
        return response()->json('Post Removed Successfully');

    }


}
