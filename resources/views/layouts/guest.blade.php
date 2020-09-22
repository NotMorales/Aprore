<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
<<<<<<< HEAD
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
=======
        <meta name="viewport" content="width=device-width, initial-scale=1">
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
<<<<<<< HEAD
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('css/login/login.css') }}" rel="stylesheet" type="text/css" />
=======
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>
    </head>
<<<<<<< HEAD
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        <script src="{{ asset('js/login/login.js') }}"></script>
=======
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    </body>
</html>
