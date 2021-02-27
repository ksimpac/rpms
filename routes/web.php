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
Route::name('admin.')->group(function () {
    Route::name('export.')->group(function () {
        Route::get('/export', 'Admin\ExportController@index')->name('index');
        Route::post('/export', 'Admin\ExportController@export')->name('export');
    });

    Route::name('profile.')->group(function () {
        Route::get('/profile', 'Admin\ProfileController@index')->name('index');
        Route::post('/profile', 'Admin\ProfileController@show')->name('show');
    });
});

Route::middleware('auth', 'user')->group(function () {
    Route::prefix('users')->group(function () {
        Route::name('general_info.')->group(function () {
            Route::get('general_info', 'generalInfoController@index')->name('index');
            Route::get('general_info/create', 'generalInfoController@create')->name('create')->middleware('isSignup');
            Route::post('general_info', 'generalInfoController@store')->name('store')->middleware('isSignup');
            Route::get('general_info/{id}/edit', 'generalInfoController@edit')->name('edit')->middleware('isSignup');
            Route::get('general_info/{id}', 'generalInfoController@show')->name('show');
            Route::patch('general_info/{id}', 'generalInfoController@update')->name('update')->middleware('isSignup');
            Route::delete('general_info/{id}', 'generalInfoController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('education.')->group(function () {
            Route::get('education', 'educationController@index')->name('index');
            Route::get('education/create', 'educationController@create')->name('create')->middleware('isSignup');
            Route::post('education', 'educationController@store')->name('store')->middleware('isSignup');
            Route::get('education/{id}/edit', 'educationController@edit')->name('edit')->middleware('isSignup');
            Route::get('education/{id}', 'educationController@show')->name('show');
            Route::patch('education/{id}', 'educationController@update')->name('update')->middleware('isSignup');
            Route::delete('education/{id}', 'educationController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('thesis.')->group(function () {
            Route::get('thesis', 'thesisController@index')->name('index');
            Route::get('thesis/create', 'thesisController@create')->name('create')->middleware('isSignup');
            Route::post('thesis', 'thesisController@store')->name('store')->middleware('isSignup');
            Route::get('thesis/{id}/edit', 'thesisController@edit')->name('edit')->middleware('isSignup');
            Route::get('thesis/{id}', 'thesisController@show')->name('show');
            Route::patch('thesis/{id}', 'thesisController@update')->name('update')->middleware('isSignup');
            Route::delete('thesis/{id}', 'thesisController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('industry_experience.')->group(function () {
            Route::get('industry_experience', 'industryExperienceController@index')->name('index');
            Route::get('industry_experience/create', 'industryExperienceController@create')->name('create')->middleware('isSignup');
            Route::post('industry_experience', 'industryExperienceController@store')->name('store')->middleware('isSignup');
            Route::get('industry_experience/{id}/edit', 'industryExperienceController@edit')->name('edit')->middleware('isSignup');
            Route::get('industry_experience/{id}', 'industryExperienceController@show')->name('show');
            Route::patch('industry_experience/{id}', 'industryExperienceController@update')->name('update')->middleware('isSignup');
            Route::delete('industry_experience/{id}', 'industryExperienceController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('tcase.')->group(function () {
            Route::get('tcase', 'tcaseController@index')->name('index');
            Route::get('tcase/create', 'tcaseController@create')->name('create')->middleware('isSignup');
            Route::post('tcase', 'tcaseController@store')->name('store')->middleware('isSignup');
            Route::get('tcase/{id}/edit', 'tcaseController@edit')->name('edit')->middleware('isSignup');
            Route::get('tcase/{id}', 'tcaseController@show')->name('show');
            Route::patch('tcase/{id}', 'tcaseController@update')->name('update')->middleware('isSignup');
            Route::delete('tcase/{id}', 'tcaseController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('MOST_project.')->group(function () {
            Route::get('MOST_project', 'mostProjectController@index')->name('index');
            Route::get('MOST_project/create', 'mostProjectController@create')->name('create')->middleware('isSignup');
            Route::post('MOST_project', 'mostProjectController@store')->name('store')->middleware('isSignup');
            Route::get('MOST_project/{id}/edit', 'mostProjectController@edit')->name('edit')->middleware('isSignup');
            Route::get('MOST_project/{id}', 'mostProjectController@show')->name('show');
            Route::patch('MOST_project/{id}', 'mostProjectController@update')->name('update')->middleware('isSignup');
            Route::delete('MOST_project/{id}', 'mostProjectController@destroy')->name('destroy')->middleware('isSignup');
        });


        Route::name('thesis_conf.')->group(function () {
            Route::get('thesis_conf', 'thesisConfController@index')->name('index');
            Route::get('thesis_conf/create', 'thesisConfController@create')->name('create')->middleware('isSignup');
            Route::post('thesis_conf', 'thesisConfController@store')->name('store')->middleware('isSignup');
            Route::get('thesis_conf/{id}/edit', 'thesisConfController@edit')->name('edit')->middleware('isSignup');
            Route::get('thesis_conf/{id}', 'thesisConfController@show')->name('show');
            Route::patch('thesis_conf/{id}', 'thesisConfController@update')->name('update')->middleware('isSignup');
            Route::delete('thesis_conf/{id}', 'thesisConfController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('other.')->group(function () {
            Route::get('other', 'otherController@index')->name('index');
            Route::get('other/create', 'otherController@create')->name('create')->middleware('isSignup');
            Route::post('other', 'otherController@store')->name('store')->middleware('isSignup');
            Route::get('other/{id}/edit', 'otherController@edit')->name('edit')->middleware('isSignup');
            Route::patch('other/{id}', 'otherController@update')->name('update')->middleware('isSignup');
            Route::delete('other/{id}', 'otherController@destroy')->name('destroy')->middleware('isSignup');
        });

        Route::name('signup.')->group(function () {
            Route::post('signup', 'signupController@check')->name('store');
        });
    });
});
