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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->group(function () {
    Route::get('general_info', 'generalInfoController@index')->name('general_info');
    Route::get('education', 'educationController@index')->name('education');
    Route::get('thesis', 'thesisController@index')->name('thesis');
    Route::get('industry_experience', 'industryExperienceController@index')->name('industry_experience');
    Route::get('tcase', 'tcaseController@index')->name('tcase');
    Route::get('MOST_project', 'mostProjectController@index')->name('MOST_project');
    Route::get('thesis_conf', 'thesisConfController@index')->name('thesis_conf');
    Route::get('other', 'otherController@index')->name('other');
});
