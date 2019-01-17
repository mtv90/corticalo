<nav class="d-none d-md-block navbar navbar-expand navbar-light" id="accordion">
  <ul class="d-none d-md-block nav navbar-nav navbar-light mr-auto">
    @switch(!Auth::guest())
      @case(Auth::user()->role_id == 1)
      <li class="nav-item {{Request::is('dashboard') ? 'active border bg-light' : ''}} border-bottom">
          <a class="nav-link" href="/dashboard"><span class="fa fa-home"></span> Dashboard</a>
      </li>
      @break
      @case(Auth::user()->role_id == 2)
      <li class="nav-item {{Request::is('dashboarduser') ? 'active border bg-light' : ''}} border-bottom">
          <a class="nav-link" href="/dashboarduser"><span class="fa fa-home"></span> Dashboard</a>
      </li>
      @break
    @endswitch

    <div>
      
      {{-- Prüfe Nutzer-Rolle und zeige nur nutzerspezifische Kategorien an --}}

      @switch(!Auth::guest())
        @case(Auth::user()->role_id == 1)
          <li class="nav-item  {{Request::is('studies') ? 'active border bg-light' : ''}} border-bottom" >
            <a class="nav-link col-md-10 " href="/studies"><span class="fa fa-book"></span> Studien</a>
          </li>
          <li class="nav-item dropdown {{Request::is('crfs') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/crfs"><span class="fa fa-file-text"></span> CRFs</a>
          </li>
          <li class="nav-item {{Request::is('forms') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/forms"><span class="fa fa-question"></span> Fragen</a>
          </li>
          <li class="nav-item {{Request::is('choices') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/choices"><span class="fa fa-bookmark"></span> Auswahlen</a>
          </li>
          <li class="nav-item {{Request::is('studies/stats') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/studies/stats"><span class="fa fa-bar-chart"></span> Ergebnisse</a>
          </li>
          <li class="nav-item {{Request::is('roles') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/roles"><span class=""></span> Benutzerrollen</a>
          </li>
          <li class="nav-item {{Request::is('rights') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/rights"><span class=""></span> Benutzerrechte</a>
          </li>
          @break
        @case(Auth::user()->role_id == 2)
          <li class="nav-item {{Request::is('patients') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/patients"><span class="fa fa-group"></span> Patienten</a>
          </li>
          <li class="nav-item {{Request::is('answers') ? 'active border bg-light' : ''}} border-bottom">
            <a class="nav-link" href="/answers"><span class="fa fa-check-square-o"></span> Antworten</a>
          </li>
          @break
      @endswitch
    </div>
  </ul>
</nav>

