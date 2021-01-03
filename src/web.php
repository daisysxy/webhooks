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

use Illuminate\Http\Request;

Route::any('/webhooks/handle', 'Sxy\Webhooks\Webhooks@handle');

Route::any('/webhooks/running', 'Sxy\Webhooks\Webhooks@printRunning');
