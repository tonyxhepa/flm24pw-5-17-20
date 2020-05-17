<section>
    @if(!empty($tags))
        <div class="container mx-auto m-2">
            <div class="flex flex-wrap bg-yellow-700 rounded-lg">
                @foreach($tags as $tag)
                    <a class="p-2 text-sm font-bold hover:text-white" href="{{ route('tags.show', $tag->slug) }}">#{{$tag->tag_name}}</a>
                @endforeach
            </div>
        </div>
    @endif
</section>
