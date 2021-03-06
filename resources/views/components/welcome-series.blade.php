@if(!empty($series))
    <div class="container my-3 px-4 py-2 bg-gray-900 mx-auto rounded-lg ">
        <div class="flex justify-between rounded-lg my-2 px-2 bg-pink-700">
            <h2 class="text-gray-400 text-xl text-center p-2"><a href="{{ route('series.index') }}"> Serialet e Fundit </a></h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($series as $serie)
                <serie-card :serie='@json($serie)'></serie-card>
            @endforeach
        </div>
    </div>
@endif
