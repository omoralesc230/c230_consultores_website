<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">
      <div class="container">
        <a class="navbar-brand d-block d-md-none" href="{{ url('/') }}">
          <img src="./img/logo_dark.png" alt="c230 consultores logo" class="brand-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto d-block d-md-none">

          </ul>

          <ul class="nav navbar-nav navbar-logo mx-auto d-none d-md-block">
            <li class="nav-item">
              <span class="navbar-text">
                Generamos insumos para ayudar a nuestros clientes a tomar mejores decisiones
              </span>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto d-block d-md-none">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                @if (Route::has('register'))
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
              </li>
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <ul class="nav flex-column sidenav app-sidenav mt-5">
    <li class="nav-item mt-3" @click="activate(0)">
      <a class="nav-link active" href="{{ url('/') }}">
        <img src="./img/logo_dark.png" alt="c230 consultores logo">
      </a>
    </li>
    <li class="nav-item mt-2" @click="activate(1)" :class="{ activesn : active_el == 1 }">
      <a class="nav-link text-uppercase" v href="#">quiénes somos</a>
    </li>
    <li class="nav-item mt-2" @click="activate(2)" :class="{ activesn : active_el == 2 }">
      <a class="nav-link text-uppercase" href="#">qué hacemos</a>
    </li>
    <li class="nav-item mt-2" @click="activate(3)" :class="{ activesn : active_el == 3 }">
      <a class="nav-link text-uppercase" href="#">medios</a>
    </li>
    <li class="nav-item mt-2" @click="activate(4)" :class="{ activesn : active_el == 4 }">
      <a class="nav-link text-uppercase" href="#">contacto</a>
    </li>
  </ul>

  <main>
    <router-view></router-view>
  </main>
</div>
</body>
</html>
