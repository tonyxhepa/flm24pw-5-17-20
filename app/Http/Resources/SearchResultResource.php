<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResultResource extends JsonResource
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
            'title'=> $this->title,
            'url'  => route('filma.show', $this->slug),
            'release_date' => date('Y', strtotime($this->release_date)),
            'poster_url' => asset('storage/movie/'.$this->poster_path),
            'runtime'  => $this->runtime
        ];
    }
}
