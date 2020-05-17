@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap bg-white rounded-lg m-2">
            <a class="p-2 m-2 bg-indigo-300 rounded-lg" href="{{ route('admin-season', $serie->slug) }}">Go Back</a>
            <h2 class="p-2 m-2">Wellcome To Episodes of Season {{ $season->season_numberr }} of {{ $serie->name }}</h2>
        </div>
        <admin-episode :serie="{{ $serie }}" :season="{{ $season }}"></admin-episode>
    </div>
@endsection
