<?php

namespace App\Http\Livewire\Movie;

use App\Models\Movie;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        $movies = Movie::orderBy('updated_at', 'desc')->take(12)->get();

        return view('livewire.movie.welcome', ['movies' => $movies]);
    }
}
