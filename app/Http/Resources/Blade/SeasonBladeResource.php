<?php

namespace App\Http\Resources\Blade;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonBladeResource extends JsonResource
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
            'url'     => route('seasons.show',[$this->serie->slug, $this->slug] ),
            'poster_url' => $this->when($this->poster_path, function () {
                return asset('storage/serie/season/'.$this->poster_path);
            }),
            'no_poster' => asset('img/noimage.jpg')
        ];
    }
}
