<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('website.home') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('website/assets/img/SAB.png') }}" alt="">
        <h1 class="d-flex align-items-center">SAB INVESTMENTS</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('website.home') }}" @if(request()->routeIs('website.home')) class="active" @endif>Home</a></li>
          <li><a href="{{ route('website.about') }}" @if(request()->routeIs('website.about')) class="active" @endif>About</a></li>
          <li><a href="{{ route('website.services') }}" @if(request()->routeIs('website.services')) class="active" @endif>Services</a></li>
          <li><a href="{{ route('website.team') }}" @if(request()->routeIs('website.team')) class="active" @endif>Team</a></li>
          <li><a href="{{ route('website.blog') }}" @if(request()->routeIs('website.blog')) class="active" @endif>Blog</a></li>
          <li><a href="{{ route('website.contact') }}" @if(request()->routeIs('website.contact')) class="active" @endif>Contact</a></li>
          
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header>