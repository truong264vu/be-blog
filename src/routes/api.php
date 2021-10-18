<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/post', 'PostController');
Route::get('getCategory' , 'PostController@getCategory');



Route::resource('/category', 'CategoryController');
Route::get('/categoryId', 'CategoryController@categoryPost');


Route::post('/login', 'UserController@login');
// update Avata 
Route::post('/updateAvatar', 'UserController@updateAvatar');
Route::post('/register', 'UserController@register');
Route::get('/user' , 'UserController@userInfo')->middleware('auth:api');


Route::resource('comment', 'CommentController');
Route::post('/destroyChildComment', 'CommentController@destroyChildComment');
Route::get('/getComment', 'CommentController@getComment');



Route::resource('/admin', 'AdminController');
Route::post('/addPostCategory', 'AdminController@addPostCategory');
Route::post('/CreateRelationshipPostCategory','AdminController@CreateRelationshipPostCategory');
Route::post('/DeleteRelationshipPostCategory','AdminController@DeleteRelationshipPostCategory');
Route::post('DeletePost_Category', 'AdminController@DeletePost_Category');
Route::get('/findPost', 'AdminController@findPost');
Route::get('/getAvatar', 'AdminController@getAvatar');
Route::get('/likePost' , 'AdminController@likePost');
Route::post('/UpdatePost_Category', 'AdminController@UpdatePost_Category');
Route::post('/CreateRalationshipUserPostLike' , 'AdminController@CreateRalationshipUserPostLike');
Route::post('/DeleteRalationshipUserPostLike' , 'AdminController@DeleteRalationshipUserPostLike');
Route::get('/getTotalLike' , 'AdminController@getTotalLike');



