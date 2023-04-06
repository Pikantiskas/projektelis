@extends('layout')


@section ('css')
    <link rel="stylesheet" href={{ asset('css/page/registerLogin.css') }}>
@endsection

@section('page')
    <h2 class="page-title">Login</h2>

    <section class="section-user-form">
        <form class="user-form"  method="POST" action={{ route('authentication.login') }}>
            @csrf

            <div class="email-block">
                <input class="email-input" name="email" type="text" placeholder="Email">
            </div>

            <div class="password-block">
                <input class="password-input" name="password" type="password" placeholder="Password">
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
