<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Resources\AllPostFromCategoryCollection as AllPostFromCategoryCollectionResource;


class GuestUserController extends Controller
{
    public function getAllPostByCategory() {
        return new AllPostFromCategoryCollectionResource(Category::all());
    }
}
