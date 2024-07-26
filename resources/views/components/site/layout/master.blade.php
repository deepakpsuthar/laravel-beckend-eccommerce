<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>mzo | {{ $pageTitle }}</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    @stack('styles')
</head>
<body>
    <main class="main">
        {{ $slot }}
    </main>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    @stack('scripts')
</body>
</html>
