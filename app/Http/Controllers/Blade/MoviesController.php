<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blade\MovieBladeCollection;
use App\Http\Resources\Blade\MovieBladeResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;

class MoviesController extends Controller
{

    public function index(Request $request)
    {
        SEOMeta::setTitle('Filmat e fundit me Titra Shqip - Filma Aksion - Filma Erotik Filma24.');
        SEOMeta::setDescription('Filmat e fundit me titra shqip, Shikoni dhe shkakroni Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip Filma24.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Filma24.pw filma me titra shqip, Shikoni dhe shkakroni Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        OpenGraph::setTitle('Filma24.pw Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        TwitterCard::setTitle('Filma24.pw Filma me Titra Shqip - Filma Aksion - Filma Erotik');

       $movies = QueryBuilder::for(Movie::class)
           ->defaultSort('-updated_at')
           ->allowedSorts(['updated_at', 'visits', 'rating', 'release_date'])
           ->where('is_public', true)
           ->paginate(18)
           ->appends(request()->query());

       return view('movies.index', compact('movies'));
    }
    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle(Str::limit( $movie->title. ' me Titra Shqip filma24.pw', 68, '.'));
        SEOMeta::setDescription(Str::limit($movie->title .' me titra shqip filma24.pw '.$movie->overview, 150));
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $movie->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', $movie->genres->first()->title, 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription(Str::limit($movie->title .' me titra shqip filma24.pw '.$movie->overview, 150));
        OpenGraph::setTitle(Str::limit( $movie->title. ' me Titra Shqip filma24.pw', 68, '.'));
        OpenGraph::addImage(url(asset('storage/movie/'. $movie->poster_path)));
        OpenGraph::addImage(url(asset('storage/movie/'. $movie->poster_path)), ['height' => 290, 'width' => 185]);

        $movie->timestamps = false;
        $movie->increment('visits', 1);

        $latest = Movie::orderBy('created_at', 'desc')->published(true)->take(12)->get();
        return view('movies.show', compact('movie', 'latest'));
    }
}
