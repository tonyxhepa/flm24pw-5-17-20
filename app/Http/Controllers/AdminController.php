<?php

namespace App\Http\Controllers;

use App\Http\Resources\Admin\AdminCastResource;
use App\Http\Resources\Admin\AdminEpisodeResource;
use App\Http\Resources\Admin\AdminMovieResource;
use App\Http\Resources\Admin\AdminSeasonResource;
use App\Http\Resources\Admin\AdminSerieResource;
use App\Models\Cast;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Season;
use App\Models\Serie;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $movies = AdminMovieResource::collection(Movie::all());
        $series = AdminSerieResource::collection(Serie::all());
        $seasons = AdminSeasonResource::collection(Season::all());
        $episodes = AdminEpisodeResource::collection(Episode::all());
        $casts = AdminCastResource::collection(Cast::all());
        return view('admin.index', compact('users', 'movies', 'series', 'seasons', 'episodes', 'casts'));
    }
    public function movie()
    {
        return view('admin.movie.index');
    }
    public function serie()
    {
        return view('admin.serie.index');
    }

    public function season(Serie $serie)
    {
        return view('admin.serie.season.index', compact('serie'));
    }

    public function episode(Serie $serie, Season $season)
    {
        return view('admin.serie.episode.index', compact('serie', 'season'));
    }
    public function cast()
    {
        return view('admin.cast.index');
    }
    public function genre()
    {
        return view('admin.genre.index');
    }
    public function tag()
    {
        return view('admin.tag.index');
    }
}
