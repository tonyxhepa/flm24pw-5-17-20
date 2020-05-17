<div class="container mx-auto bg-gray-700 rounded-lg">
    <section class="my-3 px-4 py-2 mx-auto">
        <div class="flex justify-between rounded-lg my-2 px-2 bg-yellow-700">
            <h2 class="text-gray-400 text-xl text-center p-2">Filmat e Fundit</h2>
        </div>
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
                            loading="lazy"
                            alt="{{ $serie->name}} me titra shqip"
                        />
                    </a>
                    <div class="absolute right-0 top-0 my-2 mx-1">
                        @if($serie->seasons)
                            <span
                                class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1"
                            >{{ count($serie->seasons) }} Sezone</span>
                            @endif
                    </div>
                    <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                        <a href="{{ route('seriale.show', $serie->slug) }}" class="w-full text-sm"><h2>{{ $serie->name}}</h2></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
