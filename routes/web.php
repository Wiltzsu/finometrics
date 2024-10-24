<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/**
 * Home page.
 */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

/**
 * Population statistics page.
 */
Route::get('/population', [App\Http\Controllers\PopulationStatisticsController::class, 'index']);

/**
 * Employment statistics page.
 */
Route::get('/employment', [App\Http\Controllers\EmploymentController::class, 'index']);
