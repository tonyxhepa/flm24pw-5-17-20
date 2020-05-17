<?php

namespace App\Http\Resources\Blade;

use Illuminate\Http\Resources\Json\JsonResource;

class CastBladeResource extends JsonResource
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
            'url' => route('aktor.show', $this->slug),
            'poster_url' => $this->when($this->poster_path, function () {
                return asset('storage/cast/'.$this->poster_path);
            }),
            'no_poster' => asset('img/noimage.jpg')
        ];
    }
}
