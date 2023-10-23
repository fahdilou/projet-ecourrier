<!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================= -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav">
              <!-- User Profile-->
              <li class="nav-small-cap">
                <i class="mdi mdi-dots-horizontal"></i>
                <span class="hide-menu"></span>
              </li>
              
              <li class="sidebar-item {{ Str::is('home', Route::currentRouteName()) ? 'selected' : '' }}" >
                <a
                  class="sidebar-link  {{ Str::is('home', Route::currentRouteName()) ? 'active' : '' }}"
                  href="{{ route('home') }}"
                  aria-expanded="false"
                  ><i data-feather="home" class="feather-icon"></i
                  ><span class="hide-menu">Tableau de bord </span></a
                >
                
              </li>

                    
              
             
              @can('onglet_courrier')
              <li class="sidebar-item {{ Str::is('courriers.*', Route::currentRouteName()) ? 'selected' : '' }}">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-regular fa-envelope"></i><span class="hide-menu">Courriers</span></a>
                <ul aria-expanded="false" class="collapse first-level">

                  @can('onglet_courrier_create')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('courrier.create', Route::currentRouteName()) ? 'active' : '' }} " href="{{ route('courriers.create') }}" aria-expanded="false"><i class="fa-solid fa-plus"></i><span class="hide-menu">Nouveau</span></a>
                   
                  </li>
                  @endcan

                  @can('onglet_courrier_suivi')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('courriers.enCours', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('courriers.enCours') }}" aria-expanded="false"><i class="fa-solid fa-list"></i><span class="hide-menu">Suivi</span></a>
                  
                  </li>
                  @endcan

                  @can('onglet_courrier_traite')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('courriers.traite', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('courriers.traite') }}" aria-expanded="false"><i class="fa-solid fa-check-to-slot" ></i><span class="hide-menu">Traité</span></a>
                  
                  </li>
                  @endcan
                  
                 
                 
                </ul>
              </li>

              @endcan


        

            @can('onglet_facture')
              <li class="sidebar-item {{ Str::is('factures.*', Route::currentRouteName()) ? 'selected' : '' }}">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-solid fa-file-invoice"></i><span class="hide-menu">Factures</span></a>
                <ul aria-expanded="false" class="collapse first-level">

                  @can('onglet_facture_create')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('factures.create', Route::currentRouteName()) ? 'active' : '' }} " href="{{ route('factures.create') }}" aria-expanded="false"><i class="fa-solid fa-plus"></i><span class="hide-menu">Nouveau</span></a>
                   
                  </li>
                  @endcan

                  @can('onglet_facture_suivi')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('factures.enCours', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('factures.enCours') }}" aria-expanded="false"><i class="fa-solid fa-list"></i><span class="hide-menu">Suivi</span></a>
                  
                  </li>
                  @endcan


                  @can('onglet_facture_traite')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('factures.traite', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('factures.traite') }}" aria-expanded="false"><i class="fa-solid fa-check-to-slot" ></i><span class="hide-menu">Traité</span></a>
                  
                  </li>
                  @endcan
                  
                 
                 
                </ul>
              </li>
            @endcan




              



              
            @can('onglet_reporting')
              <li class="sidebar-item {{ Str::is('reporting.*', Route::currentRouteName()) ? 'selected' : '' }}">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text feather-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><span class="hide-menu">Reporting</span></a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('reporting.facture', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('reporting.facture') }}" aria-expanded="false"><i class="ri-apps-2-line"></i><span class="hide-menu">Facture</span></a>
                   
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link {{ Str::is('reporting.courrier', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('reporting.courrier') }}"aria-expanded="false"><i class="ri-apps-2-line"></i><span class="hide-menu">Courrier</span></a>
                  
                  </li>
                  
                 
                 
                </ul>
              </li>
              @endcan

              @can('onglet_metier')
              <li class="sidebar-item {{ Str::is('metiers.*', Route::currentRouteName()) ? 'selected' : '' }}">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-solid fa-bars"></i></i><span class="hide-menu">MENU METIER</span></a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('metiers.gestionWorkflow', Route::currentRouteName()) ? 'active' : '' }} " href="{{ route('metiers.gestionWorkflow') }}" aria-expanded="false"><i class="fa-brands fa-creative-commons-nd"></i><span class="hide-menu">Config workflow</span></a>
                   
                  </li>

                  
                 
                 
                </ul>
              </li>
              @endcan


             

              <li class="sidebar-item {{ Str::is('roles.*', Route::currentRouteName()) ? 'selected' : '' }}">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-solid fa-gear"></i><span class="hide-menu">Paramètres</span></a>
                <ul aria-expanded="false" class="collapse first-level">
                 
                  @can('users_control')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('roles.users', Route::currentRouteName()) ? 'active' : '' }} " href="{{ route('users.index') }}" aria-expanded="false"><i class="fa-solid fa-user"></i><span class="hide-menu">Utilisateurs</span></a>
                   
                  </li>
                  @endcan

                  @can('roles_control')
                  <li class="sidebar-item ">
                    <a class="sidebar-link {{ Str::is('roles.roles', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('roles.index') }}" aria-expanded="false"><i class="fa-solid fa-user-shield"></i><span class="hide-menu">Rôles & Permissions</span></a>
                  
                  </li>
                  @endcan
                  
                 
                 
                </ul>
              </li>
              
              
            
              
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->