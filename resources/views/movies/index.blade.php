@extends('layouts.show')

@section('content')
    <div class="clearfix"></div>
    <section hidden>
        <h1>Filma24.pw Filma me Titra Shqip - Filma Aksion - Filma Erotik</h1>
        <p>Filma24.pw filma me titra shqip. Shikoni filmat me te fundit ne HD.</p>
    </section>
    <div class="clearfix"></div>
    <section class="container mx-auto my-2 bg-gray-700 p-2 rounded-lg">
        <div class="flex justify-between rounded-lg my-2 px-2 bg-yellow-700 p-2">
            <a class="mx-2 font-bold hover:text-gray-700" href="{{ route('filma.index', 'sort=-updated_at') }}">Te Fundit</a>
            <a class="mx-2 font-bold hover:text-gray-700" href="{{ route('filma.index', 'sort=-visits') }}">Me Te Shikuarit</a>
            <a class="mx-2 font-bold hover:text-gray-700" href="{{ route('filma.index', 'sort=-rating') }}">IMDB</a>
            <a class="mx-2 font-bold hover:text-gray-700" href="{{ route('filma.index', 'sort=-release_date') }}">Sipas Vitit</a>
        </div>
        @include('includes.movie-grid')
        {{ $movies->links() }}
    </section>
    <div class="clearfix"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/yall.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", yall);
    </script>
@endsection
