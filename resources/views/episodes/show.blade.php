@extends('layouts.show')

@section('content')
    <div class="clearfix"></div>
    <section>
        @if(!empty($episode))
            <div id="episode" class="container mx-auto my-3 bg-gray-700 rounded-lg">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-3/4 px-3">
                        {{-- embeds start --}}
                        @if(!empty($episode->embeds))
                            <section
                                id="embed"
                                class="container mx-auto rounded-lg mt-2"
                            >
                                <h1 class="text-green-700" hidden>{{ $episode->season->serie->name }} Episodi {{ $episode->episode_number }} me Titra Shqip filma24.pw</h1>
                                @foreach($episode->embeds as $count => $embed)
                                    <div id="{{ $embed->id }}" class="flex justify-around city hidden">
                                        <div class="iframe-container bg-black">
                                            <iframe
                                                class="rounded-lg"
                                                ref="frame"
                                                src="{{ $embed->web_url }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen
                                            ></iframe>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="flex flex-wrap bg-black mt-2 rounded-lg">
                                    @foreach($episode->embeds as $count => $embed)
                                        <button
                                            @if ($loop->first) id="default" @endif
                                        class="p-1 lg:p-2 m-1 md:m-2 lg:m-2 focus:outline-none bg-gray-700 hover:bg-yellow-800 font-bold text-black hover:text-gray-500 rounded-lg border border-gray-900 tablink"
                                            onclick="openEmbed(event,'{{ $embed->id }}')">{{ $embed->web_name }}</button>
                                    @endforeach
                                </div>
                                <script>
                                    function openEmbed(evt, cityName) {
                                        var i, x, tablinks;
                                        x = document.getElementsByClassName("city");
                                        for (i = 0; i < x.length; i++) {
                                            x[i].style.display = "none";
                                        }
                                        tablinks = document.getElementsByClassName("tablink");
                                        for (i = 0; i < x.length; i++) {
                                            tablinks[i].className = tablinks[i].className.replace(" bg-yellow-800", "");
                                        }
                                        document.getElementById(cityName).style.display = "block";
                                        evt.currentTarget.className += " bg-yellow-800";
                                    }
                                    document.getElementById("default").click();
                                </script>
                            </section>
                        @endif
                        {{-- embeds end --}}

                        {{-- episode title start --}}
                        <div class="flex justify-center bg-black text-gray-300 mt-3 p-3 rounded-lg text-center text-lg">
                            {{ $season->serie->name }} - Episodi {{ $episode->episode_number }}
                        </div>
                        {{-- episodes list start --}}
                        <div class="flex flex-wrap my-3 rounded-lg bg-black p-2">
                            @foreach($season->episodes as $episode)
                                <div class="w-1/2 md:w-1/4 p-2">
                                    <a href="{{ route('episodes.show', $episode->slug) }}"
                                       class="w-full p-2 text-center m-2 text-white rounded-lg bg-yellow-800 hover:bg-gray-700 hover:text-gray-800 transition-bg transition-500 transition-ease-in">
                                        Episodi {{ $episode->episode_number }}</a>
                                </div>
                            @endforeach
                        </div>
                        {{-- episode list ends --}}
                        <div class="container mx-auto">
                            @if(!empty($episode->watchs))
                                <div class="bg-black my-3 p-2 rounded-lg">
                                    <h3 class="text-lg text-gray-300 p-2 rounded-lg">Shikoje ne hoste te tjere</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($episode->watchs as $watch)
                                            <a href="{{ $watch->web_url }}" target="_blank">
                                                <div
                                                    class="h-18 ml-1 p-2 hover:bg-gray-700 text-gray-300 hover:text-gray-500 rounded-lg border border-yellow-500 transition-bg transition-500 transition-ease-in">
                                                    {{ $watch->web_name }}</div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(!empty($episode->downloads))
                                <div class="bg-black my-3 p-2 rounded-lg">
                                    <h3 class="text-lg text-gray-300 p-2 rounded-lg">Shkarkoje ne hoste te tjere</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($episode->downloads as $download)
                                            <a href="{{ $download->web_url }}" target="_blank">
                                                <div
                                                    class="flex mt-1 h-18 ml-1 p-2 hover:bg-gray-700 text-gray-300 hover:text-gray-500 rounded-lg border border-yellow-500 transition-bg transition-500 transition-ease-in">
                                                    <svg class="fill-current w-4 h-4 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                                    {{ $download->web_name }}
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-3 rounded-lg">
                        <div class="flex flex-wrap bg-black mt-3 rounded-lg">

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <div class="clearfix"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/yall.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", yall);
    </script>
@endsection
