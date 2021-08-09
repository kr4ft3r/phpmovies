<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

Route::group(['prefix'=>'/v1', 'middleware'=>'auth:api'], function() {
    Route::get('/movies/category/{category}', [MovieController::class, 'getByCategory'])->name('api.movies.category');
    Route::get('/movies/title/{title}', [MovieController::class, 'getByTitle'])->name('api.movies.title');
    Route::resource('movies', MovieController::class, ['except' => ['store','update','destroy']])->names(
        [
            'index' => 'api.movies',
            'show' => 'api.movies.show'
        ]
    );
});
