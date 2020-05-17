<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminSeasonResource extends JsonResource
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
            'season_number' => $this->season_number,
            'name'        => $this->name,
            'tmdb_id'   => $this->tmdb_id,
            'slug'     => $this->slug,
            'serie_slug' => $this->serie->slug,
            'episode_route' => route('admin-episode', [$this->serie->slug, $this->slug]),
            'poster_path' => $this->poster_path,
            'poster_url' => asset('storage/serie/season/'. $this->poster_path)
        ];
    }
}
