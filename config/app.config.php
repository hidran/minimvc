<?php

return [
    'routes' =>
        [
        'GET' => [
            '' => 'App\Controllers\PostController@getPosts',
            'posts' => 'App\Controllers\PostController@getPosts',
            'post/create' => 'App\Controllers\PostController@create',
            'post/:id' => 'App\Controllers\PostController@show',
            'post/:postid/edit' => 'App\Controllers\PostController@edit',
            'auth/login'  => 'App\Controllers\LoginController@showLogin',
            'auth/signup'  => 'App\Controllers\LoginController@showSignup',

           
    
        ],
            'POST' => [
                'post/save' => 'App\Controllers\PostController@save',
                'post/:id/store' => 'App\Controllers\PostController@store',
                'post/:id/delete' => 'App\Controllers\PostController@delete',
                'post/:id/comment' =>  'App\Controllers\PostController@saveComment',
                'auth/login'  => 'App\Controllers\LoginController@login',
                'auth/signup'  => 'App\Controllers\LoginController@signup',
                'auth/logout'  => 'App\Controllers\LoginController@logout',

            ]
    ]
        ]
;
