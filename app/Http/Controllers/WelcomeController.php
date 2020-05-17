<?php

namespace App\Http\Controllers;

use App\Http\Resources\Blade\BladeGenreResource;
use App\Http\Resources\Blade\EpisodeBladeResource;
use App\Http\Resources\Blade\MovieBladeResource;
use App\Http\Resources\Blade\SerieBladeResource;
use App\Http\Resources\SearchCastResource;
use App\Http\Resources\SearchResultResource;
use App\Http\Resources\SearchSerieResource;
use App\Models\Cast;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function movies()
    {
        $tag = Tag::where('slug', 'welcome')->first();
        $get_movies = $tag->movies()->published(true)->orderBy('updated_at', 'desc')->take(12)->get();
        return MovieBladeResource::collection($get_movies);
    }

    public function series()
    {
        $get_series = Serie::orderBy('created_at', 'desc')->take(6)->get();
        return SerieBladeResource::collection($get_series);
    }


    public function episodes()
    {
        $get_episodes = Episode::orderBy('created_at', 'desc')->published(true)->take(12)->get();
        return EpisodeBladeResource::collection($get_episodes);
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $get_movies = Movie::search($request->input('search'))->where('is_public', true)->get();
            $get_series = Serie::search($request->input('search'))->get();
            $get_actors = Cast::search($request->input('search'))->get();

            return response()->json([
               'movies' => SearchResultResource::collection($get_movies),
               'series' => SearchSerieResource::collection($get_series),
               'casts' => SearchCastResource::collection($get_actors),
               'all' => route('search', ['search' => $request->input('search')])
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function genres()
    {
        $genres = Genre::all();

        return BladeGenreResource::collection($genres);
    }
}
