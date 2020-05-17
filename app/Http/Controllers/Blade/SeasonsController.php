<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blade\EpisodeBladeResource;
use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;

class SeasonsController extends Controller
{
    public function show($serie_slug, $slug)
    {
        $serie = Serie::where('slug', $serie_slug)->firstOrFail();


        if (!empty($serie)){
            $season = $serie->seasons->where('slug', $slug)->first();

            SEOMeta::setTitle(Str::limit($serie->name. ' Sezoni '. $season->season_number. ' me Titra Shqip filma24.pw', 67));
            SEOMeta::setDescription($serie->name. ' Sezoni '. $season->season_number. ' me Titra Shqip. Shiko dhe shkarko Seriale me titra shqip FALAS! Seriale turke, Serialet dhe filmat e fundit.');
            SEOMeta::setCanonical(url()->current());
            SEOMeta::addMeta('article:published_time', $season->created_at->toW3CString(), 'property');
            SEOMeta::addMeta('og:locale', 'en_US', 'property');
            SEOMeta::addMeta('og:type', 'article', 'property');
            SEOMeta::addMeta('og:url', url()->current(), 'property');
            SEOMeta::addMeta('article:tag', 'Netflix', 'property');
            SEOMeta::addMeta('article:section', 'Series', 'property');
            SEOMeta::addMeta('og:site_name', 'filma24.pw | Seriale me titra shqip HD', 'property');
            OpenGraph::setDescription('Shiko dhe shkarko seriale me titra shqip FALAS!');
            OpenGraph::setTitle($serie->name. ' Sezoni '. $season->season_number. ' me Titra Shqip HD - Seriale me titra shqip HD!');
            OpenGraph::addImage(url(asset('storage/serie/season/'. $season->poster_path)));
            OpenGraph::addImage(url(asset('storage/serie/season/'. $season->poster_path)), ['height' => 290, 'width' => 185]);

            $get_episodes = $season->episodes()->paginate(18);
            $episodes = EpisodeBladeResource::collection($get_episodes);
            return view('series.seasons.show', compact('season', 'serie', 'episodes'));
        }
      return view('errors.404');
    }
}
