<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\OrganizationController;
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

//Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Account/show', [OrganizationController::class, 'show']);
Route::post('/Account/store', [OrganizationController::class, 'store']);//post
Route::post('/Account/update', [OrganizationController::class, 'update']);//post
Route::get('/Account/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get

Route::get('/Organization/show', [OrganizationController::class, 'show']);
Route::post('/Organization/store', [OrganizationController::class, 'store']);//post
Route::post('/Organization/update', [OrganizationController::class, 'update']);//post
Route::get('/Organization/delete', [OrganizationController::class, 'delete']);//post or get
