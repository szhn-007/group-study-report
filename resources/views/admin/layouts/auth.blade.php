<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layouts.head')
    </head>
    <body class="login-page">
        <div class="login-header box-shadow">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="brand-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/vendors/images/deskapp-logo.svg') }}" alt="{{ config('app.name') }}">
                    </a>
                </div>
            </div>
        </div>

        @yield('content')

        <!-- Scripts -->
        @include('admin.layouts.scripts')
        @stack('scripts')
    </body>
</html>
