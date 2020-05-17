<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class DefaultPagesController extends Controller
{
    public function welcome()
    {
        SEOMeta::setTitle('Filma24 Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        SEOMeta::setDescription('Filma24 filma me titra shqip, Shikoni dhe shkakroni Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Shiko dhe shkarko filma me titra shqip FALAS!, Shiko Seriale Turke Me Titra Shqip');
        OpenGraph::setTitle('Filma24 Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        TwitterCard::setTitle('Filma24 Filma me Titra Shqip - Filma Aksion - Filma Erotik');

        return view('welcome');
    }
    public function contact()
    {
        return view('contact');
    }
    public function dmca()
    {
        return view('dmca');
    }
    public function privacy()
    {
        return view('privacy');
    }

    public function movieList()
    {
        $movies = Movie::published(true)->orderBy('created_at', 'desc')->paginate(18);

        return view('list', compact('movies'));
    }
    public function serieList()
    {
        $series = Serie::orderBy('created_at', 'desc')->paginate(18);

        return view('seriale-list', compact('series'));
    }
}
