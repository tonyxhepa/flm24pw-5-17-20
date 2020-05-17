<div class="bg-gray-800">
    <section class="container mx-auto p-8">
        <div class="flex flex-wrap">
                <a class="p-2 m-1 bg-yellow-800 hover:bg-yellow-900" href="/movie-list">Filmat</a>
                <a class="p-2 m-1 bg-yellow-800 hover:bg-yellow-900" href="/serie-list">Serialet</a>
                <a class="p-2 m-1 bg-yellow-800 hover:bg-yellow-900" href="/short">Short</a>
            <a class="p-2 m-1 bg-yellow-800 hover:bg-yellow-900" href="/short">Short</a>
            <a class="p-2 m-1 bg-yellow-800 hover:bg-yellow-900" href="/privacy">Privacy</a>
            <a class="p-2 m-1 bg-yellow-800 hover:bg-yellow-900" href="/contact">Contact</a>
        </div>
        <div class="flex p-2">
            <p>Disclaimer: This site does not store any files on its server! All contents are provided by non-affiliated third parties! </p>
        </div>
        <div class="w-full p-2 bg-movie">
            Copyright © 2020 | FILMA24
        </div>
    </section>
    <section>
        <div class="bg-gray-900 shadow-lg h-12 fixed bottom-0 mt-12 md:hidden z-10 w-full md:w-48">
            <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                    <li class="mr-3 flex-1">
                        <a href="/" class="block pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-yellow-800 hover:border-purple-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-yellow-500 inline-block h-4 w-4" viewBox="0 0 20 20">
                                <path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
                            <span class="text-sm text-yellow-600 md:text-yellow-400 block md:hidden">Home</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="{{ route('filma.index') }}" class="block pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-yellow-800 hover:border-pink-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-yellow-500 inline-block h-4 w-4" viewBox="0 0 20 20">
                                <path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm6 0v12h8V4H6zM2 5v2h2V5H2zm0 4v2h2V9H2zm0 4v2h2v-2H2zm14-8v2h2V5h-2zm0 4v2h2V9h-2zm0 4v2h2v-2h-2zM8 7l5 3-5 3V7z"/></svg>
                            <span class="text-sm text-yellow-600 md:text-yellow-400 block md:hidden">Filma</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="{{ route('seriale.index') }}" class="block pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-yellow-800 hover:border-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-yellow-500 inline-block h-4 w-4" viewBox="0 0 20 20">
                                <path d="M1 4h2v2H1V4zm4 0h14v2H5V4zM1 9h2v2H1V9zm4 0h14v2H5V9zm-4 5h2v2H1v-2zm4 0h14v2H5v-2z"/></svg>
                            <span class="text-sm text-yellow-600 block md:hidden">Seriale</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="{{ route('aktor.index') }}" class="block pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-yellow-800 hover:border-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-yellow-500 inline-block h-4 w-4" viewBox="0 0 20 20">
                                <path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
                            <span class="text-sm text-yellow-600 md:text-gray-400 block md:hidden">Aktoret</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>
