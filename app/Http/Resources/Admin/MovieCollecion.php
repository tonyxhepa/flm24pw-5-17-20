<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\AdminMovieResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieCollecion extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */




    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'data' => AdminMovieResource::collection($this),
            'pagination' => [
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'current_page' => $this->currentPage(),
                'next_page_url' => $this->nextPageUrl(),
                'prev_page_url' => $this->previousPageUrl(),
                'to'     => $this->lastItem(),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage()
                // customise your pagination here
                // https://laravel.com/docs/5.8/pagination#paginator-instance-methods
            ],
        ];
    }
}
