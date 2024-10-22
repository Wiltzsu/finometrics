<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

