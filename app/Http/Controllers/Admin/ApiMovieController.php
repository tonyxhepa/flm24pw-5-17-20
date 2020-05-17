<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDownloadRequest;
use App\Http\Requests\CreateEmbedRequest;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\CreateTrailerRequest;
use App\Http\Requests\CreateWatchRequest;
use App\Http\Resources\Admin\AdminDownloadResource;
use App\Http\Resources\Admin\AdminEmbedResource;
use App\Http\Resources\Admin\AdminMovieResource;
use App\Http\Resources\Admin\AdminTrailerResource;
use App\Http\Resources\Admin\AdminWatchResource;
use App\Http\Resources\Admin\MovieCollecion;
use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApiMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = ['tmdb_id', 'title', 'is_public', 'visits', 'video_format', 'updated_at'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Movie::orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('is_public', 'like', '%' . $searchValue . '%');
            });
        }

        $movies = new MovieCollecion($query->paginate($length));
        return ['data' => $movies, 'draw' => $request->input('draw')];
//        $movies = Movie::orderBy('created_at', 'desc')->get();
//
//        return AdminMovieResource::collection($movies);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Movie::where('tmdb_id', $request->tmdb_id)->exists()){
            return response('Movie exists');
        }

        $tmdb_movie = Http::get('https://api.themoviedb.org/3/movie/'. $request->tmdb_id .'?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US')
            ->json();
        if ($tmdb_movie){
            $img_url = 'https://image.tmdb.org/t/p/w185'.$tmdb_movie['poster_path'];
            $contents = file_get_contents($img_url);
            $name = substr($img_url, strrpos($img_url, '/') + 1);
            Storage::put('public/movie/'.$name, $contents);

            $movie = Movie::create([
                'tmdb_id' => $tmdb_movie['id'],
                'title' => $tmdb_movie['title'].' '.  Carbon::parse($tmdb_movie['release_date'])->format('Y'),
                'runtime' => $tmdb_movie['runtime'],
                'rating' => $tmdb_movie['vote_average'],
                'release_date' => $tmdb_movie['release_date'],
                'lang' => $tmdb_movie['original_language'],
                'video_format' => 'HD',
                'is_public' => false,
                'overview' => $tmdb_movie['overview'],
                'poster_path' => '/'.$name,
                'backdrop_path' => $tmdb_movie['backdrop_path']
            ]);

            if ($tmdb_movie['genres']){
                $tmdb_genres = $tmdb_movie['genres'];
                $tmdb_genres_id = collect($tmdb_genres)->pluck('id');
                $genres = Genre::whereIn('tmdb_id',$tmdb_genres_id)->get();
                $movie->genres()->attach($genres);
            }
            if ($tmdb_movie['video']){
                $movie->trailers()->create([
                    'web_name' => 'triler',
                    'web_url' => 'https://www.youtube.com/embed/'. $tmdb_movie['video'],
                ]);
            }
            $this->get_cats($request->tmdb_id);
              return response('Movie Created');
        }else {
            return response('Movie Not created');
        }
    }

    public function get_cats($id)
    {
        $tmdb_cast_res = Http::get('https://api.themoviedb.org/3/movie/'. $id .'/credits?api_key=8a11aac3fb4ef5f1f9607ee7e0329793')
            ->json()['cast'];
        $tmdb_cast = collect($tmdb_cast_res)->pluck('id');

        $movie = Movie::where('tmdb_id', $id)->first();
        $casts = Cast::whereIn('tmdb_id', $tmdb_cast)->get();
        if (!empty($casts)){
            $movie->casts()->attach($casts);
        }
        $tmdb_video_res = Http::get('https://api.themoviedb.org/3/movie/'. $id .'/videos?api_key=8a11aac3fb4ef5f1f9607ee7e0329793')
            ->json()['results'];
        if (!empty($tmdb_video_res && $tmdb_video_res[0]['site'] == 'YouTube')){
            $movie->trailers()->create([
                'web_name' => 'trailer',
                'web_url' => 'https://www.youtube.com/embed/'. $tmdb_video_res[0]['key'],
            ]);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();

        if ($request->has('genres')){
            $movie->genres()->sync($request->genres);
        }
        if ($request->has('casts')){
            $movie->casts()->sync($request->casts);
        }
        if ($request->has('tags')){
            $movie->tags()->sync($request->tags);
        }

        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        if ('/'.$name === $movie->poster_path){

            $movie->update([
                'tmdb_id' => $request->tmdb_id,
                'title' => $request->title,
                'runtime' => $request->runtime,
                'rating' => $request->rating,
                'release_date' => $request->release_date,
                'lang' => $request->lang,
                'video_format' => $request->video_format,
                'is_public' => $request->is_public,
                'overview' => $request->overview,
                'poster_path' => '/'.$name,
                'backdrop_path' => $request->backdrop_path,
                'slug' => $movie->slug.'-me-titra-shqip'
            ]);
            return response('Movie Updated ');
        }else{
            $contents = file_get_contents($request->poster_path);
            Storage::delete('public/movie/'. $movie->poster_path);
            $save = Storage::put('public/movie/'.$name, $contents);
            if ($save){
                $movie->update([
                    'tmdb_id' => $request->tmdb_id,
                    'title' => $request->title,
                    'runtime' => $request->runtime,
                    'rating' => $request->rating,
                    'release_date' => $request->release_date,
                    'lang' => $request->lang,
                    'video_format' => $request->video_format,
                    'is_public' => $request->is_public,
                    'overview' => $request->overview,
                    'poster_path' => '/'.$name,
                    'backdrop_path' => $request->backdrop_path,
                    'slug' => $movie->slug.'-me-titra-shqip'
                ]);
                return response('Movie Updated and File Stored');
            }
        }

        return response('Movie not Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        Storage::delete('public/movie/'. $movie->poster_path);
        if ($movie->seasons){
            foreach ($movie->seasons as $season){
                Storage::delete('public/movie/'. $season->poster_path);
            }
        }
        $movie->delete();
        return response('Movie Deleted');
    }
    public function addWatchUrl($slug, CreateWatchRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();

        $movie->watchs()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

        return response('Watch url Added ');
    }
    public function addTrailerUrl($slug, CreateTrailerRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();

        $movie->trailers()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

        return response('Trailer url Added ');
    }
    public function addEmbedUrl($slug, CreateEmbedRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();
        $movie->embeds()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Embed url Added');
    }
    public function addDownloadUrl($slug, CreateDownloadRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();
        $movie->downloads()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Downloaded url Added');
    }

    public function watchUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminWatchResource::collection($movie->watchs);
    }
    public function downloadUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminDownloadResource::collection($movie->downloads);
    }
    public function embedUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminEmbedResource::collection($movie->embeds);
    }
    public function trailerUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminTrailerResource::collection($movie->trailers);
    }
}
