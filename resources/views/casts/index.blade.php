@extends('layouts.show')

@section('content')
    <div class="clearfix"></div>
    <section>
            @if(!empty($casts))
                    <section class="container mx-auto my-2 bg-gray-700 p-2 rounded-lg">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
                            @foreach($casts as $cast)
                                <div class="relative">
                                    <a href="{{ route('aktor.show', $cast->slug) }}">
                                        <img
                                            class="lazy w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                            src="{{ asset('img/loader.jpg') }}"
                                            data-src="{{ asset('storage/cast/'.$cast->poster_path)  }}"
                                            alt="cast poster"
                                        />
                                    </a>
                                    @if($cast->movies)
                                    <div class="absolute right-0 top-0 my-2 mx-1">
                                       <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                                           {{ count($cast->movies) }} Filma
                                       </span>
                                    </div>
                                    @endif
                                    <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                                        <a href="{{ route('aktor.show', $cast->slug) }}" class="w-full text-sm">{{ $cast->name}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $casts->links() }}
                    </section>
                    <div class="clearfix"></div>
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
