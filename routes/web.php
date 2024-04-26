<?php
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\AffectationHistoryController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('employees', EmployeeController::class);
    Route::resource('affectations', AffectationController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('histories', HistoryController::class);
    Route::resource('instalation', InstallationController::class);
    Route::resource('phones', PhoneController::class);
    Route::resource('affectation-history', AffectationHistoryController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
