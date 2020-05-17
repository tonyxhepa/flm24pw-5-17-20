@extends('layouts.show')

@section('content')
    <section id="search">
        <div class="clearfix"></div>
        <div id="serie-list" class="container mx-auto my-3">
            <h2 class="flex p-2 bg-black text-white font-bold">Serie List</h2>
            @if(!empty($series))
                <div class="container bg-gray-900 p-4 mx-auto rounded-lg my-3">
                    <ul>
                        @foreach($series as $serie)
                            <li class="p-2 bg-indigo-300">
                                <a class="w-full" href="{{ route('seriale.show', $serie->slug) }}">{{ $serie->name }}</a>
                            </li>
                        @endforeach
                        {{ $series->links() }}
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endsection

