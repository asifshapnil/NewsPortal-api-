<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Resources\AllPostFromCategoryCollection as AllPostFromCategoryCollectionResource;

use App\Http\Resources\LatestPostBycategoryCollection as LatestPostBycategoryCollectionResource;

class GuestUserController extends Controller
{
    public function getAllPostByCategory() {
        return new AllPostFromCategoryCollectionResource(Category::all());
    }

    public function LatestPostByCategory() {
        return new LatestPostBycategoryCollectionResource(Category::all());
    }
}
