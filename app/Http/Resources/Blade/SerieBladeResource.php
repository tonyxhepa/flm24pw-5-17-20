<?php

namespace App\Http\Resources\Blade;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieBladeResource extends JsonResource
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
            'url' => route('seriale.show', $this->slug),
            'poster_url' => $this->when($this->poster_path, function () {
                return asset('storage/serie/'.$this->poster_path);
            }),
            'no_poster' => asset('img/noimage.jpg'),
            'seasons_count' => count($this->seasons)
        ];
    }
}
