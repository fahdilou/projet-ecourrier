<!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-lg navbar-dark">
          <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-lg-none"
              href="javascript:void(0)"
              ><i class="ri-close-line ri-menu-2-line fs-6"></i
            ></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{route('home')}}">
              <!-- Logo icon -->
              <b class="logo-icon">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="{{ asset('assets/images/logo-news.png') }}"
                  alt="homepage"
                  class="dark-logo" style="margin-right: -23px"
                />
                <!-- Light Logo icon -->
                <img
                  src="{{ asset('assets/images/logo-light-icon.png') }}"
                  alt="homepage"
                  class="light-logo"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                <!-- dark Logo text -->
                <img
                  src="{{ asset('assets/images/logo-texts.png') }}"
                  alt="homepage"
                  class="dark-logo"
                />
                <!-- Light Logo text -->
                <img
                  src="{{ asset('assets/images/logo-light-text.png') }}"
                  class="light-logo"
                  alt="homepage"
                />
              </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="topbartoggler d-block d-lg-none waves-effect waves-light"
              href="javascript:void(0)"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
              ><i class="ri-more-line fs-6"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
              <!-- This is  -->
              <!-- <li class="nav-item"> <a
                                  class="nav-link sidebartoggler d-none d-md-block"
                                  href="javascript:void(0)"><i data-feather="menu"></i></a> </li> -->
              <!-- search -->
              
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">
           
              <!-- ============================================================== -->
            
              
              <!-- ============================================================== -->
              <!-- Profile -->
              <!-- ============================================================== -->
                            <!-- dropdown css -->
                           
                          
                            


              <li class="nav-item dropdown profile-dropdown">
                <a
                  class="nav-link dropdown-toggle d-flex align-items-center"
                  href="#"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  id="dropdownMenuButton"
                >
                  <img
                    src="{{ asset('assets/img/avatars/blank.png') }}"
                    alt="user"
                    width="30"
                    class="profile-pic rounded-circle"
                  />
                  <div class="d-none d-md-flex">
                    <span class="ms-2"
                      >Salut,
                      <span class="text-dark fw-bold">{{ Auth::user()->name }}</span></span
                    >
                    <span>
                      <i data-feather="chevron-down" class="feather-sm"></i>
                    </span>
                  </div>
                </a>
                <div
                  class="
                    dropdown-menu dropdown-menu-end
                    mailbox
                    dropdown-menu-animate-up
                  " style="max-width: 330px;"
                >
                <ul class="list-style-none">
                  <li class="p-30 pb-2">
                      <div class="rounded-top d-flex align-items-center">
                          <h3 class="card-title mb-0">Profil utilisateur</h3>
                          <div class="ms-auto">
                              <a href="javascript:void(0)" class="link py-0">
                                  <i data-feather="x-circle"></i>
                              </a>
                          </div>
                      </div>
                      <div class="d-flex flex-column flex-md-row align-items-center mt-4 pt-3 pb-4 border-bottom">
                          <img src="{{ asset('assets/img/avatars/blank.png') }}" alt="user" width="90" class="rounded-circle mb-3 mb-md-0 me-md-4" />
                          <div class="ms-md-4">
                              <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                              <span class="text-muted">{{ Auth::user()->poste }}</span>
                              <p class="text-muted mb-0 mt-1">
                                  <i data-feather="mail" class="feather-sm me-1"></i>
                                  {{ Auth::user()->email }}
                              </p>
                          </div>
                      </div>
                  </li>
                  <li class="p-30 pt-0">
                      <div class="message-center message-body position-relative" style="height: 150px">
                          <!-- Message -->
                          <a href="{{ route('myprofil.index') }}" class="message-item px-2 d-flex align-items-center border-bottom py-3">
                              <span class="btn btn-light-secondary btn-rounded-lg text-secondary">
                                <i class="fa-solid fa-gear"></i>
                              </span>
                              <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                  <h5 class="message-title mb-0 mt-1 fs-4 font-weight-medium">
                                      Paramètre du compte
                                  </h5>
                              </div>
                          </a>
                          <div class="mt-4">
                              <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary text-white" href="javascript:void(0);">Déconnexion</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </div>
                  </li>
              </ul>
              
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================= -->
      <!-- End Topbar header -->