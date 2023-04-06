<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href={{ asset('css/header.css') }}>
    <link rel="stylesheet" href={{ asset('css/main.css') }}>
    @yield('css')
    <link rel="stylesheet" href={{ asset('css/footer.css') }}>
    <title>ADS</title>
</head>
<body>
<header>
    <div class="header-left-block">
        <a href="#"><img class="header-logo-img" src={{ asset('images/logo.png') }}></a>
    </div>

    <div class="header-center-block">
        <div class="header-center-top-block">
            <h1 class="header-center-top-title">ALL THE BEST TO YOU..</h1>
        </div>

        <div class="header-center-bottom-block">
            <p class="header-center-bottom-description">Bla bla bla..</p>
        </div>
    </div>

    <div class="header-right-block">
        <ul>
            @guest()
                <li class="header-right-list-item"><a class="header-right-list-item-link" href={{ route('authentication.login') }}>Prisijungimas</a></li>
                <li class="header-right-list-item"><a class="header-right-list-item-link" href={{ route('authentication.register') }}>Registracija</a></li>
            @endguest

            @auth()
                <li class="header-right-list-item"><a class="header-right-list-item-link" href="#">{{ Auth::user()->email }}</a></li>
                <li class="header-right-list-item">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-button" type="submit">Logout</button>
                    </form>
                </li>



                @endauth
        </ul>
    </div>
</header>

<main>
    @auth()
        <nav class="main-nav">
            <ul class="main-nav-ul">
                <a class="main-menu-ul-li-link" href={{ route('dashboard') }}><li class="main-nav-ul-item">Dashboard</li></a>
                <a class="main-menu-ul-li-link" href={{ route('post') }}><li class="main-nav-ul-item">Posts</li></a>
                <a class="main-menu-ul-li-link" href={{ route('notification') }}><li class="main-nav-ul-item">Notification preferences</li></a>
            </ul>
        </nav>
    @endauth

    @yield('page')
</main>

<footer>
    <p>Visos teisės saugomos &copy; <span class="footer-evis">EVIS</span></p>
</footer>

</body>
</html>
