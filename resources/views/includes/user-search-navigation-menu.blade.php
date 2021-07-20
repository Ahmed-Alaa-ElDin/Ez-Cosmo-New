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

                    @can('product-approve')
                        <li class="dropdown messages-menu mr-2">
                            <a href="#" class="dropdown-toggle p-2" data-toggle="dropdown">
                                <i class="fa fa-bell text-warning"></i>
                                <span class="label label-success">{{ count(auth()->user()->unreadNotifications) }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">
                                    @if (count(auth()->user()->unreadNotifications) == 0)
                                        You don't have new requests
                                    @elseif (count(auth()->user()->unreadNotifications) == 0)
                                        You have 1 new request
                                    @else
                                        You have {{ count(auth()->user()->unreadNotifications) }} new requests
                                    @endif
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        @forelse (auth()->user()->notifications as $notification)
                                            @php
                                                $not = json_decode($notification)->data;
                                            @endphp
                                            <li class="
                                            @if ($notification->read_at == null) 
                                                @if ($not->request_type == '1')
                                                    bg-green-100
                                                @elseif ($not->request_type == '2') bg-yellow-100
                                                @elseif ($not->request_type == '3') bg-red-100 @endif
                                                @endif
                                                ">
                                                <!-- start message -->
                                                <a href="{{ route('admin.notification', $notification->id) }}">
                                                    <div class="pull-left">
                                                        <img src="{{ asset('images/' . $not->user_img) }}"
                                                            class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        {{ $not->user_name }}
                                                        <small><i class="fa fa-clock"></i>
                                                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                                    </h4>
                                                    <p>{{ $not->message }}</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        @empty
                                            <li class="text-center"><small>No Requests Right Now</small></li>
                                        @endforelse
                                    </ul>
                                </li>
                                <li class="footer"><a href="{{ route('admin.edited_products.index') }}"
                                        class="d-block">See All Requests</a></li>
                            </ul>
                        </li>
                    @endcan


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
    @livewire('search.nav-search-product')
</aside>
