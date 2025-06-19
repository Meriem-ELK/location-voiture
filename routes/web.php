<?php
use App\Routes\Route;
use App\Controllers\HomeController;


// Routes pour la page d'accueil
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/home/index', 'HomeController@index');

// Routes pour les clients
Route::get('/clients', 'ClientController@index');
Route::get('/client/show', 'ClientController@show');
Route::get('/client/create', 'ClientController@create');
Route::post('/client/store', 'ClientController@store');
Route::get('/client/edit', 'ClientController@edit');
Route::post('/client/edit', 'ClientController@update');  // Pour les formulaires
Route::post('/client/delete', 'ClientController@delete');

// Routes pour les véhicules
Route::get('/vehicules', 'VehiculeController@index');
Route::get('/vehicule/show', 'VehiculeController@show');
Route::get('/vehicule/create', 'VehiculeController@create');
Route::post('/vehicule/store', 'VehiculeController@store');
Route::get('/vehicule/edit', 'VehiculeController@edit');
Route::post('/vehicule/edit', 'VehiculeController@update');
Route::post('/vehicule/delete', 'VehiculeController@delete');


// Routes pour les réservations
Route::get('/reservations', 'ReservationController@index');
Route::get('/reservations/show', 'ReservationController@show');
Route::get('/reservations/create', 'ReservationController@create');
Route::post('/reservations/store', 'ReservationController@store');
Route::get('/reservations/edit', 'ReservationController@edit');
Route::post('/reservations/delete', 'ReservationController@delete');

Route::dispatch();