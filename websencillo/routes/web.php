<?php

use App\Http\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/status', function () {
    return ('Pong');
}); 

Route::resource('directories', DirectoryController::class);
