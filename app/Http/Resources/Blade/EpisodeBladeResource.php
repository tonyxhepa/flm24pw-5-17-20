<?php

namespace App\Http\Resources\Blade;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeBladeResource extends JsonResource
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
            'episode_number' => $this->episode_number,
            'season_number' => $this->season->season_number,
            'poster_url' => $this->when($this->season->poster_path, function () {
                return asset('storage/serie/season/'.$this->season->poster_path);
            }),
            'no_poster' => asset('img/noimage.jpg'),
            'visits'     => $this->visits,
            'url'        => route('episodes.show', $this->slug)
        ];
    }
}
