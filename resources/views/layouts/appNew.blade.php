<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
<<<<<<< HEAD
        @include('layouts.meta')
        
        <!-- Extras -->
        @yield('head')
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        @include('includes.header-mobile')

        <div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
                @include('includes.aside')
                <!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    @include('includes.header')
                    <!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
                    </div>
                    <!--end::Content-->
=======
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/logo.png') }}" />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"type="text/css" />
        <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
        <!--begin::Styles(used by this page)-->
        <link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>

        <!-- Extras -->
        @yield('head')
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed subheader-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        @include('includes.header-mobile')

        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                @include('includes.aside')
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    @include('includes.header')
                    <!--begin::Content-->
                    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
                    </div>
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
                    @include('includes.footer')
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
<<<<<<< HEAD

        @include('includes.user-panel')
=======
        <!--end::Main-->

        @include('includes.user-panel')
        @include('includes.shop')
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
        @include('includes.notification')
        @include('includes.chat')
        @include('includes.scroll')
            
        <!-- Extras -->
        @include('includes.config')
        @yield('script')
    </body>
</html>
