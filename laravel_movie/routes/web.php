<?php
	
	use Illuminate\Support\Facades\Route;
	use \App\Http\Controllers\MoviesController;
	use \App\Http\Controllers\PeopleController;
	use \App\Http\Controllers\TvController;
	
	Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
	Route::get('/movie/{id}', [MoviesController::class, 'show'])->name('movies.show');
	
	Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
	Route::get('/people/{id}', [PeopleController::class, 'show'])->name('people.show');
	Route::get('/people/page/{page?}', [PeopleController::class, 'index'])->name('people.page');
	
	Route::get('/tv', [TvController::class, 'index'])->name('tv.index');
	Route::get('/tv/{id}', [TvController::class, 'show'])->name('tv.show');