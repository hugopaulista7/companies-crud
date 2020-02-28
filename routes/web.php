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

Auth::routes();

Route::post('/logout', 'Auth\LoginController@logout')->name('system.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('system');


    Route::get('/companies', 'CompaniesController@companies')->name('companies');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::post('/companies/create', 'CompaniesController@insert')->name('companies.insert');


    Route::get('/persons', 'PersonsController@persons')->name('persons');
    Route::get('/persons/create', 'PersonsController@create')->name('persons.create');
});
