<?php

use App\Livewire\Admin\AcceptCompetition;
use App\Livewire\Admin\ApplyForCompetition;
use App\Livewire\Admin\ManageCompetitionCategories;
use App\Livewire\Admin\ManageCompetitionTypes;
use App\Livewire\Admin\ManageNotifications;
use App\Livewire\Admin\Users;
use App\Livewire\Dashboard;
use App\Livewire\Help;
use App\Livewire\Organiser\SendAnnouncement;
use App\Livewire\Ranking;
use App\Livewire\UploadEndProduct;
use App\Livewire\Welcome;
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
    Route::get('welcome', Welcome::class)->name('welcome');
    Route::get('help', Help::class)->name('help');
    Route::get('see-more-info', ApplyForCompetition::class)->name('apply');
    Route::get('view-submissions', \App\Livewire\ViewSubmissions::class)->name('all-submissions');
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::view('settings', 'profile.show')->name('settings');
    Route::get('ranking', Ranking::class)->name('ranking');
    Route::get('upload', UploadEndProduct::class)->name('upload');
    Route::get('propose-competition', \App\Livewire\ProposeCompetition::class)->name('propose-competition');
    Route::get('own-submissions', \App\Livewire\OwnSubmissions::class)->name('own-submissions');
    Route::get('submission', \App\Livewire\SubmissionPage::class)->name('submission');

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function() {
        Route::get('manage-competition-categories', ManageCompetitionCategories::class)->name('compcat');
        Route::get('manage-notifications', ManageNotifications::class)->name('notifications');
        Route::get('manage-competition-types', ManageCompetitionTypes::class)->name('comptyp');
        Route::get('users', Users::class)->name('users');
        Route::get('accept-competition', AcceptCompetition::class)->name('accept-competition');
    });
    Route::middleware(['organiser'])->group(function () {
        Route::get('announcement', SendAnnouncement::class)->name('announcement');
    });
});
