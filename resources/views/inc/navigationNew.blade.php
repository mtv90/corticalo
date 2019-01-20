@include('inc.menu')

<nav class="flexcontainer">
    <div class="navbar-header">
        <a title="Startseite" class="navlogo" href="{{ url('/') }}"><img id="logo" src="{{ asset('images/newLogo.png') }}" alt="Logo Icon"></a>
    </div>
    @if(!Auth::guest())
        <div class="">
            <a href="/dashboard" class="dashBtn display-4 mt-3"><h3><i class="fa fa-home"></i></h3></a>
        </div>
    @endif
    <div class="menubtn"  onclick="openNav()">
        <img title="Menü" id="menubtn" src="{{ asset('images/button_icon.png') }}" alt="Button Icon">
    </div>
</nav>