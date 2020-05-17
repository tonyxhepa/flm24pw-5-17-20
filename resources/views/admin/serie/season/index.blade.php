@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap bg-white rounded-lg m-2">
            <a class="p-2 m-2 bg-indigo-300 rounded-lg" href="{{ route('admin-serie') }}">Go Back</a>
            <h2 class="p-2 m-2">Wellcome To Seasons of {{ $serie->name }}</h2>
        </div>
        <admin-season :serie="{{ $serie }}"></admin-season>
    </div>
@endsection
