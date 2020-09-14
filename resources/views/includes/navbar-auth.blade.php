<nav
      class="navbar navbar-expand-lg navbar-light navbar-damkar fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
          <img src="/images/logo-damkar.png" alt="Logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories') }}" class="nav-link">Kategori</a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ url('register') }}" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
              <a
                href="{{ url('login') }}"
                class="btn btn-success nav-link px-4 text-white"
                >Sign In</a
              >
            </li> --}}
          </ul>
        </div>
      </div>
    </nav>