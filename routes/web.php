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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('student_page', 'StudentController@student_page');
Route::get('student', 'StudentController@index');
Route::post('student_store', 'StudentController@student_store');
Route::get('student_edit/{id}','StudentController@student_edit');
Route::post('student_update', 'StudentController@student_update');
Route::get('student_delete/{id}', 'StudentController@student_delete');