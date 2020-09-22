<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.meta')

        <!-- Extras -->
        @yield('head')
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        
        @yield('content')

        <!-- Extras -->
        @include('includes.config')
        @yield('script')
    </body>
</html>
