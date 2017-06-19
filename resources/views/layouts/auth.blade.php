<!DOCTYPE html>
<html>
<head>
    <title>Invoicing | @yield('title', 'Invoicing app by Phil Mareu')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" media="screen">

    @yield('head')
</head>
<body class="auth uk-height-viewport uk-vertical-align uk-text-center">

@yield('content')

<script src="{{ asset('js/scripts.js') }}"></script>
@yield('scripts')
</body>
</html>