<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Files -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/now-ui-dashboard.css') }}" rel="stylesheet" />
        <!-- Styles --> 
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <form id="logout-form" action="{{ route('logout') }}" method="post" class="hidden">
            @csrf
        </form>
        <div class="min-h-screen bg-gray-100">
            {{ $slot }}
        </div>
        <script src="{{ asset('js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('js/core/popper.min.js') }}"></script>
        <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        
        <!-- Chart JS -->
        <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('demo/demo.js') }}"></script>
        <script>
            $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

            });
        </script>
    </body>
</html>
