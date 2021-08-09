<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

Route::group(['prefix'=>'/api/v1/movies', 'middleware'=>'auth:api'], function() {
    Route::post('/category/{category}', [MovieController::class, 'getByCategory'])->name('api.movies.category');
    Route::post('/title/{title}', [MovieController::class, 'getByTitle'])->name('api.movies.title');
    Route::resource('movies', MovieController::class)->names(
        [
            'index' => 'api.movies',
            'show' => 'api.movies.show'
        ]
    );
});
