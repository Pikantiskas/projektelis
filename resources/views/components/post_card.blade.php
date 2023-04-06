<div class="card">
    <div class="card-main">
        <div class="card-main-dish-title">
            <h3>{{ $post->title }}</h3>
        </div>

        {{--                        <x-post_image :post="$post"></x-post_image>--}}
        {{--                        <img class="card-main-dish-img" src="{{ asset('storage/'. $post->images()->first()->file_path) }}" alt="dish-img">--}}
        @include('components.post_image')
    </div>

    <div class="card-info">
        <p class="card-info-item"><i class="fas fa-coins"></i>{{ $post->price }}&euro;</p>
        <p class="card-info-item"><i class="fas fa-coins"></i>{{ $post->status }}</p>
        <p class="card-info-item"><a class="card-info-item-link" href="#">Miestas</a></p>

        @include('components.post_star')

        @include('components.post_delete')

    </div>
</div>
