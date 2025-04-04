<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="app_url" value="{{ url('/') }}">
    <title>{{__('Project name')}}</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite([
        'resources/js/app.js',
        'resources/scss/app.scss',
    ])
    @stack('css')
    @livewireStyles
</head>

<body class="layout-fixed hold-transition sidebar-mini pace-success">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebar-toggle d-flex align-items-center" data-widget="pushmenu" href="#"
                   role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('index') }}" class="nav-link pl-0">{{ __('Main page') }}</a>
            </li>
        </ul>
    </nav>

    @include('parts.menu')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
@livewireScripts
@stack('js')
</body>
</html>
