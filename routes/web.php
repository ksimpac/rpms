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
    Route::name('general_info.')->group(function () {
        Route::get('general_info', 'generalInfoController@index')->name('index');
        Route::get('general_info/create', 'generalInfoController@create')->name('create');
    });

    Route::name('education.')->group(function () {
        Route::get('education', 'educationController@index')->name('index');
        Route::get('education/create', 'educationController@create')->name('create');
    });

    Route::name('thesis.')->group(function () {
        Route::get('thesis', 'thesisController@index')->name('index');
        Route::get('thesis/create', 'thesisController@create')->name('create');
    });

    Route::name('industry_experience.')->group(function () {
        Route::get('industry_experience', 'industryExperienceController@index')->name('index');
        Route::get('industry_experience/create', 'industryExperienceController@create')->name('create');
    });

    Route::name('tcase.')->group(function () {
        Route::get('tcase', 'tcaseController@index')->name('index');
        Route::get('tcase/create', 'tcaseController@create')->name('create');
    });

    Route::name('MOST_project.')->group(function () {
        Route::get('MOST_project', 'mostProjectController@index')->name('index');
        Route::get('MOST_project/create', 'mostProjectController@create')->name('create');
    });


    Route::get('thesis_conf', 'thesisConfController@index')->name('thesis_conf');
    Route::get('other', 'otherController@index')->name('other');
});
