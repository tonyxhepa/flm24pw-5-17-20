<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchCastResource extends JsonResource
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
            'url'  => route('aktor.show', $this->slug),
            'poster_url' => asset('storage/cast/'.$this->poster_path),
            'movies' => count($this->movies)
        ];
    }
}
