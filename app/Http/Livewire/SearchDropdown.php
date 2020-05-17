<?php

namespace App\Http\Livewire;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search;

    public function resetAll()
    {
        $this->search = '';

    }
    public function render()
    {
        $genres = Genre::all();
        $searchResults = [];
        if (strlen($this->search) >= 2){
            $get_movies = Movie::search($this->search)->where('is_public', true)->get()
                ->map(function (Movie $movie){
                    $movie->slug = route('filma.show', $movie->slug);
                    $movie->poster_path = asset('storage/movie/'. $movie->poster_path);
                    $movie['type'] = 'Film';
                    return $movie;
                });
            $get_series = Serie::search($this->search)->get()
                ->map(function (Serie $serie){
                    $serie->slug = route('seriale.show', $serie->slug);
                    $serie->poster_path = asset('storage/serie/'. $serie->poster_path);
                    $serie['title'] = $serie->name;
                    $serie['type'] = 'Serial';
                    return $serie;
                });
            $get_actors = Cast::search($this->search)->get()
                ->map(function (Cast $cast){
                    $cast->slug = route('aktor.show', $cast->slug);
                    $cast->poster_path = asset('storage/cast/'. $cast->poster_path);
                    $cast['title'] = $cast->name;
                    $cast['type'] = 'Aktor';
                    return $cast;
                });
            $searchResults = $get_movies->merge($get_series)->merge($get_actors);
        }
        return view('livewire.search-dropdown', ['genres' => $genres, 'searchResults' => collect($searchResults)->take(7)]);
    }
}
