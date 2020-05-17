<?php

namespace App\View\Components;

use App\Models\Movie;
use Illuminate\View\Component;

class MovieList extends Component
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
        return view('components.movie-list');
    }

    public function movies()
    {
        $movies = Movie::published(true)->orderBy('created_at', 'desc')->paginate(18);
        return $movies;
    }
}
