<!DOCTYPE html>
<html lang="@yield('lang', 'fr')">
    <head>
        @yield('metadata')
        <title>@yield('title', 'WORDING CMS')</title>

        @yield('frameworks_css&js')
        @yield('custom_css')
        @yield('custom_js')
    </head>
    <body>
        @yield('body')
        @yield('modals')
    </body>
</html>