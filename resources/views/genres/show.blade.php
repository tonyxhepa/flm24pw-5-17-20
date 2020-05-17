@extends('layouts.show')

@section('content')
    <div class="clearfix"></div>
    <section id="serie-header-section">
        <div class="container mx-auto mt-3">
            <div class="flex md:flex-row flex-wrap rounded-lg bg-gray-800 hover:bg-gray-700">
                <div class="w-full p-4 text-center md:text-left">
                    <h1 class="text-lg text-gray-300 font-bold mx-8">Filma {{ $genre->title }} me titra shqip Filma24.pw</h1>
                    <p hidden>Filma {{ $genre->title }} me Titra Shqip Filma24.pw, Shiko dhe shkarko filma me titra shqip.</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div id="genres" class="container mx-auto my-3">
            @if(!empty($movies))
                <div class="container bg-gray-700 p-4 mx-auto rounded-lg my-3">
                    @include('includes.movie-grid')
                    {{ $movies->links() }}
                </div>
            @endif
        </div>
    </section>
    </div>
@endsection
