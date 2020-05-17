<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

class EpisodesController extends Controller
{
    public function show(Episode $episode)
    {
        SEOMeta::setTitle($episode->season->serie->name.' Episodi '. $episode->episode_number. ' me Titra Shqip filma24.pw');
        SEOMeta::setDescription($episode->season->serie->name .' me Titra Shqip. Shiko dhe shkarko Seriale me titra shqip FALAS!. Filma me titra shqip, Seriale turke. filma24.pw .');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $episode->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', $episode->name, 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription($episode->season->serie->name .' me Titra Shqip. Shiko dhe shkarko Seriale me titra shqip FALAS!. Filma me titra shqip, Seriale turke. filma24.pw .');
        OpenGraph::setTitle($episode->season->serie->name.' Episodi '. $episode->episode_number. ' me Titra Shqip filma24.pw');
        OpenGraph::addImage(url(asset('storage/serie/season/'. $episode->season->poster_path)));
        OpenGraph::addImage(url(asset('storage/serie/season/'. $episode->season->poster_path)), ['height' => 290, 'width' => 185]);

        $latest = Episode::orderBy('created_at', 'desc')->take(4)->get();
        $season = $episode->season;
        $episode->timestamps = false;
        $episode->increment('visits', 1);
        return view('episodes.show', compact('episode', 'season', 'latest'));
    }
}
