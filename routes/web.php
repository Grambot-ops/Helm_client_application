<?php

use App\Livewire\Admin\Users;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('admin/users', Users::class)->name('users');
//Route::middleware(['auth','admin','active'])->prefix('admin')->name('admin.')->group(function () {
//    Route::redirect('/', '/admin/users');
//    Route::get('records', Users::class)->name('users');
//});
