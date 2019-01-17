<nav class="navbar navbar-expand navbar-light" >
    <div class="container-fluid" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            {{-- Left Side of Navbar --}}
            
            @switch(!Auth::guest())
                @case(Auth::user()->role_id == 1)
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"> <a class="nav-link" href="/dashboard"><span class="fa fa-home fa-lg"></span> Mein Bereich</a> </li>
                </ul>
                @break
                @case(Auth::user()->role_id == 2)
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"> <a class="nav-link" href="/dashboarduser"><span class="fa fa-home fa-lg"></span> Mein Bereich</a> </li>
                </ul>
                @break
                @default
                <div></div>
            @endswitch
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="{{Request::is('login') ? 'active border bg-light' : ''}}"><a class="nav-link" href="{{ route('login') }}">{{ __('Anmelden') }}</a></li>
                    <li class="{{Request::is('register') ? 'active border bg-light' : ''}}"><a class="nav-link" href="{{ route('register') }}">{{ __('Registrieren') }}</a></li>
                @else
                    <li class="nav-item"> <strong class="nav-link"> <span class="fa fa-id-badge fa-lg"></span> {{ Auth::user()->name }} </strong> </li>
                    <li class="nav-item">    
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         <span class="fa fa-power-off fa-lg"></span>
                         {{-- {{ __('Logout') }}  --}}
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

