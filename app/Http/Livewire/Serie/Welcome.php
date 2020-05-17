<?php

namespace App\Http\Livewire\Serie;

use App\Models\Serie;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        $series = Serie::orderBy('updated_at', 'desc')->take(12)->get();

        return view('livewire.serie.welcome', compact('series'));
    }
}
