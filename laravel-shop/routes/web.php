<?php /** @noinspection PhpUndefinedClassInspection */

Auth::routes();

Route::get('/', 'PageController@index')->name('index');

Route::resource('catalog', 'CatalogController')->parameters([
    'catalog' => 'slug'
]);
