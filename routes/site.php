<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'Front'
], function () {


    ################################### Start Home ##################################
    Route::get('/', 'FrontController@home')->name('site.home');
    ################################### End Home ##################################



    ################################### Start Product ##################################
    Route::get('/product/{id}', 'FrontController@productShow')->name('site.product');
    ################################### End Product ##################################



    ################################### Start Certifications ##################################
    Route::get('/certifications', 'FrontController@certifications')->name('site.certifications');
    ################################### End Certifications ##################################



    ################################### Start Warranty ##################################
    Route::get('/warranty', 'FrontController@warranty')->name('site.warranty');
    ################################### End Warranty ##################################



    ################################### Start gallery ##################################
    Route::get('/gallery', 'FrontController@gallery')->name('site.gallery');
    ################################### End gallery ##################################

    ################################### Start Catalogs ##################################
    Route::get('/catalogs', 'FrontController@catalogs')->name('site.catalogs');
    ################################### End Catalogs ##################################

    ################################### Start contacts ##################################
    Route::get('/contacts', 'FrontController@contacts')->name('site.contacts');
    Route::post('/contacts-post', 'FrontController@contactsPost')->name('site.contacts.post');
    ################################### End contacts ##################################

});
