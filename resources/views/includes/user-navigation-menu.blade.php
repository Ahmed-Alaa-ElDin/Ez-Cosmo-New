<header class="main-header fixed w-100">
    <!-- Logo -->
    @admin()
    <a href="/admin" class="logo" style="height: 54px">
    @else
        <a href="/" class="logo" style="height: 54px">
            @endadmin
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b class="font-weight-bold">EZ</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b class="font-weight-bold">EZ </b><span class="text-yellow-100"> Cosmo</span></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-fixed-top  py-0 pl-0">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    @if (Route::has('login'))
                        @auth
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a class="dropdown-toggle p-2" data-toggle="dropdown" type="button" id="dropdownMenuButton"
                                    aria-expanded="false">
                                    <img src="{{ asset('images/' . Auth::user()->profile_photo) }}" class="user-image"
                                        alt="User Image">
                                    <span class="hidden-xs font-weight-bold">{{ Auth::user()->first_name }}</span>
                                </a>
                                <ul class="dropdown-menu" style="top: 45px; right:-10px"
                                    aria-labelledby="dropdownMenuButton">
                                    <!-- User image -->
                                    <li class="user-header dropdown-item">
                                        <img src="{{ asset('images/' . Auth::user()->profile_photo) }}"
                                            class="img-circle m-auto" alt="User Image">
                                        <p class="text-white font-bold">
                                            {{ Auth::user()->email }}
                                            <small>Member since {{ Auth::user()->created_at->format('M Y') }}</small>
                                        </p>
                                    </li>

                                    <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('admin.users.show', $id = Auth::id()) }}"
                                        class="btn btn-default btn-sm text-black">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="" onclick="event.preventDefault();this.closest('form').submit();"
                                            class="btn btn-default btn-sm text-black">Sign out</a>
                                    </form>
                                </div>
                            </li>
                    </ul>
                    </li>
                @else
                    <div class="sm:block text-sm">
                        <a href="{{ route('login') }}" class="mr-2 text text-white text-bold ">Login</a>
                        <span class="text-white text-bold">|</span>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-2 text text-white text-bold">Register</a>
                        @endif
                    </div>
                @endauth
                @endif
                </ul>
            </div>
        </nav>
</header>
<aside class="main-sidebar fixed bg-gray-800 max-h-screen overflow-x-auto">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            {{-- Admin Dashboard --}}
            @admin()
            <li class="@yield(" admin-home")">
                <a href="/admin"><i class="fas fa-tachometer-alt fa-fw"></i> <span class="ml-2"> Admin Dashboard
                    </span></a>
            </li>
            @endadmin

            {{-- User Home Page --}}
            <li class="@yield(" user-home")">
                <a href="/"><i class="fas fa-search fa-fw"></i> <span class="ml-2"> Regular Search </span></a>
            </li>

            {{-- Advanced Search --}}
            <li class="treeview @yield(" advanced-search")">
                <a href="#">
                    <i class="fab fa-searchengin fa-fw"></i><span class="ml-2">Advanced Search</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield(" search-ingredient")"><a href="{{ route('user.search.ingredient') }}"><i
                                class="fas fa-pills fa-fw"></i> <span class="ml-2"> Search by Ingredient </span></a>
                    </li>
                    <li class="@yield(" search-indication")"><a href="{{ route('user.search.indication') }}"><i
                                class="fas fa-stethoscope fa-fw"></i> <span class="ml-2"> Search by Indication
                            </span></a></li>
                    <li class="@yield(" search-country")"><a href="{{ route('user.search.country') }}"><i
                                class="fas fa-globe-europe fa-fw"></i> <span class="ml-2"> Search by Country </span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
</aside>
