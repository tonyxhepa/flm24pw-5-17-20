<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchSerieResource extends JsonResource
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
            'title'=> $this->name,
            'url'  => route('seriale.show', $this->slug),
            'poster_url' => asset('storage/serie/'.$this->poster_path),
            'seasons_count' => count($this->seasons)
        ];
    }
}
