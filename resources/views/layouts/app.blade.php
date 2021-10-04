<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('styles')
    <title>SETA - Sistema de Entrega de Trabalhos e Atividades</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="d-flex flex-row w-100 px-2 align-items-center">
                <div class="d-flex flex-row align-items-center text-light">
                    <img src="{{ asset($pageIcon ?? 'images/home_ico.png') }}" width="32px">
                    <span class="fs-5 ms-2">{{ $pageTitle ?? 'Menu' }}</span>
                </div>
                <div class="d-flex mx-auto">
                    <span class="fs-5 fw-bold text-light d-none d-md-block">SETA - Sistema de Entrega de Trabalhos e Atividades</span>
                    <span class="fs-5 fw-bold text-light d-block d-md-none">SETA</span>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container-fluid my-3">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    @yield('scripts')
</body>
</html>
