<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layouts.head')
    </head>
    <body>
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            <div class="pd-ltr-20">
                @yield('content')
            </div>
        </div>

        @include('admin.layouts.scripts')
        @stack('scripts')
    </body>
</html>
