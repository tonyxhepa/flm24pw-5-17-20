<div id="navbar" class="navbar bg-gray-900 transition" >
    <div class="container mx-auto flex justify-between">
        <div class="block p-4 lg:text-xl text-teal-500 hover:text-gray-500 focus:outline-none focus:text-white font-bold">
            <a href="/">Filma24</a>
        </div>
        <div class="pl-2 py-2 flex-grow items-center" style="max-width: 500px">
            <form method="get" action="/search">
                <input
                    type="text"
                    name="search"
                    class="w-full bg-gray-700 focus:outline-none focus:bg-white focus:text-gray-900 text-gray-700 rounded-lg transition transition-ease-in transition-500 focus:outline-none focus:border-transparent p-2 navbarearance-none leading-normal text-xl"
                    placeholder="Kerko Filmin">
            </form>
        </div>
        <div class="dropdown p-4" x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" type="button"
                    class="text-sm lg:text-xl font-bold mr-2 text-teal-500 hover:bg-blue-800 hover:text-red-600 focus:outline-none">
                Menu
            </button>
            <div  x-show.transition="isOpen"
                  @click.away="isOpen = false" class="blog dropdown-content mt-2 bg-teal-800">
                <div class="row container mx-auto rounded-lg bg-teal-800">
                    <div class="header flex flex-wrap rounded-lg bg-gray-900">
                        <a href="{{ route('movies.index') }}" class="w-full md:w-1/3">
                            <div class="p-2 mt-2 mr-2 rounded-lg hover:bg-gray-500 hover:text-gray-900 bg-gray-700 text-yellow-500 text-center">Filma</div>
                        </a>
                        <a href="{{ route('series.index') }}" class="w-full md:w-1/3">
                            <div class="p-2 mt-2 mr-2 rounded-lg hover:bg-gray-500 hover:text-gray-900 bg-gray-700 text-yellow-500 text-center">Seriale</div>
                        </a> <a href="{{ route('casts.index') }}" class="w-full md:w-1/3">
                            <div class="p-2 mt-2 mr-2 rounded-lg hover:bg-gray-500 hover:text-gray-900 bg-gray-700 text-yellow-500 text-center">Aktoret</div>
                        </a>
                    </div>
                    @foreach($genres as $genre)
                        <div class="column">
                            <a class="rounded-lg py-1 px-4 bg-gray-800 hover:bg-gray-700 text-gray-500 mx-6 text-center" href="{{ route('genres.show', $genre->slug) }}">{{ $genre->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

