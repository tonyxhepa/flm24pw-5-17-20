@extends('layouts.show')

@section('content')
    <section id="search">
        <div class="clearfix"></div>
        <div id="movie-list" class="container mx-auto my-3">
            @if(!empty($movies))
                <div class="container bg-gray-900 p-4 mx-auto rounded-lg my-3">
                    <ul>
                        @foreach($movies as $movie)
                            @dd($movie)
                            <li class="p-2 bg-indigo-300">
                                <a class="w-full" href="{{ route('filma.show', $movie->slug) }}">{{ $movie->title }}</a>
                            </li>
                        @endforeach
                        {{ $movies->links() }}
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endsection

