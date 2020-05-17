<?php

namespace App\View\Components;

use App\Models\Tag;
use Illuminate\View\Component;

class WelcomeTags extends Component
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
        return view('components.welcome-tags');
    }

    public function tags()
    {
        $tags = Tag::all();
        return $tags;
    }
}
