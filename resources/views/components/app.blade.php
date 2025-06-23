<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="min-h-screen bg-white">
        @yield('content')
    </div>

</body>

</html> -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-white">
    <x-admin-navigation/>
    <x-admin-sidebar/>
</body>
</html>