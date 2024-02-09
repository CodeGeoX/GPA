<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursController;
use App\Http\Controllers\FestiuController;
use App\Http\Controllers\TrimestreController;
use App\Http\Controllers\CalendarController;


Route::get('/', function () {
    return view('generarcalendario');
});

Route::resource('cursos', CursController::class);
Route::resource('festius', FestiuController::class);
Route::resource('trimestres', TrimestreController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/curs', [CursController::class, 'store'])->name('curs.store');
});

Route::get('/curs/{curs}/show-days', [CursController::class, 'showDays'])->name('curs.showDays');



require __DIR__.'/auth.php';

