<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <header class="mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-4"><h1>@yield('title')</h1></div>
                    <div class="col-8 float-end text-end">@yield('action')</div>
                </div>
            </div>
        </header>

        <main class="mt-5">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endisset
            @if(session('danger'))
                <div class="alert alert-danger">{{ session('danger') }}</div>
            @endisset
            @yield('content')
        </main>
    </div>

</body>
</html>
