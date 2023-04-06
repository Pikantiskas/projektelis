@extends('layout')


@section ('css')
    <link rel="stylesheet" href={{ asset('css/page/registerLogin.css') }}>
@endsection

@section('page')
    <h2 class="page-title">Registration</h2>

    <section class="section-user-form">
        <form class="user-form" method="POST" action={{ route('authentication.register') }}>
            @csrf

            <div class="email-block">
                <input class="email-input" name="email" type="text" placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="name-block">
                <input class="name-input" name="first_name" type="text" placeholder="Name" value="{{ old('first_name') }}">
            </div>

            <div class="name-block">
                <input class="name-input" name="last_name" type="text" placeholder="Surname" value="{{ old('last_name') }}">
            </div>

            <div class="name-block">
                <input class="name-input" name="phone" type="text" placeholder="Phone" value="{{ old('phone') }}">
            </div>

            <div class="name-block">
                <input class="name-input" name="city" type="text" placeholder="City" value="{{ old('phone') }}">
            </div>

            <div class="password-block">
                <input class="password-input" name="password" type="password" placeholder="Password">
            </div>

            <div class="password-block-2">
                <input class="password-input-2" name="password_confirmation" type="password" placeholder="Password (repeat)">
            </div>

            <div class="submit-block">
                <input class="submit" type="submit" value="Submit">
            </div>
        </form>

        @if ($errors->any())
            <div class="notifications">
                <p class="notification-message notification-message-error-title">Registration failed!</p>
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
