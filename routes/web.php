<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'login']);

Route::get('community/index', [App\Http\Controllers\CommunityController::class, 'index']);
Route::get('community/{community}/show', [App\Http\Controllers\CommunityController::class, 'show']);
Route::get('/communityregister/create', [App\Http\Controllers\CommunityRegisterController::class, 'create']);
Route::post('/communityregister', [App\Http\Controllers\CommunityRegisterController::class, 'store']);
Route::get('/communityregister/{community}/edit', [App\Http\Controllers\CommunityRegisterController::class, 'edit']);
Route::put('/communityregister/{community}', [App\Http\Controllers\CommunityRegisterController::class, 'update']);
Route::delete('/communityregister/{community}', [App\Http\Controllers\CommunityRegisterController::class, 'destroy']);
Route::post('/posts/{post}/likes', [App\Http\Controllers\LikesController::class, 'store']);
Route::post('/posts/{post}/likes/{like}',  [App\Http\Controllers\LikesController::class, 'destroy']);
Route::get('/communityregister/index', [App\Http\Controllers\CommunityRegisterController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
