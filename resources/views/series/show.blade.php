@extends('layouts.show')

@section('content')
    <div class="clearfix"></div>
    <section id="serie-header-section">
        <div class="container mx-auto mt-3">
            <div class="flex justify-center md:flex-row flex-wrap rounded-lg bg-gray-700">
                <div class="w-full md:w-1/4 p-4 text-gray-200">
                    <div class="flex justify-center md:float-right">
                        <img class="lazyload w-16 h-16 md:w-24 md:h-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:opacity-75 transition transition-900 transition-ease-in bg-indigo"
                             src="{{ asset('img/loader.jpg') }}"
                             @if(Storage::exists('public/serie/'.$serie->poster_path))
                             data-src="{{ asset('storage/serie/'.$serie->poster_path)  }}"
                             @endif
                             alt="{{ $serie->name}} me titra shqip"
                             loading="lazy"
                        />
                    </div>
                </div>
                <div class="w-full md:w-3/4 p-4 text-center md:text-left">
                    <h1 class="text-lg text-yellow-300 font-bold mx-8">{{ $serie->name }} me titra shqip.</h1>
                    <div class="text-gray-300 mx-8">Ky serial ka {{ count($serie->seasons) }} Sezone.</div>
                    <p hidden>{{ $serie->name }} me Titra Shqip filma24.pw, Shiko dhe shkarko filma me titra shqip.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    @if(!empty($seasons))
        <div class="container bg-gray-700 p-4 mx-auto rounded-lg my-3">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
                @foreach($seasons as $season)
                    <div class="relative">
                        <a href="{{ route('seasons.show', [$serie->slug, $season->slug]) }}">
                            <img
                                class="lazyload w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                src="{{ asset('img/loader.jpg') }}"
                                @if(Storage::exists('public/serie/season/'.$season->poster_path))
                                data-src="{{ asset('storage/serie/season/'.$season->poster_path)  }}"
                                @endif
                                alt="{{ $season->season_number }} me titra shqip"
                                loading="lazy"
                            />
                        </a>
                        @if($season->episodes)
                            <div class="absolute right-0 top-0 my-2 mx-1">
                        <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                            {{ count($season->episodes) }} Episode
                        </span>
                            </div>
                        @endif
                        <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                            <a href="{{ route('seasons.show', [$serie->slug, $season->slug]) }}" class="w-full text-sm"><h2>{{ $season->name}}</h2></a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $seasons->links() }}
        </div>
    @endif
    <div class="clearfix"></div>
@endsection

