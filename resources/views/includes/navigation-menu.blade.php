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
        <nav class="navbar navbar-static-top  py-0 pl-0">
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
                                                @if ($not->request_type == '1') bg-green-100
                                                @elseif ($not->request_type == '2') bg-yellow-100
                                                @elseif ($not->request_type == '3') bg-red-100 @endif    
                                            @endif
                                            ">
                                                <!-- start message -->
                                                <a href="{{ route('admin.notification',$notification->id) }}">
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
                <a href="/"><i class="fas fa-home fa-fw"></i> <span class="ml-2"> Home Page </span></a>
            </li>

            {{-- Users --}}
            @can('user-show-all')
                <li class="treeview @yield(" users")">
                    <a href="#">
                        <i class="fa fa-user fa-fw"></i> <span class="ml-2">Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@yield(" all-users")"><a href="{{ route('admin.users.index') }}"><i
                                    class="fa fa-user-friends fa-fw"></i> <span class="ml-2"> All Users </span></a></li>
                        @can('user-create')
                            <li class="@yield(" add-user")"><a href="{{ route('admin.users.create') }}"><i
                                        class="fa fa-user-plus fa-fw"></i> <span class="ml-2"> Add User </span></a></li>
                        @endcan
                        {{-- <li class="@yield("user-roles")"><a href="{{route('admin.users.roles')}}"><i class="fa fa-user-plus fa-fw"></i> <span class="ml-2"> User Roles &amp; Permissions </span></a></li> --}}
                    </ul>
                </li>
            @endcan

            {{-- Products --}}
            @can('product-show')
                <li class="treeview @yield(" products")">
                    <a href="#">
                        <i class="fab fa-product-hunt fa-fw"></i> <span class="ml-2">Products</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@yield(" all-products")"><a href="{{ route('admin.products.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Products </span></a></li>
                        @can('product-create')
                            <li class="@yield(" add-product")"><a href="{{ route('admin.products.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Product </span></a></li>
                        @endcan
                        @can('product-approve')
                            <li class="@yield(" review-products")"><a href="{{ route('admin.edited_products.index') }}"><i
                                        class="fas fa-pen fa-fw"></i> <span class="ml-2"> Review Products </span></a></li>
                        @endcan
                        @can('product-permanent-delete')
                            <li class="@yield(" deleted-product")"><a href="{{ route('admin.products.deleted') }}"><i
                                        class="fas fa-trash fa-fw"></i> <span class="ml-2"> View Deleted Product </span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Brands & Lines --}}
            @can(['brand-show', 'line-show'])
                <li class="treeview @yield(" brands")">
                    <a href="#">
                        <i class="fas fa-copyright fa-fw"></i><span class="ml-2">Brands &#38; Lines</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@yield(" all-brands")"><a href="{{ route('admin.brands.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Brands </span></a></li>
                        @can('brand-create')
                            <li class="@yield(" add-brand")"><a href="{{ route('admin.brands.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Brand </span></a></li>
                        @endcan
                        <li class="@yield(" all-lines")"><a href="{{ route('admin.lines.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Lines </span></a></li>
                        @can('line-create')
                            <li class="@yield(" add-line")"><a href="{{ route('admin.lines.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Line </span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Ingredients & Forms --}}
            @can(['ingredient-show', 'form-show'])
                <li class="treeview @yield(" ingredients")">
                    <a href="#">
                        <i class="fas fa-pills fa-fw"></i><span class="ml-2">Ingredients &#38; Forms</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@yield(" all-ingredients")"><a href="{{ route('admin.ingredients.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Ingredients </span></a></li>
                        @can('ingredient-create')
                            <li class="@yield(" add-ingredient")"><a href="{{ route('admin.ingredients.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Ingredient </span></a>
                            </li>
                        @endcan
                        <li class="@yield(" all-forms")"><a href="{{ route('admin.forms.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Forms </span></a></li>
                        @can('form-create')
                            <li class="@yield(" add-form")"><a href="{{ route('admin.forms.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Form </span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Categories & Indications --}}
            @can(['category-show', 'indication-show'])
                <li class="treeview @yield(" categories")">
                    <a href="#">
                        <i class="fas fa-code-branch fa-fw"></i><span class="ml-2">Categories &#38; Ind...</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@yield(" all-categories")"><a href="{{ route('admin.categories.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Categories </span></a></li>
                        @can('category-create')
                            <li class="@yield(" add-category")"><a href="{{ route('admin.categories.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Category </span></a></li>
                        @endcan
                        <li class="@yield(" all-indications")"><a href="{{ route('admin.indications.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Indications </span></a></li>
                        @can('indication-create')
                            <li class="@yield(" add-indication")"><a href="{{ route('admin.indications.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Indication </span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Countries --}}
            @can('country-show')
                <li class="treeview @yield(" countries")">
                    <a href="#">
                        <i class="fas fa-globe-africa fa-fw"></i><span class="ml-2">Countries</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@yield(" all-countries")"><a href="{{ route('admin.countries.index') }}"><i
                                    class="far fa-eye fa-fw"></i> <span class="ml-2"> All Countries </span></a></li>
                        @can('country-create')
                            <li class="@yield(" add-country")"><a href="{{ route('admin.countries.create') }}"><i
                                        class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Country </span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('role-permission-edit')
                {{-- Roles --}}
                <li class="@yield(" roles")">
                    <a href="{{ route('admin.roles.index') }}"><i class="fas fa-key fa-fw"></i> <span class="ml-2"> Edit
                            Roles </span></a>
                </li>
            @endcan

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
