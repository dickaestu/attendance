<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="{{ route('dashboard') }}"><img height="60" src="{{ url('frontend/images/logo.jpg') }}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto ml-5">
        <li class="nav-item {{Request::is('/') ? ' active' : '' }} mr-3">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item {{Request::is('request-attendance') ? ' active' : '' }} mr-3">
            <a class="nav-link" href="{{ route('request-attendance') }}">Request Attendance</a>
        </li>
        <li class="nav-item {{Request::is('request-time-off') ? ' active' : '' }} mr-3">
          <a class="nav-link" href="{{ route('request-time-off') }}">Request Time Off</a>
        </li>
        <li class="nav-item {{Request::is('request-overtime') ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('request-overtime') }}">Request Overtime</a>
        </li>
      </ul>
      <span class="navbar-text">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Account
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}">Profile</a>
                  <form action="{{ url('logout') }}" method="post">
                    @csrf
                  <button style="cursor: pointer" class="dropdown-item btn-link" type="submit">Logout</button>
                </form>
                </div>
              </li>
        </ul>
      </span>
    </div>
  </nav>