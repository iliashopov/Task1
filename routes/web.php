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
 
  Route::get($uri, $callback);
  Route::post($uri, $callback);
  Route::put($uri, $callback);
  Route::patch($uri, $callback);
  Route::delete($uri, $callback);
  Route::options($uri, $callback);
  Route::any($uri, $callback);
 */
  
//dashboard:
Route::get('/dashboard-login', 'DashboardController@index');  
Route::get('/dashboard-signup', 'DashboardController@signup');  
Route::post('/dashboard', 'DashboardController@dashboard');  
Route::post('/dashboard-ajax', 'DashboardController@ajax');  
Route::post('/register', 'DashboardController@register');   
//dashboard^^^


