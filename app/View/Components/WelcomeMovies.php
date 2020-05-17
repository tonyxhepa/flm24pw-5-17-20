<?php

namespace App\View\Components;

use App\Http\Resources\Blade\MovieBladeResource;
use App\Models\Movie;
use App\Models\Tag;
use Illuminate\View\Component;

class WelcomeMovies extends Component
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
        return view('components.welcome-movies');
    }

    public function movies()
    {
        $tag = Tag::where('slug', 'welcome')->first();
        $get_movies = $tag->movies()->published(true)->orderBy('updated_at', 'desc')->take(12)->get();
        return MovieBladeResource::collection($get_movies);
    }
}
