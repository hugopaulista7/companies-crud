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

Route::get('/', function () {
    return redirect()->route('system');
});

Auth::routes();

Route::post('/logout', 'Auth\LoginController@logout')->name('system.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('system');


    Route::get('/companies', 'CompaniesController@companies')->name('companies');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::post('/companies/create', 'CompaniesController@insert')->name('companies.insert');
    Route::get('/companies/delete/{id}', 'CompaniesController@delete')->name('companies.delete');
    Route::get('/companies/edit/{id}', 'CompaniesController@edit')->name('companies.edit');
    Route::post('/companies/update/{id}', 'CompaniesController@update')->name('companies.update');


    Route::get('/persons', 'PersonsController@persons')->name('persons');
    Route::get('/persons/create', 'PersonsController@create')->name('persons.create');
    Route::post('/persons/create', 'PersonsController@insert')->name('persons.insert');
    Route::get('/persons/delete/{id}', 'PersonsController@delete')->name('persons.delete');
    Route::get('/persons/edit/{id}', 'PersonsController@edit')->name('persons.edit');
    Route::post('/persons/update/{id}', 'PersonsController@update')->name('persons.update');
    Route::post('/persons/phone/add/{id}', 'PersonsController@addPhone')->name('persons.addPhone');

    Route::get('/phones/delete/{id}', 'PersonsController@deletePhone')->name('phones.delete');
});
