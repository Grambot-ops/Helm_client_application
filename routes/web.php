<?php

use App\Livewire\Admin\ApplyForCompetition;
use App\Livewire\Admin\ManageCompetitionTypes;
use App\Livewire\Dashboard;
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
    Route::get('manage-competition-categories', ManageCompetitionCategories::class)->name('compcat');
    Route::get('apply-for-competition', ApplyForCompetition::class)->name('apply');
    Route::get('manage-competition-types', ManageCompetitionTypes::class)->name('comptyp');
    Route::get('manage-notifications', \App\Livewire\ManageNotifications::class)->name('notifications');
    Route::get('view-submissions', \App\Livewire\ViewSubmissions::class)->name('all-submissions');
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::view('settings', 'profile.show')->name('settings');

    /* FIXME: wrap in admin middleware */
    Route::get('admin/users', Users::class)->name('users');
    Route::get('admin/accept-competition', \App\Livewire\AcceptCompetition::class)->name('accept-competition');
});
