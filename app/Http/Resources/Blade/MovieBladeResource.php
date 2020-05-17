<?php

namespace App\Http\Resources\Blade;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieBladeResource extends JsonResource
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
            'release_date'=> date('Y', strtotime($this->release_date)),
            'runtime'=> $this->runtime,
            'lang'=> $this->lang,
            'is_public'=> $this->is_public,
            'visits'=> $this->visits,
            'video_format'=> $this->video_format,
            'rating'=> $this->rating,
            'overview'=> $this->overview,
            'poster_url' => $this->when($this->poster_path, function () {
                return asset('storage/movie/'.$this->poster_path);
            }),
            'no_poster' => asset('img/noimage.jpg')
        ];
    }
}
