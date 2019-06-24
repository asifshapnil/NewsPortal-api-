<?php


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Model\Post;
use App\Model\Category;





Route::group(['middleware' => 'api'], function () {

    Route::get('getMe', function() {
       Category::create([
           'categoryName' => 'politics'
       ]);
    });

    Route::get('get-all-post-guest-user', 'GuestUserController@getAllPostByCategory');
    Route::get('get-cover-post', 'GuestUserController@LatestPostByCategory');

    Route::group(['prefix'=> 'auth'], function() {

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');

        Route::group(['middleware' => ['role:editor|admin']], function () {
            Route::get('me', 'AuthController@me');
        });


    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('create-user', 'AdminController@createUser');
        Route::post('assign-role', 'AdminController@assignRole');
        Route::post('create-role', 'AdminController@createRole');

        Route::get('remove-role-for-user/{userId}/{role}', 'AdminController@removeRoleForUser');
        Route::get('remove-role/{role}', 'AdminController@removeRole');
        Route::get('all-roles', 'AdminController@getAllRoles');
        Route::get('all-users', 'AdminController@getAllUsers');

        Route::post('create-category', 'AdminController@createCategory');
        Route::get('get-all-categories', 'AdminController@getAllCategories');



    });

    Route::group(['middleware' => ['role:contributor|admin']], function () {
        Route::post('create-post', 'ContributorController@createPost');
        Route::post('upload-image/{postId}', 'ContributorController@uploadImage');
        Route::post('update-post', 'ContributorController@updatePost');
        Route::get('remove-post/{postId}', 'ContributorController@removePost');
        Route::get('get-user-category', 'ContributorController@getUserCategory');


    });

    Route::group(['middleware' => ['role:editor|admin']], function () {
        Route::get('get-all-post-editor', 'EditorController@getAllPosts');
        Route::get('approve-post/{postId}', 'EditorController@approvePost');

    });

});
