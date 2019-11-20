<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get ('/teachers','PagesController@teachers')->middleware('auth')->name('teachers.index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/filter','SearchController@postSearch')->name('search.post');
Route::get('/{sllug}', 'PagesController@single')->name('page.single');
Route::get('profile',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::put('profile',  ['as' => 'users.update', 'uses' => 'UserController@update']);

Route::get('/', 'PagesController@mainPage')->name('page.main');
Route::post('/lesson','LessonController@postLesson')->name('lesson.post');
Route::post('/','OrderController@postOrder')->name('order.post');
//Route::get('/profile','PagesController@profile')->middleware('auth')->name('user.profile');
// Route::get('/', function () {
//     return view('welcome');
// });


