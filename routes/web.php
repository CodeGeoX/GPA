<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursController;
use App\Http\Controllers\FestiuController;
use App\Http\Controllers\TrimestreController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CicleController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\UfController;


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
Route::get('/cursos/{curs}/export', [CursController::class, 'exportToJson'])->name('cursos.export');
// Add routes for Festiu form and storage
Route::get('/curs/{cursId}/festiu', [CursController::class, 'createFestiuForm'])->name('curs.createFestiu');
Route::post('/curs/{cursId}/festiu', [CursController::class, 'storeFestiu'])->name('curs.storeFestiu');

Route::get('/cicles/create', [CicleController::class, 'create'])->name('cicles.create');
Route::post('/cicles', [CicleController::class, 'store'])->name('cicles.store');
Route::get('/cicles', [CicleController::class, 'index'])->name('cicles.index');
Route::get('/moduls/create/{cursid}', [ModulController::class, 'create'])->name('moduls.create');
Route::post('/moduls', [ModulController::class, 'store'])->name('moduls.store');

Route::get('/ufs/create/{cicle_id}/{modul_id}', [UfController::class, 'create'])->name('ufs.create');
Route::post('/ufs', [UfController::class, 'store'])->name('ufs.store');


require __DIR__.'/auth.php';

