<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::group(['middleware'=>['guest']],function(){

    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth']
    ], function()
{

	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/


//    Route::get('/grades', 'App\Http\Controllers\Grades\GradeController@index')->name('grades');

    Route::group(['namespace' =>'App\Http\Controllers\Grades'],function(){
        Route::resource('grades','GradeController');
    });

    Route::group(['namespace' =>'App\Http\Controllers\Classroom'],function(){
        Route::resource('classrooms/classrooms-list','ClassroomController');

        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

        Route::post('classrooms/filter_classes', 'ClassroomController@filter_classes')->name('filter_classes');

    });

    Route::group(['namespace' =>'App\Http\Controllers\Section'],function(){
        Route::resource('sections','sectionController');

        Route::get('/classes/{id}', 'sectionController@getClasses');

    });



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
});




