<div class="container mx-auto bg-gray-700 rounded-lg">
    <section class="my-3 px-4 py-2 mx-auto">
        <div class="flex justify-between rounded-lg my-2 px-2 bg-yellow-700">
            <h2 class="text-gray-400 text-xl text-center p-2">Filmat e Fundit</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
            @foreach($movies as $movie)
                <div class="relative">
                    <a href="{{ route('filma.show', $movie->slug) }}">
                        <img
                            class="lazyload w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                            src="{{ asset('img/loader.jpg') }}"
                            @if(Storage::exists('public/movie/'.$movie->poster_path))
                            data-src="{{ asset('storage/movie/'.$movie->poster_path)  }}"
                            @endif
                            loading="lazy"
                            alt="{{ $movie->title}} me titra shqip"
                        />
                    </a>
                    <div class="absolute right-0 top-0 my-2 mx-1">
        <span
            class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1"
        >{{ $movie->video_format }}</span>
                    </div>
                    <div class="absolute flex flex-col left-0 top-0 my-2 mx-1">
                        <div class="flex py-1 w-full bg-gray-900 rounded text-xs px-1">
                            <svg viewBox="0 0 24 24" class="fill-current text-yellow-500 inline-block h-4 w-4">
                                <path
                                    d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"
                                />
                            </svg>
                            <span class="text-white font-bold">{{ $movie->rating}}</span>
                        </div>
                        <span
                            class="w-full py-1 bg-gray-900 text-white font-bold rounded text-xs mt-1 px-1"
                        >{{ $movie->release_date}}</span>
                    </div>
                    <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                        <a href="{{ route('filma.show', $movie->slug) }}" class="w-full text-sm"><h2>{{ $movie->title}}</h2></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
