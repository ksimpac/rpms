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

Auth::routes(['reset' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['web']], function () {
    Route::post('/export', 'ExportController@export')->name('export');

    Route::name('profile.')->group(function () {
        Route::get('/profile', 'ProfileController@index')->name('index');
        Route::post('/profile', 'ProfileController@show')->name('show');
    });

    Route::name('register.')->group(function () {
        Route::get('/register', 'RegisterController@create')->name('create');
        Route::post('/register', 'RegisterController@store')->name('store');
    });

    Route::name('deadline.')->group(function () {
        Route::get('/deadline', 'DeadlineController@index')->name('index');
        Route::post('/deadline', 'DeadlineController@store')->name('store');
    });

    Route::name('removeUsers.')->group(function () {
        Route::get('/removeUsers', 'RemoveUsersController@index')->name('index');
        Route::delete('/removeUsers', 'RemoveUsersController@delete')->name('delete');
        Route::delete('/removeUsers/selected', 'RemoveUsersController@removeSelectedUsers')->name('removeSelectedUsers');
    });
});

Route::group(['prefix' => '/users', 'middleware' => ['web']], function () {
    Route::name('general_info.')->group(function () {
        Route::middleware('isSignup', 'isDeadline')->group(function () {
            Route::get('general_info/create', 'GeneralInfoController@create')->name('create');
            Route::post('general_info', 'GeneralInfoController@store')->name('store');
            Route::get('general_info/{id}/edit', 'GeneralInfoController@edit')->name('edit');
            Route::patch('general_info/{id}', 'GeneralInfoController@update')->name('update');
            Route::delete('general_info/{id}', 'GeneralInfoController@destroy')->name('destroy');
        });
        Route::get('general_info', 'GeneralInfoController@index')->name('index');
        Route::get('general_info/{id}', 'GeneralInfoController@show')->name('show');
    });

    Route::name('education.')->group(function () {
        Route::middleware(['isSignup', 'isDeadline'])->group(function () {
            Route::get('education/create', 'EducationController@create')->name('create');
            Route::post('education', 'EducationController@store')->name('store');
            Route::get('education/{id}/edit', 'EducationController@edit')->name('edit');
            Route::patch('education/{id}', 'EducationController@update')->name('update');
            Route::delete('education/{id}', 'EducationController@destroy')->name('destroy');
        });
        Route::get('education', 'EducationController@index')->name('index');
        Route::get('education/{id}', 'EducationController@show')->name('show');
    });

    Route::name('thesis.')->group(function () {
        Route::middleware('isSignup', 'isDeadline')->group(function () {
            Route::get('thesis/create', 'ThesisController@create')->name('create');
            Route::post('thesis', 'ThesisController@store')->name('store');
            Route::get('thesis/{id}/edit', 'ThesisController@edit')->name('edit');
            Route::patch('thesis/{id}', 'ThesisController@update')->name('update');
            Route::delete('thesis/{id}', 'ThesisController@destroy')->name('destroy');
        });
        Route::get('thesis', 'ThesisController@index')->name('index');
        Route::get('thesis/{id}', 'ThesisController@show')->name('show');
    });

    Route::name('industry_experience.')->group(function () {
        Route::middleware(['isSignup', 'isDeadline'])->group(function () {
            Route::get('industry_experience/create', 'IndustryExperienceController@create')->name('create');
            Route::post('industry_experience', 'IndustryExperienceController@store')->name('store');
            Route::get('industry_experience/{id}/edit', 'IndustryExperienceController@edit')->name('edit');
            Route::patch('industry_experience/{id}', 'IndustryExperienceController@update')->name('update');
            Route::delete('industry_experience/{id}', 'IndustryExperienceController@destroy')->name('destroy');
        });
        Route::get('industry_experience', 'IndustryExperienceController@index')->name('index');
        Route::get('industry_experience/{id}', 'IndustryExperienceController@show')->name('show');
    });

    Route::name('tcase.')->group(function () {
        Route::middleware(['isSignup', 'isDeadline'])->group(function () {
            Route::get('tcase/create', 'TcaseController@create')->name('create');
            Route::post('tcase', 'TcaseController@store')->name('store');
            Route::get('tcase/{id}/edit', 'TcaseController@edit')->name('edit');
            Route::patch('tcase/{id}', 'TcaseController@update')->name('update');
            Route::delete('tcase/{id}', 'TcaseController@destroy')->name('destroy');
        });
        Route::get('tcase', 'TcaseController@index')->name('index');
        Route::get('tcase/{id}', 'TcaseController@show')->name('show');
    });

    Route::name('most_project.')->group(function () {
        Route::middleware(['isSignup', 'isDeadline'])->group(function () {
            Route::get('most_project/create', 'MostProjectController@create')->name('create');
            Route::post('most_project', 'MostProjectController@store')->name('store');
            Route::get('most_project/{id}/edit', 'MostProjectController@edit')->name('edit');
            Route::patch('most_project/{id}', 'MostProjectController@update')->name('update');
            Route::delete('most_project/{id}', 'MostProjectController@destroy')->name('destroy');
        });
        Route::get('most_project', 'MostProjectController@index')->name('index');
        Route::get('most_project/{id}', 'MostProjectController@show')->name('show');
    });


    Route::name('thesis_conf.')->group(function () {
        Route::middleware(['isSignup', 'isDeadline'])->group(function () {
            Route::get('thesis_conf/create', 'ThesisConfController@create')->name('create');
            Route::post('thesis_conf', 'ThesisConfController@store')->name('store');
            Route::get('thesis_conf/{id}/edit', 'ThesisConfController@edit')->name('edit');
            Route::patch('thesis_conf/{id}', 'ThesisConfController@update')->name('update');
            Route::delete('thesis_conf/{id}', 'ThesisConfController@destroy')->name('destroy');
        });
        Route::get('thesis_conf', 'ThesisConfController@index')->name('index');
        Route::get('thesis_conf/{id}', 'ThesisConfController@show')->name('show');
    });

    Route::name('other.')->group(function () {
        Route::middleware(['isSignup', 'isDeadline'])->group(function () {
            Route::get('other/create', 'OtherController@create')->name('create');
            Route::post('other', 'OtherController@store')->name('store');
            Route::get('other/{id}/edit', 'OtherController@edit')->name('edit');
            Route::patch('other/{id}', 'OtherController@update')->name('update');
            Route::delete('other/{id}', 'OtherController@destroy')->name('destroy');
        });
        Route::get('other', 'OtherController@index')->name('index');
    });

    Route::name('signup.')->group(function () {
        Route::post('signup', 'SignupController@check')->name('store')->middleware('isSignup', 'isDeadline');
    });
});
