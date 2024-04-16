<?php

use App\Livewire\Admin\AcceptCompetition;
use App\Livewire\Admin\ApplyForCompetition;
use App\Livewire\Admin\ManageCompetitionCategories;
use App\Livewire\Admin\ManageCompetitionTypes;
use App\Livewire\Admin\ManageNotifications;
use App\Livewire\Admin\Users;
use App\Livewire\Dashboard;
use App\Livewire\Ranking;
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
    Route::get('see-more-info', ApplyForCompetition::class)->name('apply');
    Route::get('view-submissions', \App\Livewire\ViewSubmissions::class)->name('all-submissions');
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::view('settings', 'profile.show')->name('settings');
    Route::get('ranking', Ranking::class)->name('ranking');

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function() {
        Route::get('manage-competition-categories', ManageCompetitionCategories::class)->name('compcat');
        Route::get('manage-notifications', ManageNotifications::class)->name('notifications');
        Route::get('manage-competition-types', ManageCompetitionTypes::class)->name('comptyp');
        Route::get('users', Users::class)->name('users');
        Route::get('accept-competition', AcceptCompetition::class)->name('accept-competition');
    });
});
