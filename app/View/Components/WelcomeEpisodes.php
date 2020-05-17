<?php

namespace App\View\Components;

use App\Http\Resources\Blade\EpisodeBladeResource;
use App\Models\Episode;
use Illuminate\View\Component;

class WelcomeEpisodes extends Component
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
        return view('components.welcome-episodes');
    }

    public function episodes()
    {
        $get_episodes = Episode::orderBy('created_at', 'desc')->take(12)->get();
        return EpisodeBladeResource::collection($get_episodes);
    }
}
