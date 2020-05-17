@if(!empty($movies))
    <div class="container bg-gray-900 p-4 mx-auto rounded-lg my-3">
        <welcome-movie :movies='@json($movies)'></welcome-movie>
    </div>
@endif
