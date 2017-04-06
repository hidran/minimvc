<?php
return [
  'routes' =>
    [
        'GET' => [
            '' => 'App\Controllers\PostController@getPosts',
            'posts' => 'App\Controllers\PostController@getPosts',            
            'post/create' => 'App\Controllers\PostController@create',
            'post/:id' => 'App\Controllers\PostController@show',
        //    'post/:postid/comments' => 'App\Controllers\PostController@showComments'
            
        ]
    ]
];