<?php

namespace App\View\Components;

use App\Http\Resources\Blade\MovieBladeResource;
use App\Models\Movie;
use Illuminate\View\Component;

class Hidden extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.hidden');
    }

    public function movies()
    {
        $get_movies = Movie::published(true)->orderBy('updated_at', 'desc')->take(12)->get();

            return MovieBladeResource::collection($get_movies);

    }
}
