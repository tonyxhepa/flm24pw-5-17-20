<?php

namespace App\Http\Resources\Blade;

use Illuminate\Http\Resources\Json\JsonResource;

class BladeGenreResource extends JsonResource
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
            'name' => $this->title,
            'url' => route('genres.show', $this->slug)
        ];
    }
}
