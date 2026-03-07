<?php

use Illuminate\Support\Facades\Route;

// Storage route
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    $file = file_get_contents($path);
    $type = mime_content_type($path);
    
    return response($file, 200)->header('Content-Type', $type);
})->where('folder', '.*')->where('filename', '.*');

Route::get('/', function () {
    return view('welcome');
});
