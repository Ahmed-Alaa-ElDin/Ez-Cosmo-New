<header class="main-header">
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
          @if (Route::has('login'))
            @auth
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                  <a class="dropdown-toggle p-2" data-toggle="dropdown" type="button" id="dropdownMenuButton" aria-expanded="false">
                    <img src="{{asset('images/'. Auth::user()->profile_photo)}}" class="user-image" alt="User Image">
                    <span class="hidden-xs font-weight-bold">{{ Auth::user()->first_name }}</span>
                  </a>
                  <ul class="dropdown-menu" style="top: 45px; right:-10px" aria-labelledby="dropdownMenuButton">
                    <!-- User image -->
                    <li class="user-header dropdown-item">
                      <img src="{{asset('images/'. Auth::user()->profile_photo) }}" class="img-circle m-auto" alt="User Image">
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
                        <a href="{{route('admin.users.show', $id = Auth::id())}}" class="btn btn-default btn-sm text-black">Profile</a>
                      </div>
                      <div class="pull-right">
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-default btn-sm text-black">Sign out</a>
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
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        {{-- Users --}}
        <li class="treeview @yield("users")">
          <a href="#">
            <i class="fa fa-user fa-fw"></i> <span class="ml-2">Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("all-users")"><a href="{{route('admin.users.index')}}"><i class="fa fa-user-friends fa-fw"></i> <span class="ml-2"> All Users </span></a></li>
            <li class="@yield("add-user")"><a href="{{route('admin.users.create')}}"><i class="fa fa-user-plus fa-fw"></i> <span class="ml-2"> Add User </span></a></li>
            {{-- <li class="@yield("user-roles")"><a href="{{route('admin.users.roles')}}"><i class="fa fa-user-plus fa-fw"></i> <span class="ml-2"> User Roles &amp; Permissions </span></a></li> --}}
          </ul>
        </li>

        {{-- Products --}}
        <li class="treeview @yield("products")">
          <a href="#">
            <i class="fab fa-product-hunt fa-fw"></i> <span class="ml-2">Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("all-products")"><a href="{{route('admin.products.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Products </span></a></li>
            <li class="@yield("review-products")"><a href="{{route('admin.products.index')}}"><i class="fas fa-pen fa-fw"></i> <span class="ml-2"> Review Products </span></a></li>
            <li class="@yield("add-product")"><a href="{{route('admin.products.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Product </span></a></li>
          </ul>
        </li>

        {{-- Brands & Lines --}}
        <li class="treeview @yield("brands")">
          <a href="#">
            <i class="fas fa-copyright fa-fw"></i><span class="ml-2">Brands &#38; Lines</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("all-brands")"><a href="{{route('admin.brands.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Brands </span></a></li>
            <li class="@yield("add-brand")"><a href="{{route('admin.brands.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Brand </span></a></li>
            <li class="@yield("all-lines")"><a href="{{route('admin.lines.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Lines </span></a></li>
            <li class="@yield("add-line")"><a href="{{route('admin.lines.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Line </span></a></li>
          </ul>
        </li>

        {{-- Ingredients & Forms --}}
        <li class="treeview @yield("ingredients")">
          <a href="#">
            <i class="fas fa-pills fa-fw"></i><span class="ml-2">Ingredients &#38; Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("all-ingredients")"><a href="{{route('admin.ingredients.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Ingredients </span></a></li>
            <li class="@yield("add-ingredient")"><a href="{{route('admin.ingredients.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Ingredient </span></a></li>
            <li class="@yield("all-forms")"><a href="{{route('admin.forms.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Forms </span></a></li>
            <li class="@yield("add-form")"><a href="{{route('admin.forms.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Form </span></a></li>
          </ul>
        </li>

        {{-- Categories & Indications --}}
        <li class="treeview @yield("categories")">
          <a href="#">
            <i class="fas fa-code-branch fa-fw"></i><span class="ml-2">Categories &#38; Ind...</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("all-categories")"><a href="{{route('admin.categories.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Categories </span></a></li>
            <li class="@yield("add-category")"><a href="{{route('admin.categories.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Category </span></a></li>
            <li class="@yield("all-indications")"><a href="{{route('admin.indications.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Indications </span></a></li>
            <li class="@yield("add-indication")"><a href="{{route('admin.indications.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Indication </span></a></li>
          </ul>
        </li>

        {{-- Countries --}}
        <li class="treeview @yield("countries")">
          <a href="#">
            <i class="fas fa-globe-africa fa-fw"></i><span class="ml-2">Countries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("all-countries")"><a href="{{route('admin.countries.index')}}"><i class="far fa-eye fa-fw"></i> <span class="ml-2"> All Countries </span></a></li>
            <li class="@yield("add-country")"><a href="{{route('admin.countries.create')}}"><i class="fas fa-plus-square fa-fw"></i> <span class="ml-2"> Add Country </span></a></li>
          </ul>
        </li>

        @can('role-permission-edit')
        {{-- Roles --}}
        <li class="@yield("roles")">
            <a href="{{route('admin.roles.index')}}"><i class="fas fa-key fa-fw"></i> <span class="ml-2"> Edit Roles </span></a>
        </li>
        @endcan

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
