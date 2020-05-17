@extends('layouts.show')

@section('content')
    <div class="clearfix"></div>
    <section hidden>
        <h1>Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD</h1>
        <p>Seriale me titra shqip ne filma24.pw shiko serialet e fundit.  Seriale Turke me titra shqip. Episode te perditesuar ne kohe reale.</p>
    </section>
    <div class="clearfix"></div>
    <div id="search" class="container mx-auto my-3">
        <div class="clearfix"></div>
        @if(!empty($series))
            <div class="container bg-gray-700 p-4 mx-auto rounded-lg my-3">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
                    @foreach($series as $serie)
                        <div class="relative">
                            <a href="{{ route('seriale.show', $serie->slug) }}">
                                <img
                                    class="lazyload w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                    src="{{ asset('img/loader.jpg') }}"
                                    @if(Storage::exists('public/serie/'.$serie->poster_path))
                                    data-src="{{ asset('storage/serie/'.$serie->poster_path)  }}"
                                    @endif
                                    alt="{{ $serie->name}} me titra shqip"
                                    loading="lazy"
                                />
                            </a>
                            @if($serie->seasons)
                            <div class="absolute right-0 top-0 my-2 mx-1">
                        <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                            {{ count($serie->seasons) }} Sezone
                        </span>
                            </div>
                            @endif
                            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                                <a href="{{ route('seriale.show', $serie->slug) }}" class="w-full text-sm"><h2>{{ $serie->name}}</h2></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $series->links() }}
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
@endsection
