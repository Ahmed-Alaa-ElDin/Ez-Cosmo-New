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


        <style>
            .main-sidebar::-webkit-scrollbar {
                width: 0.25em;
            }
    
            .main-sidebar::-webkit-scrollbar-track {
                box-shadow: inset 0 0 6px #2c3b41;
            }
    
            .main-sidebar::-webkit-scrollbar-thumb {
                background-color: #e5e7eb;
                outline: 1px solid slategrey;
            }
    
            .treeview-menu hr {
                border-top: 1px solid #e5e7eb44;
            }
    
        </style>
    

        @yield('style')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            
            {{-- Header & Sidebar --}}
            <div class="">

                @include('includes.navigation-menu')
            
            </div>
                
            {{-- Main content --}}
            <div class="content-wrapper mt-12">

                @yield('content')    

            </div>
        
            @include('includes.footer')
        </div>
        
        
        {{-- @livewireScripts --}}
        <livewire:scripts />
        
            @include('includes.scripts')
        
        <script>
            $(function () {
            @yield('script')
            })
        </script>
    </body>
    </html>
