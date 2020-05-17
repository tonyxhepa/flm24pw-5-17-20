@extends('layouts.show')

@section('content')
    <section id="search">
        <div class="clearfix"></div>
        <div class="container mx-auto bg-gray-900 my-4 p-2 rounded-lg">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
                @foreach($search as $s)
                    <div class="relative">
                        <a href="{{ $s->slug }}">
                            <img
                                class="lazyload w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                src="{{ asset('img/loader.jpg') }}"
                                data-src="{{ $s->poster_path }}"
                                loading="lazy"
                                alt="{{ $s->title}}"
                            />
                        </a>
                        <div class="absolute right-0 top-0 my-2 mx-1">
                          <span
                           class="py-1 bg-yellow-300 text-black rounded font-bold px-1"
                          >{{ $s->type}}</span>
                        </div>
                        <div class="inset-x-0 absolute flex bottom-0 bg-yellow-800 bg-movie p-2 font-bold rounded-lg">
                            <a href="{{ $s->slug }}" class="w-full text-sm">{{ $s->title}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center">
                {{ $search->appends(request()->except('page'))->links()}}
            </div>
        </div>

    </section>
    <section hidden>
        <x-hidden></x-hidden>
    </section>
@endsection

