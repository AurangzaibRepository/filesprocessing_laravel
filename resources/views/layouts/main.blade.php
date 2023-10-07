<!DOCTYPE html>
<html>
    <head>
        <title>{{ $appName }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="dv-main">
            @include('partials.navbar')
            <div id="dv-contents" class="container mt-5">
                @yield('contents')
            </div>
        </div>
    </body>
</html>