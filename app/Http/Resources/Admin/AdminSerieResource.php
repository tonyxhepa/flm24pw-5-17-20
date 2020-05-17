<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminSerieResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'tmdb_id' => $this->tmdb_id,
            'first_air_date' => $this->created_year,
            'poster_path' => $this->poster_path,
            'poster_url' => asset('storage/serie/'. $this->poster_path),
            'seasons_route' => route('admin-season', $this->slug)
        ];
    }
}
