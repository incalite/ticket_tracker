<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');
    
});

// Ticket Routes
Route::get('ticket/new', 'ticketController@add');
Route::get('ticket/edit/{id}', 'ticketController@getTicket');
Route::get('ticket/update', 'ticketController@update');
Route::get('ticket/drop', 'ticketController@drop');
Route::get('ticket/fetch', 'ticketController@findTicket');

// Client Routes    
Route::get('clients', 'clientController@clients');
Route::get('client/view/{id}', 'clientController@viewClient');
Route::get('client/edit', 'clientController@editClient');
Route::get('client/new', 'clientController@new');


// Developers Routes 
Route::get('developers', 'devController@devs');











