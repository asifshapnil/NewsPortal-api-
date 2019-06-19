<?php


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Model\Post;


Route::group(['middleware' => 'api'], function () {

    Route::get('getMe', function(){
            Post::create([
                'user_id' => Auth::user()->id,
                'heading' => 'My First post',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae possimus ut nobis nam nostrum laborum illum maiores dolor. Suscipit, maiores assumenda sunt exercitationem ipsa unde vel optio nobis odio iusto.'
            ]);

    });

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


    });

});
