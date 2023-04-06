@extends('layout')


@section ('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href={{ asset('css/page/post.css') }}>
@endsection

@section('page')
    <h2 class="page-title">Posts</h2>

    <section class="section-dish-cards-list">

            <div class="card add-new-post">
                <a class="" href={{ route('post.create') }}>
                <div class="card-main">
                    <div class="card-main-dish-title">
                        <h3 class="add-dish">+</h3>
                    </div>
                    <!-- <img class="card-main-dish-img" src="" alt="dish-img"> -->

                </div>

                <div class="card-info">
                    <p class="card-info-item">Pridėti naują</p>
                </div>
                </a>
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
        {{ $posts->links() }}
    </section>
@endsection
