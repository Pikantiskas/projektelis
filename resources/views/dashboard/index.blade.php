@extends('layout')

@section ('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href={{ asset('css/page/post.css') }}>
@endsection

@section ('page')
    <h2 class="page-title">Dashboard</h2>

    <section class="section-dish-cards-list">

        <div class="card card-for-actions">
            <form action={{ route('dashboard') }} method="post">
                @csrf

                <div class="card-for-actions-item">
                    <a class="card-for-actions-item-add" href="{{ route('post.create') }}"> + </a>
                </div>

                <div class="card-for-actions-item">
                    <select name="status" class="card-for-actions-item-action">
                        <option {{ app('request')->input('status') === null ? 'selected' : '' }}>---</option>
                        <option value="active" {{ app('request')->input('status') === 'active' ? 'selected' : '' }} >Active</option>
                        <option value="inactive" {{ app('request')->input('status') === 'inactive' ? 'selected' : '' }} >Inactive</option>
                        <option value="closed" {{ app('request')->input('status') === 'closed' ? 'selected' : '' }} >Closed</option>
                    </select>
                </div>

                <div class="card-for-actions-item">
                    other
                </div>

                <div class="card-for-actions-item">
                    other
                </div>

                <div class="card-for-actions-item-last">
                    <button class="card-for-actions-item-last-button" type="submit">Filter</button>
                </div>
            </form>
        </div>

        @if($posts->count() > 0)
            @foreach($posts as $post)
                @include('components.post_card')
            @endforeach
        @else
            no post yet
        @endif
    </section>

    <section class="section-page-paginate">
        {{ $posts->withQueryString()->links() }}
    </section>
@endsection
