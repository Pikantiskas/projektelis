@extends('layout')


@section ('css')

@endsection
<link rel="stylesheet" href={{ asset('css/page/post.css') }}>
@section('page')
    <h2 class="page-title">Create Post</h2>

    <section class="section-post-form">
        <form class="post-form" enctype="multipart/form-data" method="POST" action={{ route('post.create') }}>
            @csrf

            <div class="title-block">
                <input class="title-input" name="title" type="text" placeholder="Title" value={{ old('title') }}>
            </div>

            <div class="description-block">
                <textarea class="description-input" name="description" placeholder="Description" value={{ old('description') }}>

                </textarea>
            </div>

            <div class="price-block">
                <input class="price-input" name="price" type="text" placeholder="Price" value={{ old('price') }}>
            </div>

            <div class="category-block">
                <select name="category_id" id="category">
                    @foreach($categories as $category)
                        <option value={{ $category->id }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="price-block">
                <input class="price-input" name="show_phone_number" type="checkbox" checked={{ old(('show_phone_number')) }} >
            </div>

            <div class="image-block">
                <input class="image-input" name="images[]" type="file" multiple>
            </div>

            <div class="image-block">
                <input id="start" type="date" value="{{old('expires_at')}}" min="{{ now()->format('Y-m-d') }}" max="{{ now()->addDays(60)->format('Y-m-d') }}" name="expires_at">
            </div>

            <div class="submit-block">
                <input class="submit" type="submit" value="Submit">
            </div>
        </form>

        @if ($errors->any())
            <div class="notifications">
                <p class="notification-message notification-message-error-title">Login failed!</p>
            </div>
            @foreach ($errors->all() as $error)
                <div class="notifications">
                    <p class="notification-message notification-message-error-item">&#8226; {{ $error }}</p>
                </div>
            @endforeach
            {{--        @else--}}
            {{--            <div class="notifications">--}}
            {{--                <p class="notification-message notification-message-success-title">Registration success</p>--}}
            {{--            </div>--}}
        @endif
    </section>


@endsection
