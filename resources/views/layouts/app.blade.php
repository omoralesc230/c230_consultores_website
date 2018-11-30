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
          <img src="/img/logo_dark.png" alt="c230 consultores logo" class="brand-image">
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
              <li class="nav-item" @click="activate(1)" :class="{ active : active_el == 1 }">
                <a class="nav-link" href="#">Quiénes somos</a>
              </li>
              <li class="nav-item" @click="activate(2)" :class="{ active : active_el == 2 }">
                <a class="nav-link" href="#">Qué hacemos</a>
              </li>
              <li class="nav-item" @click="activate(3)" :class="{ active : active_el == 3 }">
                <a class="nav-link" href="#">Medios</a>
              </li>
              <li class="nav-item" @click="activate(4)" :class="{ active : active_el == 4 }">
                <a class="nav-link" href="#">Contacto</a>
              </li>
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('home') }}">Admin Panel</a>
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
            <li class="nav-item" @click="activate(1)" :class="{ active : active_el == 1 }">
              <a class="nav-link" href="#">Quiénes somos</a>
            </li>
            <li class="nav-item" @click="activate(2)" :class="{ active : active_el == 2 }">
              <a class="nav-link" href="#">Qué hacemos</a>
            </li>
            <li class="nav-item" @click="activate(3)" :class="{ active : active_el == 3 }">
              <a class="nav-link" href="#">Medios</a>
            </li>
            <li class="nav-item" @click="activate(4)" :class="{ active : active_el == 4 }">
              <a class="nav-link" href="#">Contacto</a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <ul class="nav flex-column sidenav app-sidenav mt-5" id="app-sidenav">
    <li class="nav-item mt-3" @click="activate(0)" id="logo_dark">
      <a href="{{ url('/') }}" class="nav-link">
        <img id="logodark" src="/img/logo_dark.png" alt="c230 consultores logo" :class="{ 'd-none' : current_url == 1 }">
        <img id="logowhite" src="/img/logo_light.png" alt="c230 consultores logo" class="d-none" :class="{ 'd-block' : current_url == 1 }">
      </a>
    </li>
    <li class="nav-item mt-2" @click="activate(1)" :class="{ activesn : active_el == 1 }">
      <router-link id="aboutus" to="/aboutus" class="nav-link text-uppercase" :class="{ 'text-white' : current_url == 1 }">
        quiénes somos
      </router-link>
    </li>
    <li class="nav-item mt-2" @click="activate(2)" :class="{ activesn : active_el == 2 }">
      <router-link id="whatwedo" to="/whatwedo" class="nav-link text-uppercase" :class="{ 'text-white' : current_url == 1 }">
        qué hacemos
      </router-link>
    </li>
    <li class="nav-item mt-2" @click="activate(3)" :class="{ activesn : active_el == 3 }">
      <a id="vacancies" class="nav-link text-uppercase" :class="{ 'text-white' : current_url == 1 }" href="#">medios</a>
    </li>
    <li class="nav-item mt-2" @click="activate(4)" :class="{ activesn : active_el == 4}">
      <a id="contact" class="nav-link text-uppercase" :class="{ 'text-white' : current_url == 1 }" href="#">contacto</a>
    </li>
  </ul>

  <main>
    <router-view></router-view>
  </main>

  <footer style="background-color:#4a4a4a;">
    <div class="container-fluid">
      <div class="row justify-content-md-center text-center" style="padding:25px;">
        <div class="col-md-4">
          <h3 class="text-uppercase font-weight-light text-orange">c230 consultores</h3>
          <p class="text-white">
            <i class="fas fa-search-location ml-2"></i>
            Calle Leibnitz No.20 Piso 11, Colonia Anzures, Del. Miguel Hidalgo, 11590 CDMX, México
          </p>
        </div>
        <div class="col-md-4">
          <h3 class="text-uppercase font-weight-light text-orange">contacto</h3>
          <p class="text-white">
            <i class="fas fa-at ml-2"></i>
            info@c-230.com
          </p>
          <p class="text-white">
            <i class="fas fa-phone ml-2"></i>
            +52 (55) 5208 1403
          </p>
        </div>
        <div class="col-md-4">
          <h3 class="text-uppercase font-weight-light text-orange">medios</h3>
          <p class="text-white">
            <i class="fab fa-linkedin-in ml-2"></i>
            <a class="text-white" href="https://www.linkedin.com/company/c230-consultores/" target="_blank">LinkedIn</a>
          </p>
          <p class="text-white">
            <i class="fab fa-twitter ml-2"></i>
            <a class="text-white" href="https://twitter.com/C230Consultores" target="_blank">Twitter</a>
          </p>
        </div>
      </div>
    </div>
  </footer>
</div>

<script type="text/javascript" defer>
// sidenav

//
</script>
</body>
</html>
