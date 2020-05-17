<?php

namespace App\View\Components;

use App\Models\Serie;
use Illuminate\View\Component;

class SerieList extends Component
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
        return view('components.serie-list');
    }

    public function series()
    {
        $series = Serie::orderBy('created_at', 'desc')->paginate(18);
        return $series;
    }
}
