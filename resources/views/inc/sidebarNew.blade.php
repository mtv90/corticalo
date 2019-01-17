
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgb(74, 135, 146);">
        <!-- Brand Logo -->
        {{-- <a href="index3.html" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a> --}}
        <a class="navlogo brand-link" href="{{ url('/') }}" style="background-color: rgb(88, 89, 91); "><img id="logo" src="{{ asset('images/newLogo.png') }}" alt="Logo Icon"></a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <i class="nav-icon fa fa-user-circle"></i>
            </div>
            <div class="info">
              <a href="/user/{{Auth::user()->id}}" class="d-block">{{ Auth::user()->vorname }} {{ Auth::user()->nachname }}</a>
            </div>
          </div> --}}
          @foreach(Auth::user()->role->rights as $right)  
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                   <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{Request::is('dashboard') ? 'active border bg-light' : ''}}">
                      <i class="nav-icon fa fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>

                <li class="nav-header">STUDIENORGANISATION</li>
               
                    {{-- Zugriffsberechtigung prüfen --}}
                  @if($right->studindex == true)
                    <li class="nav-item has-treeview {{Request::is('studies') || Request::is('studies/create') ? 'menu-open' : ''}}">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                          Studien
                          <i class="right fa fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item {{Request::is('studies') ? 'active border rounded' : ''}}">
                          <a href="/studies" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Übersicht</p>
                          </a>
                        </li>
                        @if($right->studicreate == true)
                            <li class="nav-item {{Request::is('studies/create') ? 'active border rounded' : ''}}">
                              <a href="/studies/create" class="nav-link">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                <p>Studie erstellen</p>
                              </a>
                            </li>
                          @endif
                      </ul>
                    </li>
                    @endif
                    {{-- --- --}}

                  {{-- Zugriffsberechtigung prüfen --}}
                  @if($right->crfindex == true)
                  <li class="nav-item has-treeview {{Request::is('crfs') || Request::is('crfs/create') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-file-text"></i>
                      <p>
                        CRFs
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item {{Request::is('crfs') ? 'active border rounded' : ''}}">
                        <a href="/crfs" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Übersicht</p>
                        </a>
                      </li>
                      @if($right->crfcreate == true)
                      <li class="nav-item {{Request::is('crfs/create') ? 'active border rounded' : ''}}">
                        <a href="/crfs/create" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>CRF erstellen</p>
                        </a>
                      </li>
                      @endif  
                    </ul>
                  </li>
                  @endif
                  {{-- ---- --}}
                 
                  {{-- Zugriffsberechtigung prüfen --}}
                  @if($right->formindex == true)
                  <li class="nav-item has-treeview {{Request::is('forms') || Request::is('forms/create') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-question"></i>
                      <p>
                        Fragen
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item {{Request::is('forms') ? 'active border rounded' : ''}}">
                        <a href="/forms" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Übersicht</p>
                        </a>
                      </li>
                      @if($right->formcreate == true)
                          <li class="nav-item {{Request::is('forms/create') ? 'active border rounded' : ''}}">
                            <a href="/forms/create" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Fragen erstellen</p>
                            </a>
                          </li>
                      @endif
                    </ul>
                  </li>
                  @endif
                  {{-- ------ --}}

              {{-- Zugriffsberechtigung prüfen --}}
              @if($right->choiceindex == true)
                  <li class="nav-item has-treeview {{Request::is('choices') || Request::is('choices/create') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-square"></i>
                      <p>
                        Auswahlen
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item {{Request::is('choices') ? 'active border rounded' : ''}}">
                        <a href="/choices" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Übersicht</p>
                        </a>
                      </li>
                      {{-- Zugriffsberechtigung prüfen --}}
                      @if($right->choicecreate == true)
                          <li class="nav-item {{Request::is('choices/create') ? 'active border rounded' : ''}}">
                            <a href="/choices/create" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Auswahl erstellen</p>
                            </a>
                          </li>
                      @endif  
                      {{-- --- --}}
                    </ul>
                  </li>
              @endif 
              {{-- --- --}}

              {{-- Zugriffsberechtigung prüfen --}}
              @if($right->stats == true)
                  <li class="nav-item {{Request::is('studies/stats') ? 'active border rounded' : ''}}">
                    <a href="/studies/stats" class="nav-link">
                      <i class="nav-icon fa fa-bar-chart-o"></i>
                      <p>
                        Ergebnisse
                      </p>
                    </a>
                  </li>
              @endif  
              {{-- --- --}}

              {{-- Zugriffsberechtigung prüfen --}}
              @if($right->patindex == true) 
                  <li class="nav-item has-treeview {{Request::is('patients') || Request::is('patients/create') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-address-book"></i>
                      <p>
                        Patienten
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item {{Request::is('patients') ? 'active border rounded' : ''}}">
                        <a href="/patients" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Übersicht</p>
                        </a>
                      </li>
                      {{-- Zugriffsberechtigung prüfen --}}
                      @if($right->patcreate == true)
                          <li class="nav-item {{Request::is('patients/create') ? 'active border rounded' : ''}}">
                            <a href="/patients/create" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Patient erstellen</p>
                            </a>
                          </li>
                      @endif
                      {{-- --- --}}
                    </ul>
                  </li>
                @endif
              {{-- --- --}}

              {{-- Zugriffsberechtigung prüfen --}}
                
                  @if($right->resultindex == true || $right->resultcreate == true) 
                  <li class="nav-item has-treeview {{Request::is('answers') || Request::is('answers/create') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-check-square-o"></i>
                      <p>
                        Befragungen
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item {{Request::is('answers') ? 'active border rounded' : ''}}">
                        <a href="/answers" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Übersicht</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  @endif
               
              {{-- --- --}}

              <li class="nav-header">VERWALTUNG</li>
              {{-- Zugriffsberechtigung prüfen --}}
              @if($right->userindex == true)
              <li class="nav-item {{Request::is('user/{$id}') ? 'active border rounded' : ''}}">
                <a href="/user/{{Auth::user()->id}}" class="nav-link">
                  <i class="nav-icon fa fa-user-circle"></i>
                  <p>
                    Profil
                  </p>
                </a>
              </li>
              @endif
              {{-- --- --}}

              {{-- Zugriffsberechtigung prüfen --}}
              @if($right->rightindex == true || $right->roleindex == true)
                  <li class="nav-item has-treeview {{Request::is('roles') || Request::is('rights') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-lock"></i>
                      <p>
                        Rechteverwaltung
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      {{-- Zugriffsberechtigung prüfen --}}
                      @if($right->rightindex == true)
                          <li class="nav-item {{Request::is('rights') ? 'active border rounded' : ''}}">
                            <a href="/rights" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Benutzerrechte</p>
                            </a>
                          </li>
                          @endif 
                      {{-- --- --}}
                      {{-- Zugriffsberechtigung prüfen --}}
                      @if($right->roleindex == true)
                          <li class="nav-item {{Request::is('roles') ? 'active border rounded' : ''}}">
                            <a href="/roles" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Benutzerrollen</p>
                            </a>
                          </li>
                          @endif   
                      {{-- --- --}}
              @endif 
              {{-- --- --}}

              {{-- Navi Benutzergruppen --}}
              {{-- Zugriffsberechtigung prüfen --}}
              @if($right->usercreate == true)
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-group"></i>
                  <p>
                    Benutzergruppen
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/groups" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Übersicht</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/groups/create" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Gruppe erstellen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/login.html" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Login</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register.html" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Register</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Lockscreen</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              {{-- Ende Benutzergruppen --}}
            </ul>
            @endforeach
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>