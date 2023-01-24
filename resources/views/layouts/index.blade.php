<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <title>@yield('title', 'Home') - @yield('app', env('APP_NAME'))</title>

    <!-- Fonts -->
    @stack('fonts')

    <!-- Styles -->
    <link href="{{ asset('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/uicons/uicons-regular-straight.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('assets/jquery/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/polaris.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            autofill(0);
            togglePassword();
        });
    </script>
    @stack('scripts')
</head>

<body>
    @includeIf('shared.header')

    <main style="padding:0 40px; min-height:640px;">
        @includeIf('shared.nav', ['nav_h1' => $data->title, 'nav_i' => $data->icon])
        
        @yield('body')
    </main>

    <div class="container">
        @includeIf('shared.footer')
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    @stack('scripts_')
</body>

</html>
