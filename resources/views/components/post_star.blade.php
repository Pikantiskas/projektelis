@can('unstar', $post)
    <form action="{{ route('posts.stars', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="post-star-button" type="submit"><i class="fas fa-star"></i></button>
    </form>
@endcan
@can('star', $post)
    <form action="{{ route('posts.stars', $post) }}" method="POST">
        @csrf
        <button class="post-star-button" type="submit"><i class="far fa-star"></i></button>
    </form>
@endcan
