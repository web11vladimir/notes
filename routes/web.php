<?php

use Illuminate\Support\Facades\Route;

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
// вывод всех заметок на главной
Route::get('/', 'NoteController@index');

// для работы с заметками
Route::resource('/note', 'NoteController')->only(['edit', 'update', 'create', 'store', 'destroy']);

// получение текста заметки по ajax
Route::post('/ajax/{id}', 'NoteController@showNote');

// поиск заметок
Route::get('/search', 'NoteController@search');
