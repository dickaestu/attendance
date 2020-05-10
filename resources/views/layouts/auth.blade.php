<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-white justify-content-center mb-5">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
          <img src="{{ url('frontend/images/logo.jpg') }}" width="200" height="100" >
        </a>
      </nav>
    
@yield('content')
<footer>
    <div class="bg-white fixed-bottom py-3 text-center">Copyright 2020</div>
</footer>

@stack('prepend-script')
@include('includes.script')
@stack('addon-script')
</body>
</html>