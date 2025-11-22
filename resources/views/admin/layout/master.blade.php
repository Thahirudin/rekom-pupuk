<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('addCss')
</head>

<body>
    @include('admin.layout.navbar')
    @include('admin.layout.aside')
    <div class="p-4 sm:ml-64 mt-14">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.js"></script>
    @yield('addJs')
</body>

</html>
