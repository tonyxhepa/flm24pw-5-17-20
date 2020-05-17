@extends('layouts.show')

@section('content')
{{--    <div class="clearfix"></div>--}}
{{--    <x-suggest></x-suggest>--}}
<div class="clearfix"></div>
<section hidden>
    <h1>Filma24.pw Filma me Titra Shqip - Filma Aksion - Filma Erotik</h1>
    <p>Filma24.pw filma me titra shqip. Shikoni filmat me te fundit ne HD.</p>
</section>
    <div class="clearfix"></div>
    <section class="container mx-auto">
        <livewire:movie.welcome />
    </section>
<section class="container mx-auto">
    <livewire:serie.welcome />
</section>
@endsection

@section('scripts')
    <script src="{{ asset('js/yall.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", yall);
    </script>
@endsection
