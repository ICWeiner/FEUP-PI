<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link type="text/css" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"  >
    <!--CSS to Overide-->
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">

    <script   type="text/javascript" src={{ asset('js/bootstrap.bundle.js') }} defer> </script>
    <script    type="text/javascript" src={{ asset('js/app.js') }} defer> </script>
    {{-- <script    type="text/javascript" src={{ asset('js/translation.js') }} defer> </script> --}}
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.3.0/jquery.flexdatalist.min.js" integrity="sha512-JEX6Es4Dhu4vQWWA+vVBNJzwejdpqeGeii0sfiWJbBlAfFzkeAy6WOxPYA4HEVeCHwAPa+8pDZQt8rLKDDGHgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.3.0/jquery.flexdatalist.css" integrity="sha512-mVj7k7kIC4+FkO7xQ04Di4Q4vSg8BP3HA7Pzss2ib+EqufKS5GuJW1mGtVo70i9hHTgEv6UmxcPb6tddRdk89A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('pageJS')
</head>

<body class="d-flex flex-column min-vh-100">

  <header class="p-3 bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="White" class="bi bi-house-door-fill" viewBox="0 0 16 16" id="home">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
          </svg>
          <img src="/images/template/reindeer.png" alt="xmasIcon" width="32" height="32" id="xmas" style="display: none">
          <img src="/images/template/easter-bunny.png" alt="easterIcon" width="32" height="32" id="easter" style="display: none">
          <img src="/images/template/fireworks.png" alt="newYearIcon" width="32" height="32" id="newYear" style="display: none">
          <img src="/images/template/pumpkin.png" alt="halloweenIcon" width="32" height="32" id="halloween" style="display: none">
        </a>

        <div class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{url('feed')}}" class="nav-link px-2 link-light"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-rss-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm1.5 2.5c5.523 0 10 4.477 10 10a1 1 0 1 1-2 0 8 8 0 0 0-8-8 1 1 0 0 1 0-2zm0 4a6 6 0 0 1 6 6 1 1 0 1 1-2 0 4 4 0 0 0-4-4 1 1 0 0 1 0-2zm.5 7a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
          </svg></a></li>
        </div>
        <!--<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>-->
        @if(Auth::check())
          @if(Session::has('orig_user'))
              <a class="px-2 link-light" href="/admin/user/switch/stop">Switch back</a>
          @endif
          <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
              <li><a class="dropdown-item" href="{{route('my.requests')}}">My Requests</a></li>
              <li><a class="dropdown-item" href="{{route('my.requests')}}">My Events</a></li>
              @if(!Session::has('orig_user') && Auth::check() && Auth::user()->isAdmin())
                <li><a class="dropdown-item" href="{{url('admin')}}">Admin Dashboard</a></li>
                <li><a class="dropdown-item" href="/admin/user/switch/start">Switch to User View</a></li>      
              @endif
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ url('/logout')}}">Sign out</a></li>
            </ul>
          </div>
        @else
          <form class="form-inline my-2 my-lg-0">
            <button class="btn btn btn-secondary my-2 my-sm-0 text-light" type="submit">
              <a class="text-decoration-none text-dark" href="{{ url('/login') }}">Login</a>
            </button>
          </form>
        @endif

        <button id="sideToggle" class="btn border border-grey mx-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="background-color:transparent">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
          </svg>
        </button>

      </div>
    </div>
  </header>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" href="{{route('my.requests')}}">My Requests<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled text-light" href="#">Contacts</a>
      </li>
      @if (Auth::check())
      <li class="nav-item">
        <a class="nav-link text-light" href="{{route('create.event')}}">Create Event Request</a>
      </li>
      @endif
    </ul>
    @if (Auth::check())
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0 text-light" type="submit"><a href="{{ route('logout') }}">Logout</a></button>
    </form>
    @else
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0 text-light" type="submit"><a href="{{ route('login') }}">Login</a></button>
    </form>
    @endif
  </div>
</nav>

<div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header justify-content-center">
    <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel">Paginas Amarelas</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <hr id="hrSide">
  <div class="offcanvas-body text-white">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button id="sideButton" class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          Home ↓
        </button>
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">Overview</a></li>
            <li><a href="#" class="nav-link rounded text-light">Updates</a></li>
            <li><a href="#" class="nav-link rounded text-light">Reports</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button id="sideButton" class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Event Categories ↓
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="events" class="nav-link rounded text-light">Overview</a></li>
            <li><a href="#" class="nav-link rounded text-light">Weekly</a></li>
            <li><a href="#" class="nav-link rounded text-light">Monthly</a></li>
            <li><a href="#" class="nav-link rounded text-light">Annually</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button id="sideButton" class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Category 1 ↓
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">New</a></li>
            <li><a href="#" class="nav-link rounded text-light">Processed</a></li>
            <li><a href="#" class="nav-link rounded text-light">Shipped</a></li>
            <li><a href="#" class="nav-link rounded text-light">Returned</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button id="sideButton"class="btn btn-toggle align-items-center rounded collapsed text-light" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Category 2 ↓
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="nav-link rounded text-light">New...</a></li>
            <li><a href="#" class="nav-link rounded text-light">Profile</a></li>
            <li><a href="#" class="nav-link rounded text-light">Settings</a></li>
            <li><a href="#" class="nav-link rounded text-light">Sign out</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>

  @yield('content')

  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 bg-dark mt-auto">
    <p class="col-md-4 mb-0 text-light p-3">© 2023 Company, Inc ඞ</p>

    <!--<a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>-->

    <ul class="nav col-md-4 justify-content-end px-3">
      <li class="nav-item bg-dark"><a href="{{url('/')}}" class="nav-link px-2 text-light">Home</a></li>
      <li class="nav-item bg-dark"><a href="#" class="nav-link px-2 text-light">My Requests</a></li>
      <li class="nav-item bg-dark"><a href="{{url('/about')}}" class="nav-link px-2 text-light">About Us</a></li>
      <li class="nav-item bg-dark"><a href="{{url('/faq')}}" class="nav-link px-2 text-light">FAQs</a></li>
      <li class="nav-item bg-dark"><a href="{{url('/contacts')}}" class="nav-link px-2 text-light">Contacts</a></li>
    </ul>
  </footer>
</body>
</html>