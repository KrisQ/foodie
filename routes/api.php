<?php

use Illuminate\Http\Request;

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
Route::post("auth/register", "AuthController@register");
Route::post('auth/login', 'AuthController@login');

Route::get('categories', 'CategoryController@getAll');
Route::post('createRecipe', 'RecipeController@store');
Route::post('editRecipe/{id}', 'RecipeController@edit');
Route::post('deleteRecipe/{id}', 'RecipeController@destroy');
Route::get('getRecipes/{filter?}/{category?}/{param?}', 'RecipeController@read');
Route::get('getRecipe/{id}', 'RecipeController@readOne');

Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

