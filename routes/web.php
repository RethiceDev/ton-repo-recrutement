<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistreController;

Route::get('/', [RegistreController::class, 'create'])->name('recrutement.create');
Route::post('/', [RegistreController::class, 'store'])->name('recrutement.store');
