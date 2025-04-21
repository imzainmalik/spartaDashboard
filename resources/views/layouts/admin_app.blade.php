<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.includes.compatibility')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @include('layouts.includes.style')
    @stack('custom_styles')

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="scrolllenis home" id="top">
    {{-- @dd(!$page_title); --}}
    <!-- scroll -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- scroll -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 pr-0">
                    <!-- Begin: Nav -->
                    @include('layouts.includes.leftbar');
                    <!-- END: Nav -->
                </div>
                <div class="col-md-10">
                    <div class="mainBody">
                        <div class="main-header">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h2>@if($page_title && $page_title != null) {{ $page_title }} @endif</h2>
                                </div>
                                <div class="col-md-7">
                                    @include('layouts.includes.topbar');
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.includes.scripts')
    @stack('custom_scripts')
</body>

</html>
