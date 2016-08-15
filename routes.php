<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*Страница с результатами*/
Route::get('site/results', 'MathController@results');

/*АПИ запрос на вычисление операции по задаче #1*/
Route::get('count/{operation}', 'MathController@count');
