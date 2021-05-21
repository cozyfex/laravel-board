<?php

# Board
use CozyFex\LaravelBoard\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->resource('board', BoardController::class);
