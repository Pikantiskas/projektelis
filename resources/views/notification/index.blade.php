@extends('layout')


@section ('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
@endsection

@section('page')
    <h2 class="page-title">Notification preferences</h2>

    <section class="section-notification">

        <form class="" method="POST" action={{ route('notification.create') }}>
            @csrf

            <select multiple="true" name="category_id[]">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (collect(old('category_id'))->contains($category->id)) ? 'selected':'' }}
                        {{ (in_array($category->id ,$existingCategoriesIds)) ? 'selected' : ''}}
                    />
                    {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <div class="submit-block">
                <input class="submit" type="submit" value="Submit">
            </div>

            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>
    </section>
@endsection
