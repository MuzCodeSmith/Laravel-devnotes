<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// optional routing
Route::get('/products/{id?}', function ($id=null) {
    if(!$id){
        return "All Product";
    }
    return "product id: $id";
});

// route validation
// example 1: only number
Route::get('/user/{id}',function($id){
    return "user id: $id";
})->whereNumber('id');

// example 2: only alphabets
Route::get('/category/{category}',function($category){
    return "category type: $category";
})->whereAlpha('category');

// example 3: alphanumric value
Route::get('/username/{username}',function($username){
    return "username: $username";
})->whereAlphaNumeric('username');

// example 4: must match one of the array element
 Route::get('/lang/{lang}',function($lang){
    return "language: $lang";
})->whereIn('lang',['en','hi','ur']);

// example 5: Regex - only lowercase letters
Route::get('/pass/{pass}',function($pass){
    return "language: $pass";
})->where('pass','[a-z]+');

// example 5: Regex - for multipe values
Route::get('/lang/{lang}/course/{coursId}',function($lang,$coursId){
    return "course: $coursId and language: $lang";
})->where(['lang'=>'[a-z]{2}','coursId'=>'\d{4}']);

// example 5: Regex - with special chars
Route::get('/search/{query}',function($query){
    return "search query:$query";
})->where('query','.+');
