<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

        <title>@yield('title', 'EZ-Cosmo')</title>
        
        {{-- AdminLTE Styles & Scripts --}}
        @include('includes.styles')
        
        {{-- @livewireStyles --}}
        <livewire:styles />

        @yield('style')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            
            {{-- Header & Sidebar --}}
            <div class="">

                @include('includes.user-navigation-menu')
            
            </div>
                
            {{-- Main content --}}
            <div class="content-wrapper mt-12">

                @yield('content')    

            </div>
        
            @include('includes.footer')
        </div>
        
        @include('includes.scripts')
        {{-- @livewireScripts --}}
        <livewire:scripts />

        <script>
            $(function () {
            @yield('script')
            })
        </script>
    </body>
    </html>
