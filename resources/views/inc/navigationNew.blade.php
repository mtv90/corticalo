@include('inc.menu')

<nav class="flexcontainer">
    <div class="navbar-header">
        <a title="Startseite" class="navlogo" href="{{ url('/') }}"><img id="logo" src="{{ asset('images/newLogo.png') }}" alt="Logo Icon"></a>
    </div>
    @if(!Auth::guest())
        <div class="userSec">
            <a title="Benutzer-Dashboard" href="/dashboard" class="{{url('dashBtn')}}"><h2><i class="fa fa-home mt-3"></i></h2></a>
        </div>
    @endif
    <div class="menubtn"  onclick="openNav()">
        <img title="Menü" class="mt-3" id="menubtn" src="{{ asset('images/button_icon.png') }}" alt="Button Icon">
    </div>
</nav>