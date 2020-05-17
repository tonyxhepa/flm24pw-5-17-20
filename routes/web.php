<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'Blade\SearchController@index')->name('search');
Route::get('/search/{search}', 'Blade\SearchController@apiSearch')->name('post-search');
Route::get('/', 'Blade\DefaultPagesController@welcome');
Route::get('/contact', 'Blade\DefaultPagesController@contact')->name('contact');
Route::get('/dmca', 'Blade\DefaultPagesController@dmca')->name('dmca');
Route::get('/privacy', 'Blade\DefaultPagesController@privacy')->name('privacy');
Route::get('/movie-list', 'Blade\DefaultPagesController@movieList')->name('movie-list');
Route::get('/serie-list', 'Blade\DefaultPagesController@serieList')->name('serie-list');

Route::get('/tags/{tag:slug}', 'Blade\TagsController@show')->name('tags.show');
Route::get('/genres/{genre:slug}', 'Blade\GenresController@show')->name('genres.show');

Route::get('/aktor', 'Blade\CastController@index')->name('aktor.index');
Route::get('/aktor/{slug}', 'Blade\CastController@show')->name('aktor.show');

Route::get('/filma', 'Blade\MoviesController@index')->name('filma.index');
Route::get('/filma/{slug}', 'Blade\MoviesController@show')->name('filma.show');

Route::get('/seriale', 'Blade\SeriesController@index')->name('seriale.index');
Route::get('/seriale/{slug}', 'Blade\SeriesController@show')->name('seriale.show');
Route::get('/seriale/{serie}/season/{slug}', 'Blade\SeasonsController@show')->name('seasons.show');
Route::get('/episodes/{episode:slug}', 'Blade\EpisodesController@show')->name('episodes.show');


Route::group([
    'middleware' => ['role:admin'],
    'prefix' => 'admin'
], function () {
    Route::get('/', 'AdminController@index')->name('admin-index');
    Route::get('/admin-movies', 'AdminController@movie')->name('admin-movie');
    Route::get('/admin-series', 'AdminController@serie')->name('admin-serie');
    Route::get('/admin-series/{serie:slug}/admin-seasons', 'AdminController@season')->name('admin-season');
    Route::get('/admin-series/{serie:slug}/admin-seasons/{season:slug}', 'AdminController@episode')->name('admin-episode');
    Route::get('/admin-casts', 'AdminController@cast')->name('admin-cast');
    Route::get('/admin-genres', 'AdminController@genre')->name('admin-genre');
    Route::get('/admin-tags', 'AdminController@tag')->name('admin-tag');
});

Route::post('/generate', 'Link\LinkController@generate')->name('url.generate');
Route::get('/r/{code}', 'Link\LinkController@showRedirect')->name('url.showRedirect');
Route::view('/short', 'shorten.short');
