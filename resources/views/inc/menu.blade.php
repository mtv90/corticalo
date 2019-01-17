<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/anwender') }}">Anwender</a>
        <a href="{{ url('/funktionen') }}">Funktionen</a>
        @guest
            <a href="{{ route('login') }}"><span class="login-link">User-Login</span></a>
        @else
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span class="login-link">
              <span class="fa fa-power-off"></span>
              {{ __('Logout') }}
            </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
        <a href="{{ url('/about') }}">Über corticalo</a>
        <a href="{{ url('/kontakt') }}">Kontakt</a>
        <a href="{{ url('/impressum') }}">Impressum</a>
        <a href="{{ url('/datenschutz') }}">Datenschutz</a>
    </div>
</div>