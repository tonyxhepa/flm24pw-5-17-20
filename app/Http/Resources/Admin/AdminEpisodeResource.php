<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminEpisodeResource extends JsonResource
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
            'tmdb_id'   => $this->tmdb_id,
            'is_public'     => $this->is_public,
            'slug'     => $this->slug,
            'visits'     => $this->visits,
            'overview'     => $this->overview
        ];
    }
}
