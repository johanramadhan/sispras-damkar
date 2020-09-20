<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
      <link href="/style/main.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
    @stack('addon-style')
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/fireman.svg" alt="" class="my-4 w-50" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('admin-dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}"
            >
              Dashboard
            </a>
            <a
              href="{{ route('category.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : '' }}"
             >
              Kategori
            </a>
            <a
              href="{{ route('proposal.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/proposal')) ? 'active' : '' }}"
             >
              Pengajuan
            </a>
            <a
              href="{{ route('proposal-gallery.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/proposal-gallery*')) ? 'active' : '' }}"
             >
              Galeri Pengajuan
            </a>
            <a
              href="{{ route('product.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/product')) ? 'active' : '' }}"
             >
              Aset
            </a>
            <a
              href="{{ route('product-gallery.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/product-gallery*')) ? 'active' : '' }}"
             >
              Galeri Aset
            </a>
            <a
              href="{{ route('user.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/user*')) ? 'active' : '' }}"
             >
              Data Users
            </a>
            {{-- <a
              href="#"
              class="list-group-item list-group-item-action"
            >
              Sispras Settings
            </a>
            <a
              href="#"
              class="list-group-item list-group-item-action"
            >
              My Account
            </a> --}}
            <a
              href="{{ route('logout') }}"
              onclick="event.preventDefault(); 
              document.getElementById('logout-form').submit();"
              class="list-group-item list-group-item-action"
            >
              Sign Out
            </a>
          </div>
        </div>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav
            class="navbar navbar-expand-lg navbar-light navbar-damkar fixed-top"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <button
                class="btn btn-secondary d-md-none mr-auto mr-2"
                id="menu-toggle"
              >
                &laquo; Menu
              </button>
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex ml-auto">
                  <li class="nav-item dropdown">
                    <a
                      href="#"
                      class="nav-link"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                    >
                      <img
                        src="/images/logo-damkar.png"
                        alt=""
                        class="rounded-circle-2 mr-2 profile-picture"
                      />
                      Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                      <a href="{{ route('home') }}" class="dropdown-item">Home</a>
                      <a href="{{ route('admin-dashboard') }}" class="dropdown-item">Dashboard 1</a>
                      <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard 2</a>
                      <a href="/dashboard-account.html" class="dropdown-item">Settings</a>
                      <div class="dropdown-divider"></div>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inlink-block mt-2">
                      @php
                          $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                      @endphp
                      @if ($carts > 0)
                        <img src="/images/icon-cart-filled.svg" alt="" />
                        <div class="card-badge">{{ $carts }}</div>
                        @else
                        <img src="/images/icon-cart-empty.svg" alt="" />
                      @endif
                      
                    </a>
                  </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg d-lg-none">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Hi, {{ Auth::user()->name }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inlink-block mt-2">
                      @php
                          $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                      @endphp
                      @if ($carts > 0)
                        <img src="/images/icon-cart-filled.svg" alt="" />
                        <div class="card-badge">{{ $carts }}</div>
                        @else
                        <img src="/images/icon-cart-empty.svg" alt="" />
                      @endif
                      
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

          {{-- Content --}}
          @yield('content')

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="/script/navbar-scroll.js"></script>
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
  </body>
</html>
