<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminMovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tmdb_id'=> $this->tmdb_id,
            'title'=> $this->title,
            'slug'=> $this->slug,
            'release_date'=> $this->release_date,
            'runtime'=> $this->runtime,
            'lang'=> $this->lang,
            'is_public'=> $this->is_public,
            'visits'=> $this->visits,
            'video_format'=> $this->video_format,
            'rating'=> $this->rating,
            'overview'=> $this->overview,
            'updated_at'=> Carbon::parse($this->updated_at)->format('d/m/Y'),
            'poster_path'=> $this->poster_path,
            'backdrop_path' => $this->backdrop_path,
            'genres' => AdminGenreResource::collection($this->genres),
            'casts' => AdminCastResource::collection($this->casts),
            'tags' => AdminTagResource::collection($this->tags),
            'poster_url' => asset('storage/movie/'.$this->poster_path)
        ];
    }
}
