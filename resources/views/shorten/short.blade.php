@extends('layouts.show')
@section('head')
    <title>Bjondja.com | Filma24 | shiko dhe shkarko Filma me titra shqip HD</title>
    <meta name="description" content="Shiko dhe shkarko filma me titra shqip FALAS! Bjondja.com | Seriale me Titra Shqip HD | Filma24!">
    <meta name="keywords" content="filma me titra shqip, filma24, seriale me titra shqip">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:description" content="Shiko dhe shkarko filma me titra shqip FALAS! Bjondja.com | Filma me Titra Shqip HD – Shiko dhe shkarko seriale me titra shqip FALAS!" />
    <meta property="og:title" content="Bjondja.com | Filma me titra shqip | Filma24 | shiko dhe shkarko" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="Bjondja.com | Filma me titra shqip" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image:secure_url" content="{{ url(asset('/img/logo.png')) }}" />
    <meta property="og:image" content="{{ url(asset('/img/logo.png')) }}" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:width" content="300" />
    <meta name="twitter:title" content="Bjondja.com | Filma me titra shqip | Filma24 | shiko dhe shkarko" />
    <meta name="twitter:description" content="Shiko dhe shkarko filma me titra shqip FALAS! Bjondja.com | Filma me Titra Shqip HD – Shiko dhe shkarko seriale me titra shqip FALAS!" />
    <meta name="twitter:image" content="{{ url(asset('/img/logo.png')) }}" />
@endsection
@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex">
            @if (Session::has('global'))
                <copy-url url="{{ Session::get('global') }}"></copy-url>
            @endif
        </div>
        <div class="flex p-2">
            <div class="w-full">
                <form action="{{ route('url.generate') }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full p-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Titulli
                            </label>
                            @if ($errors->has('title'))
                                <div class="p-2 text-red-500">{{ $errors->first('title') }}</div>
                            @endif
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="title"
                                name="title"
                                type="text"
                                placeholder="Titulli">
                        </div>
                        <div class="w-full p-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Url
                            </label>
                            @if ($errors->has('url'))
                                <div class="p-2 text-red-500">{{ $errors->first('url') }}</div>
                            @endif
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="url"
                                name="url"
                                type="url"
                                placeholder="Url">
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <button type="submit" class="py-2 px-6 bg-blue-500 hover:bg-blue-100 font-bold shadow-lg rounded-lg">Short</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
