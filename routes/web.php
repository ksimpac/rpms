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
        Route::post('general_info', 'generalInfoController@store')->name('store');
        Route::delete('general_info/{username}', 'generalInfoController@destroy')->name('destroy');
    });

    Route::name('education.')->group(function () {
        Route::get('education', 'educationController@index')->name('index');
        Route::get('education/create', 'educationController@create')->name('create');
        Route::post('education', 'educationController@store')->name('store');
        Route::delete('education/{username}', 'educationController@destroy')->name('destroy');
    });

    Route::name('thesis.')->group(function () {
        Route::get('thesis', 'thesisController@index')->name('index');
        Route::get('thesis/create', 'thesisController@create')->name('create');
        Route::post('thesis', 'thesisController@store')->name('store');
        Route::delete('thesis/{id}', 'thesisController@destroy')->name('destroy');
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


    Route::name('thesis_conf.')->group(function () {
        Route::get('thesis_conf', 'thesisConfController@index')->name('index');
        Route::get('thesis_conf/create', 'thesisConfController@create')->name('create');
    });

    Route::name('other.')->group(function () {
        Route::get('other', 'otherController@index')->name('index');
        Route::get('other/create', 'otherController@create')->name('create');
    });
});
