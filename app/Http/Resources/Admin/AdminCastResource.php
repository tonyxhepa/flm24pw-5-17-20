<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCastResource extends JsonResource
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
            'id' => $this->id,
            'tmdb_id' => $this->tmdb_id,
            'name' => $this->name,
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y'),
            'url' => route('admin-casts.show', $this->slug),
            'slug' => $this->slug,
            'poster_path' => $this->poster_path,
            'poster_url' => asset('storage/cast/'.$this->poster_path),
        ];
    }
}
