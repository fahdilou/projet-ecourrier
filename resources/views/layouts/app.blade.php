
<html dir="ltr" lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  
   
    <title>{{ config('app.name', 'Laravel') }}</title>
   
    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{ asset('assets/images/favicon2.png') }}"
    />
   
    <!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    
  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" />

  
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style1.min.css') }}" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

      

    


  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <svg
        class="tea lds-ripple"
        width="37"
        height="48"
        viewbox="0 0 37 48"
        fill="none"
        xmlns=""
      >
        <path
          d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
          stroke="#fec80e"
          stroke-width="2"
        ></path>
        <path
          d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
          stroke="#fec80e"
          stroke-width="2"
        ></path>
        <path
          id="teabag"
          fill="#fec80e"
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"
        ></path>
        <path
          id="steamL"
          d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke="#fec80e"
        ></path>
        <path
          id="steamR"
          d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13"
          stroke="#fec80e"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></path>
      </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
      <!-- ============================================================== -->



        <!-- =========================Pour augmenter la taille ===================== -->

    <style>
        @media (min-width: 992px) {
            #main-wrapper[data-layout="horizontal"][data-boxed-layout="boxed"] .page-wrapper,
            #main-wrapper[data-layout="horizontal"][data-boxed-layout="boxed"] .scroll-sidebar,
            #main-wrapper[data-layout="horizontal"][data-boxed-layout="boxed"] .top-navbar {
                position: relative;
                max-width: 1600px;
                margin: 0 auto;
            }
        }
    </style> 



      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
        @include('layouts.partials.userpanel')
      <!-- ============================================================= -->
      <!-- End Topbar header -->





      
      <!-- ============================================================= -->
      <!-- ============================================================= -->





      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================= -->
      @include('layouts.partials.menu')
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->


      


      
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper" >
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-titles">
          <div class="row">
            <div class="col-lg-8 col-md-6 col-12 align-self-center">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="link"><i class="ri-home-3-line fs-5"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    {{ Str::is('home', Route::currentRouteName()) ? 'Tableau de bord' : '' }}
                    {{ Str::is('myprofil.*', Route::currentRouteName()) ? 'Mon Profil' : '' }}
                    {{ Str::is('courriers.create', Route::currentRouteName()) ? 'Courrier' : '' }}
                    {{ Str::is('courriers.enCours', Route::currentRouteName()) ? 'Courrier' : '' }}
                    {{ Str::is('courriers.traite', Route::currentRouteName()) ? 'Courrier' : '' }}
                    {{ Str::is('factures.create', Route::currentRouteName()) ? 'Facture' : '' }}
                    {{ Str::is('factures.enCours', Route::currentRouteName()) ? 'Facture' : '' }}
                    {{ Str::is('factures.enCours', Route::currentRouteName()) ? 'Facture' : '' }}
                    {{ Str::is('factures.chronologie', Route::currentRouteName()) ? 'Facture' : '' }}
                    {{ Str::is('factures.traite', Route::currentRouteName()) ? 'Facture' : '' }}

                    {{ Str::is('reporting.facture', Route::currentRouteName()) ? 'Reporting' : '' }}
                    {{ Str::is('reporting.courrier', Route::currentRouteName()) ? 'Reporting' : '' }}
                   
                    {{ Str::is('users.*', Route::currentRouteName()) ? 'Paramètres' : '' }}
                    {{ Str::is('roles.*', Route::currentRouteName()) ? 'Paramètres' : '' }}

                    
                  </li>
                </ol>
              </nav>
              <h1 class="mb-0 fw-bold"> {{ Str::is('home', Route::currentRouteName()) ? 'Tableau de bord' : '' }}  
                {{ Str::is('myprofil.*', Route::currentRouteName()) ? 'Profil' : '' }}  
                   {{ Str::is('courriers.create', Route::currentRouteName()) ? 'Nouveau courrier' : '' }}
                   {{ Str::is('courriers.enCours', Route::currentRouteName()) ? 'Suivi des courriers' : '' }}
                   {{ Str::is('factures.enCours', Route::currentRouteName()) ? 'Suivi des factures' : '' }}
                   {{ Str::is('courriers.traite', Route::currentRouteName()) ? 'Courriers traités' : '' }}
                   {{ Str::is('factures.traite', Route::currentRouteName()) ? 'Factures traités' : '' }}
                   {{ Str::is('factures.chronologie', Route::currentRouteName()) ? 'Etat facture' : '' }}
                   {{ Str::is('factures.create', Route::currentRouteName()) ? 'Nouvelle facture' : '' }}
                   {{ Str::is('metiers.gestionWorkflow', Route::currentRouteName()) ? 'Configuration ' : '' }}

                   {{ Str::is('reporting.facture', Route::currentRouteName()) ? 'Facture' : '' }}
                   {{ Str::is('reporting.courrier', Route::currentRouteName()) ? 'Courrier' : '' }}
                  
                   {{ Str::is('users.*', Route::currentRouteName()) ? 'Utilisateurs' : '' }}
                   {{ Str::is('roles.*', Route::currentRouteName()) ? 'Rôles' : '' }}
              </h1>
            </div>

              <!-- extra-boutton -->
            @stack('extra-button')

                

          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">





          @yield('content')






        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">2023© DSI NOCIBE</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================= -->
    
 
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- apps -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.init.horizontal.js') }}"></script>
    <script src="{{ asset('assets/js/app-style-switcher.horizontal.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
 

    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

    
           

    <!-- <script src="{{ asset('assets/js/feather.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/custom.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/plugins/toastr-init.jss') }}"></script> -->



@include('layouts.partials.alert_js')
    



    @stack('extra-js')


  


    
  </body>
</html>
