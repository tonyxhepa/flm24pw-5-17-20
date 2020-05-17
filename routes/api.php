<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/search', 'WelcomeController@search');
Route::get('/genres', 'WelcomeController@genres');
Route::get('/welcome-movies', 'WelcomeController@movies');
Route::get('/welcome-series', 'WelcomeController@series');
Route::get('/welcome-episodes', 'WelcomeController@episodes');
Route::get('/movie-index', 'Blade\MoviesController@index');


Route::group([
    'middleware' => ['auth:sanctum','role:admin'],
    'prefix' => 'admin'
], function () {
    Route::get('/admin-movie-casts', 'Admin\ApiCastController@movieCasts');
    Route::ApiResource('/admin-genres', 'Admin\ApiGenreController');
    Route::ApiResource('/admin-casts', 'Admin\ApiCastController');
    Route::ApiResource('/admin-tags', 'Admin\ApiTagController');
    Route::ApiResource('/admin-series', 'Admin\ApiSerieController');
    Route::ApiResource('/admin-movies', 'Admin\ApiMovieController');
    Route::get('/admin-movies/{movie:slug}/watchUrl', 'Admin\ApiMovieController@watchUrl');
    Route::get('/admin-movies/{movie:slug}/downloadUrl', 'Admin\ApiMovieController@downloadUrl');
    Route::get('/admin-movies/{movie:slug}/embedUrl', 'Admin\ApiMovieController@embedUrl');
    Route::get('/admin-movies/{movie:slug}/trailerUrl', 'Admin\ApiMovieController@trailerUrl');
    Route::post('/admin-movies/{movie:slug}/addEmbedUrl', 'Admin\ApiMovieController@addEmbedUrl');
    Route::post('/admin-movies/{movie:slug}/addTrailerUrl', 'Admin\ApiMovieController@addTrailerUrl');
    Route::post('/admin-movies/{movie:slug}/addWatchUrl', 'Admin\ApiMovieController@addWatchUrl');
    Route::post('/admin-movies/{movie:slug}/addDownloadUrl', 'Admin\ApiMovieController@addDownloadUrl');
    Route::ApiResource('/admin-series/{serie:slug}/admin-seasons', 'Admin\ApiSeasonController');
    Route::ApiResource('/admin-series/{serie:slug}/admin-seasons/{season:slug}/admin-episodes', 'Admin\ApiEpisodeController');
    Route::get('/admin-episodes/{episode:slug}/watchUrl', 'Admin\ApiEpisodeController@watchUrl');
    Route::get('/admin-episodes/{episode:slug}/downloadUrl', 'Admin\ApiEpisodeController@downloadUrl');
    Route::get('/admin-episodes/{episode:slug}/embedUrl', 'Admin\ApiEpisodeController@embedUrl');
    Route::post('/admin-episodes/{episode:slug}/addEmbedUrl', 'Admin\ApiEpisodeController@addEmbedUrl');
    Route::post('/admin-episodes/{episode:slug}/addWatchUrl', 'Admin\ApiEpisodeController@addWatchUrl');
    Route::post('/admin-episodes/{episode:slug}/addDownloadUrl', 'Admin\ApiEpisodeController@addDownloadUrl');
    Route::delete('/admin-embed/{embedUrl:id}', 'Admin\ApiEmbedController@destroy');
    Route::delete('/admin-watchUrl/{watchUrl:id}', 'Admin\ApiWatchController@destroy');
    Route::delete('/admin-download/{downloadUrl:id}', 'Admin\ApiDownloadController@destroy');
    Route::delete('/admin-trailer/{trailerUrl:id}', 'Admin\ApiTrailerController@destroy');

});
