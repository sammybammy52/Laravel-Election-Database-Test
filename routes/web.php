<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ElectionController;
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
    return view('welcome');
});

Route::get('/q1', [ElectionController::class, 'showPollingUnitResults']);
Route::get('/q2', [ElectionController::class, 'showLgaResultsView']);
Route::get('/q2/{lga_id}', [ElectionController::class, 'showLgaResults']);
Route::post('/q3', [ElectionController::class, 'insertResults']);
Route::get('/q3', [ElectionController::class, 'insertResultsView']);

