<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Здесь ты можешь зарегистрировать API-маршруты для своего приложения. Эти
| маршруты загружаются RouteServiceProvider и все они будут иметь
| префикс "/api".
|
*/

Route::get('/', [MainController::class, 'index'])->name('index');
