@can('delete', $post)
    <form action="{{ route('post.delete', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="post-star-button" type="submit"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
