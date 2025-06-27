<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/publish', function () {
    // ...
 
    Redis::publish('test-channel', json_encode([
        'name' => 'Adam Wathan'
    ]));
});