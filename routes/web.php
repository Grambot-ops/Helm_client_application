<?php


use App\Livewire\Admin\Users;
use App\Models\User;
use App\Livewire\ManageCompetitionCategories;
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

Route::middleware(['auth'])->group(function() {
    Route::view('/', 'home')->name('home');
    Route::get('manage-competition-categories', ManageCompetitionCategories::class)->name('compcat');
    Route::get('manage-notifications', \App\Livewire\ManageNotifications::class)->name('notifications');
});

Route::get('admin/users', Users::class)->name('users');
//Route::middleware(['auth','admin','active'])->prefix('admin')->name('admin.')->group(function () {
//    Route::redirect('/', '/admin/users');
//    Route::get('records', Users::class)->name('users');
//});
