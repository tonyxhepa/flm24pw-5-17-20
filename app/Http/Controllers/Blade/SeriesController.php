<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blade\SeasonBladeResource;
use App\Http\Resources\Blade\SerieBladeResource;
use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Str;

class SeriesController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD');
        SEOMeta::setDescription('Filma24.pw filma me titra shqip, Shikoni dhe shkakroni Seriale me titra shqip, Seriale Turke me titra shqip HD, Episodet e perditesuara ne kohe reale.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Filma24.pw filma me titra shqip, Shikoni dhe shkakroni Seriale me titra shqip, Seriale Turke me titra shqip HD, Episodet e perditesuara ne kohe reale.');
        OpenGraph::setTitle('Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        TwitterCard::setTitle('Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD');

        $get_series = Serie::orderBy('created_at', 'desc')->paginate(18);
        $series = SerieBladeResource::collection($get_series);

        return view('series.index', compact('series'));
    }
    public function show($slug)
    {
        $serie = Serie::where('slug', $slug)->firstOrFail();
        SEOMeta::setTitle(Str::limit($serie->name. ' me Titra Shqip HD - Seriale me titra shqip.', 67, '...'));
        SEOMeta::setDescription($serie->name.' me Titra Shqip filma24.pw, Shiko dhe shkarko filma me titra shqip. Seriale turke, Serialet dhe filmat e fundit.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $serie->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', 'Series', 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription($serie->name.' me Titra Shqip filma24.pw, Shiko dhe shkarko filma me titra shqip. Seriale turke, Serialet dhe filmat e fundit.');
        OpenGraph::setTitle(Str::limit($serie->name. ' me Titra Shqip HD - Seriale me titra shqip.', 67, '...'));
        OpenGraph::addImage(url(asset('storage/serie/'.$serie->poster_path)));
        OpenGraph::addImage(url(asset('storage/serie/'.$serie->poster_path)), ['height' => 290, 'width' => 185]);

        if (!empty($serie)){
            $seasons = $serie->seasons()->paginate(18);

            $serie->timestamps = false;
            $serie->increment('visits', 1);
            return view('series.show', compact('serie', 'seasons'));
        }
        return redirect()->back();
    }
}
