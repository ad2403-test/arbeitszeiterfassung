<nav class="navbar navbar-expand-lg" style="background-color: #F4F4F4;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('users.dashboard') }}">
      <img src="{{ asset('logo.png') }}" style="width: 60px; height: 45px;">
    </a>    

    @if (Auth::check())
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: #005461;"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('users.dashboard') }}" style="color: #005461;">Dashboard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('users.settings') }}" style="color: #005461;">Einstellungen</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('users.vacation') }}" style="color: #005461;">Urlaub</a>
          </li>
          @if (Auth::user()->isAdmin())
            <div class="verticalLine mx-2" style="border-left: 2px solid #00B7B5;"></div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('terminals.index') }}" style="color: #005461;">Terminals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.management') }}" style="color: #005461;">Benutzer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logs.index') }}" style="color: #005461;">Logs</a>
            </li>
          @endif
        </ul>

        <!-- User dropdown -->
        <div class="dropdown">
          <button class="btn" style="background-color: #018790; color: #F4F4F4;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" style="background-color: #F4F4F4;">
            <li>
              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item" style="color: #005461;">
                      Abmelden
                  </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    @endif
  </div>
</nav>

<style>
  .nav-link:hover, .nav-link.active {
      color: #00B7B5 !important;
  }
</style>
