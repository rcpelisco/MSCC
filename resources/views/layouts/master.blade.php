<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('css/datatables.net.css')}}" rel="stylesheet">
    @yield('stylesheets')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show pace-done">
    @include('layouts.header')
    <div class="app-body">
      @include('layouts.sidebar')
      <main class="main">
        @yield('breadcrumbs')
        <div class="container-fluid">
          <div class="animated fadeIn">
            @yield('content')  
          </div>
        </div>
      </main>
    </div>
    <footer class="app-footer">
      <div>
        <a href="https://twitter.com/rcpelisco">RC Pelisco</a>
        <span>&copy; 2018</span>
      </div>
      <div class="ml-auto">
        <span>Mustard Seed Credit Cooperative</span>
      </div>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascripts')
  </body>
</html>