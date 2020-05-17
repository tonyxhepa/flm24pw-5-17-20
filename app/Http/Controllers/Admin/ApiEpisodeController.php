<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDownloadRequest;
use App\Http\Requests\CreateEmbedRequest;
use App\Http\Requests\CreateEpisodeRequest;
use App\Http\Requests\CreateWatchRequest;
use App\Http\Resources\Admin\AdminDownloadResource;
use App\Http\Resources\Admin\AdminEmbedResource;
use App\Http\Resources\Admin\AdminEpisodeResource;
use App\Http\Resources\Admin\AdminWatchResource;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;

class ApiEpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Serie $serie, Season $season)
    {
        $episodes = Episode::orderBy('created_at', 'desc')->where('season_id', $season->id)->get();
        return AdminEpisodeResource::collection( $episodes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Serie $serie, Season $season, CreateEpisodeRequest $request)
    {
        $season->episodes()->create([
            'tmdb_id' => $request->tmdb_id,
            'episode_number' => $request->episode_number,
            'name' => $request->name,
            'overview' => $request->overview,
        ]);
        return response('Created');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie, Season $season, $slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        $episode->update([
            'tmdb_id' => $request->tmdb_id,
            'episode_number' => $request->episode_number,
            'name' => $request->name,
            'is_public' => $request->is_public,
            'overview' => $request->overview
        ]);
        return response('Updated ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie, Season $season, $slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        $episode->delete();
        return response('u fshije');
    }

    public function addWatchUrl($slug, CreateWatchRequest $request)
    {
        $episode = Episode::where('slug', $slug)->first();

        $episode->watchs()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

        return response('watch url Added ');
    }
    public function addEmbedUrl($slug, CreateEmbedRequest $request)
    {
        $episode = Episode::where('slug', $slug)->first();
        $episode->embeds()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Embed Added');
    }
    public function addDownloadUrl($slug, CreateDownloadRequest $request)
    {
        $episode = Episode::where('slug', $slug)->first();
        $episode->downloads()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

    }

    public function watchUrl($slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        return AdminWatchResource::collection($episode->watchs);
    }
    public function downloadUrl($slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        return AdminDownloadResource::collection($episode->downloads);
    }
    public function embedUrl($slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        return AdminEmbedResource::collection($episode->embeds);
    }
}
