<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blade\MovieBladeResource;
use App\Models\Tag;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        SEOMeta::setTitle(Str::limit($tag->tag_name. ' filma me Titra Shqip HD filma24 Filma Indian.', 67));
        SEOMeta::setDescription($tag->tag_name. ' Shiko dhe shkarko filma me titra shqip. Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $tag->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', 'Movie', 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription($tag->tag_name. ' Shiko dhe shkarko filma me titra shqip. Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        OpenGraph::setTitle($tag->tag_name. ' filma me Titra Shqip HD filma24');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        $get_movies = $tag->movies()->orderBy('updated_at', 'desc')->published(true)->paginate(18);
        $movies = MovieBladeResource::collection($get_movies);

        return view('tags.show', compact('tag', 'movies'));
    }
}
