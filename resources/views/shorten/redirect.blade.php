@extends('layouts.show')
@section('head')
    <title>Go to  {{ $link->title }}</title>
@endsection
@section('content')
    <div class="container mx-auto pt-6">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2">
                <div class="bg-blue-200 shadow-lg rounded-lg m-2">
                    <div class="flex justify-center text-gray-900 m-2 pb-6">
                        <h3 class="font-bold m-2">Go to <strong>{{ $link->title }}</strong></h3>
                    </div>
                    <div class="flex justify-center text-gray-900 m-2 pb-6">
                        <p class="text-center m-2">You are about to be redirected to another page. We are not responisible for the content of that page or the consequences it may have on you. .</p>
                    </div>
                    <div class="flex justify-center text-gray-900 m-2 pb-6">
                        <a href="{{ $link->url }}" class="p-2 bg-blue-300 hover:bg-blue-800 hover:text-white rounded-lg">Click Here</a>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="m-2">
                    <div class="bg-blue-200 shadow-lg rounded-lg m-2">
                        <div class="flex justify-center text-gray-900 m-2 pb-6">
                            <h5 class="font-bold m-2">Go back to homepage</h5>
                        </div>
                        <div class="flex justify-center text-gray-900 m-2 pb-6">
                            <p class="text-center m-2">You can go an create your shorten links you need.</p>
                        </div>
                        <div class="flex justify-center text-gray-900 m-2 pb-6">
                            <a href="/" class="">
                                <div class="p-2 border border-pink-500 hover:bg-pink-800 rounded-lg">
                                    Go to homepage
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
