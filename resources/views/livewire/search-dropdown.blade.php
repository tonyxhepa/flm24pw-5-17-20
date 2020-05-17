<div class="relative">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 text-sm rounded-full w-full lg:w-64 px-4 mt-1 pl-8 py-1 focus:outline-none shadow-outline" placeholder="Kerko Fima Seriale Aktore"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if (strlen($search) >= 2)
        <div class="fixed top-0 left-0 right-0 bottom-0" wire:click="resetAll"></div>
        <div
            class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $res => $val)
                        <li class="flex hover:bg-gray-700 my-2 rounded-lg border-b border-gray-700">
                            <a class="w-full p-1 " href="{{ $val->slug }}">
                                <div class="flex">
                                    <img
                                        class="lazy w-12 h-16 rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                                        src="{{ asset('img/loader.jpg') }}"
                                        data-src="{{ asset('storage/movie/'.$val->poster_path)  }}"
                                        alt="serie poster"
                                    >
                                    <div class="ml-3">
                                        <div class="w-full text-gray-200 font-bold"> {{ $val->title }}</div>
                                        <div class="flex">
                                            <div class="mx-2 text-green-300 font-bold">{{ $val->type }}</div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <li class="flex bg-green-500 hover:bg-green-700 p-2 my-2 rounded-lg border-b border-gray-700">
                        <a class="pointer-events-auto w-full" href="{{ route('search', ['search' => $search]) }}">Me Shume</a> </li>
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
