<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\rankingController;
use App\Http\Controllers\UserController;
use App\Models\ranking;
use Illuminate\Http\Request; 

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
    $ranking = ranking::orderBy('high_score', 'DESC')->get();
    return view('score', [
        'ranking' => $ranking
    ]);
});
Route::delete('/score_del/{score}', function (ranking $score) {
    $score->delete();       
    return redirect('/');  
});

Route::get('/registration', [RegistrationController::class,'Registration']);
Route::get('/ranking', [rankingController::class,'ranking']);
Route::get('/ranking_get', [rankingController::class,'get']);
Route::get('/username_change', [UserController::class,'UserNameChange']);
Route::get('/userdata_get', [UserController::class,'GetUserData']);
Route::get('/socre_get', [rankingController::class,'GetUserScore']);

/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
