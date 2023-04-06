
@if($post->images()->count() > 0)
    <img class="card-main-dish-img" src="{{ asset('storage/'. $post->images()->first()->file_path) }}" alt="dish-img">
@else
    <img class="card-main-dish-img" src="{{ asset('images/logo.png') }}" alt="dish-img">
@endif
