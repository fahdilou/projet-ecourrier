<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Application Web - NOCIBE - DSI">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{ asset('assets/css/template.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/datatables.min.css') }}">
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script> --}}



    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Toastr CSS -->

    <style>
        .bg-solo {
    background-color: rgb(196, 255, 184);
    }

    .bg-pere {
        background-color: rgb(255, 201, 101);
    }

    .bg-fils {
        background-color: rgb(255, 249, 191);
    }
    </style>


</head>

<body>



    
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

        
        <div class="app-header header-shadow" style="background-color:rgb(229, 239, 241)">
            <div class="app-header__logo">
                <div class="logo-src"><img src="{{ asset('assets/images/logo-inverse.png') }}" alt="Logo Inverse"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    
                 
                </div>


                <div class="app-header-right">
                    <div class="header-dots">
                        

                        <!------NOFIFICATION--------------->
                        {{-- <div class="dropdown">
                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                class="p-0 mr-2 btn btn-link">
                                <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-danger"></span>
                                    <i class="icon text-danger icon-anim-pulse fa-solid fa-bell"></i>
                                    <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                                </span>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header mb-0">
                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                        <div class="menu-header-image opacity-1"
                                            style="background-image: url('assets/images/dropdown-header/city3.jpg');">
                                        </div>
                                        <div class="menu-header-content text-dark">
                                            <h5 class="menu-header-title">Notifications</h5>
                                          
                                        </div>
                                    </div>
                                </div>

                              
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="p-3">
                                                    <div class="notifications-box">
                                                      {{ 'content' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    
                                   
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">Voir toutes les notifications</button>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                       <!------FIN NOFIFICATION--------------->

                     
                     
                    </div>



                    <!------USER PANEL--------------------------->
                    @include('layouts.partials.userpanel')

                    <!------FIN USER PANEL--------------------------->
                    <div class="header-btn-lg">
                        
                    </div>
                </div>
            </div>
        </div>


    
        <div class="app-main">


            <!-----MENU---------------------------------------->
          
            @include('layouts.partials.menu')
            <!-----FIN MENU---------------------------------------->



            <div class="app-main__outer">


                <div class="app-main__inner">


                    <!--CONTENT------------------------------------------------------->

                    @yield('content')






                

                    

                    
                </div>


                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                           
                            <div class="app-footer-right">
                                <h6>DSI - NOCIBE</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    
    <div class="app-drawer-overlay d-none animated fadeIn"></div>

    <script type="text/javascript" src="{{ asset('assets/scripts/template.js') }}"></script>

    @include('layouts.partials.alert_js')



    @stack('extra-js')

</body>

</html>


@stack('extra-modal')


