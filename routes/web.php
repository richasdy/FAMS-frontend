<?php

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/','LoginController@loginPage');
Route::post('login-action','LoginController@login');

Route::post('tes','LoginController@login');
Route::get('tes2','LoginController@tokenSession');
Route::get('tes3','LoginController@logout');

//asset
Route::get('/asset', 'AssetController@tableAsset');
Route::get('/create-asset','AssetController@createAsset');
Route::get('/delete-asset','AssetController@deleteAsset');

//location
Route::get('/location', 'LocationController@tableLocation');
Route::get('/create-location','LocationController@createLocation');
Route::get('/delete-location','LocationController@deleteLocation');

//Type
Route::get('/type', 'TypeController@tableType');
Route::get('/create-type','TypeController@createType');
Route::get('/delete-type','TypeController@deleteType');

//Type Detail
Route::get('/type-detail', 'TypeDetailController@tableType');
Route::get('/create-type-detail','TypeDetailController@createType');
Route::get('/delete-type-detail','TypeDetailController@deleteType');
