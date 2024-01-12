<!-- app.blade.php -->

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FoirFouille</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<!-- ... Autres balises head ... -->

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <!-- ... Votre contenu de la navbar ... -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Accueil</a>
                    </li>
                    @auth
                        @if (Auth::user()->role_id == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                            </li>
                        @endif

                            <form action="{{ route('logout') }}" method="POST" class="nav-link ms-auto">
                                @csrf
                                {{-- <button type="submit" class="btn btn-link text-decoration-none">Déconnexion</button> --}}
                                <a class="nav-link" href="{{ route('logout') }}">Déconnexion</a>
                            </form>

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">S'enregistrer</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
