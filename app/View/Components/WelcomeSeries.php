<?php

namespace App\View\Components;

use App\Http\Resources\Blade\SerieBladeResource;
use App\Models\Serie;
use Illuminate\View\Component;

class WelcomeSeries extends Component
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
        return view('components.welcome-series');
    }


    public function series()
    {
        $get_series = Serie::orderBy('created_at', 'desc')->take(6)->get();
        return SerieBladeResource::collection($get_series);

    }
}
