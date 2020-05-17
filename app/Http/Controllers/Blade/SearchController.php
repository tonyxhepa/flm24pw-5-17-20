<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blade\MovieBladeResource;
use App\Http\Resources\Blade\SerieBladeResource;
use App\Models\Cast;
use App\Models\Movie;
use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        SEOMeta::setTitle('Filma24.pw | Filma me Titra Shqip HD - Shiko dhe shkarko filma me titra shqip FALAS!');
        SEOMeta::setDescription('Shiko dhe shkarko filma me titra shqip FALAS!');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Shiko dhe shkarko filma me titra shqip FALAS!');
        OpenGraph::setTitle('Filma24.pw | Filma me Titra Shqip HD - Shiko dhe shkarko filma me titra shqip FALAS!');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Filma24.pw | Filma me Titra Shqip HD - Shiko dhe shkarko filma me titra shqip FALAS!');

        if ($request->has('search')) {
            $get_movies = Movie::search($request->input('search'))->where('is_public', true)->get()
                ->map(function (Movie $movie){
                    $movie->slug = route('filma.show', $movie->slug);
                    $movie->poster_path = asset('storage/movie/'. $movie->poster_path);
                    $movie['type'] = 'Film';
                    return $movie;
                });
            $get_series = Serie::search($request->input('search'))->get()
                ->map(function (Serie $serie){
                    $serie->slug = route('filma.show', $serie->slug);
                    $serie->poster_path = asset('storage/serie/'. $serie->poster_path);
                    $serie['title'] = $serie->name;
                    $serie['type'] = 'Serial';
                    return $serie;
                });
            $get_actors = Cast::search($request->input('search'))->get()
                ->map(function (Cast $cast){
                    $cast->slug = route('filma.show', $cast->slug);
                    $cast->poster_path = asset('storage/cast/'. $cast->poster_path);
                    $cast['title'] = $cast->name;
                    $cast['type'] = 'Aktor';
                    return $cast;
                });
            $get_search = $get_movies->merge($get_series)->merge($get_actors);
            $search = (collect($get_search))->paginate(18);
            return view('search', compact('search'));
        } else {
            return redirect()->back();
        }
    }
}
