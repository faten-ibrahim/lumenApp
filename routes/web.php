<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->post('authors', ['uses' => 'AuthorController@create']);
$router->put('authors/{id}', ['uses' => 'AuthorController@update']);

$router->get('/', function () use ($router) {
    return $router->app->version();
});
Route::post('api/login', 'AuthController@login');

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'auth'
], function ($router) {

    $router->get('authors',  ['uses' => 'AuthorController@showAllAuthors']);
  
    $router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);
  
    // $router->post('authors', ['uses' => 'AuthorController@create']);
  
    $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);
    $router->get('articles',  ['uses' => 'ArticleController@showAllArticles']);
  
    $router->get('articles/{id}', ['uses' => 'ArticleController@showOneArticle']);
  
    $router->post('articles', ['uses' => 'ArticleController@create']);
  
    $router->delete('articles/{id}', ['uses' => 'ArticleController@delete']);
  
    $router->put('articles/{id}', ['uses' => 'ArticleController@update']);
    // $router->post('/upload', 'ImageController@upload');
  });