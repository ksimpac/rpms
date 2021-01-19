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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth', 'user')->group(function () {
    Route::prefix('users')->group(function () {
        Route::name('general_info.')->group(function () {
            Route::get('general_info', 'generalInfoController@index')->name('index');
            Route::get('general_info/create', 'generalInfoController@create')->name('create');
            Route::post('general_info', 'generalInfoController@store')->name('store');
            Route::get('general_info/{username}/{id}/edit', 'generalInfoController@edit')->name('edit');
            Route::get('general_info/{username}/{id}', 'generalInfoController@show')->name('show');
            Route::patch('general_info/{username}/{id}', 'generalInfoController@update')->name('update');
            Route::delete('general_info/{username}', 'generalInfoController@destroy')->name('destroy');
        });

        Route::name('education.')->group(function () {
            Route::get('education', 'educationController@index')->name('index');
            Route::get('education/create', 'educationController@create')->name('create');
            Route::post('education', 'educationController@store')->name('store');
            Route::get('education/{username}/{id}/edit', 'educationController@edit')->name('edit');
            Route::get('education/{username}/{id}', 'educationController@show')->name('show');
            Route::patch('education/{username}/{id}', 'educationController@update')->name('update');
            Route::delete('education/{username}', 'educationController@destroy')->name('destroy');
        });

        Route::name('thesis.')->group(function () {
            Route::get('thesis', 'thesisController@index')->name('index');
            Route::get('thesis/create', 'thesisController@create')->name('create');
            Route::post('thesis', 'thesisController@store')->name('store');
            Route::get('thesis/{username}/{id}/edit', 'thesisController@edit')->name('edit');
            Route::get('thesis/{username}/{id}', 'thesisController@show')->name('show');
            Route::patch('thesis/{username}/{id}', 'thesisController@update')->name('update');
            Route::delete('thesis/{id}', 'thesisController@destroy')->name('destroy');
        });

        Route::name('industry_experience.')->group(function () {
            Route::get('industry_experience', 'industryExperienceController@index')->name('index');
            Route::get('industry_experience/create', 'industryExperienceController@create')->name('create');
            Route::post('industry_experience', 'industryExperienceController@store')->name('store');
            Route::get('industry_experience/{username}/{id}/edit', 'industryExperienceController@edit')->name('edit');
            Route::patch('industry_experience/{username}/{id}', 'industryExperienceController@update')->name('update');
            Route::delete('industry_experience/{id}', 'industryExperienceController@destroy')->name('destroy');
        });

        Route::name('tcase.')->group(function () {
            Route::get('tcase', 'tcaseController@index')->name('index');
            Route::get('tcase/create', 'tcaseController@create')->name('create');
            Route::post('tcase', 'tcaseController@store')->name('store');
            Route::get('tcase/{username}/{id}/edit', 'tcaseController@edit')->name('edit');
            Route::patch('tcase/{username}/{id}', 'tcaseController@update')->name('update');
            Route::delete('tcase/{id}', 'tcaseController@destroy')->name('destroy');
        });

        Route::name('MOST_project.')->group(function () {
            Route::get('MOST_project', 'mostProjectController@index')->name('index');
            Route::get('MOST_project/create', 'mostProjectController@create')->name('create');
            Route::post('MOST_project', 'mostProjectController@store')->name('store');
            Route::get('MOST_project/{username}/{id}/edit', 'mostProjectController@edit')->name('edit');
            Route::patch('MOST_project/{username}/{id}', 'mostProjectController@update')->name('update');
            Route::delete('MOST_project/{id}', 'mostProjectController@destroy')->name('destroy');
        });


        Route::name('thesis_conf.')->group(function () {
            Route::get('thesis_conf', 'thesisConfController@index')->name('index');
            Route::get('thesis_conf/create', 'thesisConfController@create')->name('create');
            Route::post('thesis_conf', 'thesisConfController@store')->name('store');
            Route::get('thesis_conf/{username}/{id}/edit', 'thesisConfController@edit')->name('edit');
            Route::patch('thesis_conf/{username}/{id}', 'thesisConfController@update')->name('update');
            Route::delete('thesis_conf/{id}', 'thesisConfController@destroy')->name('destroy');
        });

        Route::name('other.')->group(function () {
            Route::get('other', 'otherController@index')->name('index');
            Route::get('other/create', 'otherController@create')->name('create');
            Route::post('other', 'otherController@store')->name('store');
            Route::get('other/{username}/{id}/edit', 'otherController@edit')->name('edit');
            Route::patch('other/{username}/{id}', 'otherController@update')->name('update');
            Route::delete('other/{id}', 'otherController@destroy')->name('destroy');
        });
    });
});
