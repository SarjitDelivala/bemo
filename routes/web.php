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


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/contact-us', 'ContactUsController@index')->name('contact-us');

    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminPanelController@index')->name('admin');
        Route::get('/pages', 'AdminPanelController@pages')->name('admin.pages.index');
        Route::get('/contents', 'AdminPanelController@contents')->name('admin.contents.index');
        Route::get('/pages/{page}', 'AdminPanelController@showPage')->name('admin.pages.show');
        Route::get('/contents/{content}', 'AdminPanelController@showContent')->name('admin.contents.show');
        Route::get('/email-config', 'AdminPanelController@emailConfig')->name('admin.email-config');
    });

    Route::post("/email", "EmailController@send")->name('email.send');
});
