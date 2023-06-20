<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">

        <li class="menu-item {{ Str::is('home', Route::currentRouteName()) ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div>Tableau de bord</div>
            </a>
        </li>


        @can('onglet_app')

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MENU APPLICATION</span>
        </li>


   

        <!-- Layouts -->
        <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons fa-solid fa-truck"></i>
               
                <div data-i18n="Layouts">Pesée Ciment</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active' : '' }}">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div>Entrée</div>
                    </a>
                </li>

                <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active' : '' }}">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div>Sortie</div>
                    </a>
                </li>


            </ul>
        </li>

        <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons fa-solid fa-truck-pickup"></i>
               
               
                <div data-i18n="Layouts">Pesée Autres Produits</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active' : '' }}">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div>Entrée</div>
                    </a>
                </li>

                <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active' : '' }}">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div>Sortie</div>
                    </a>
                </li>


            </ul>
        </li>


        {{-- <li class="menu-item {{ Str::is('demandes.*', Route::currentRouteName()) ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons far fa-address-card"></i>
                
                <div>Mes DA affectées</div>
            </a>
        </li> --}}




        @endcan



        @can('onglet_reportings')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MENU REPORTINGS</span>
        </li>

        <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons fa-solid fa-chart-simple"></i>
                
                <div data-i18n="Layouts">Reporting</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active' : '' }}">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div>Reporting 1</div>
                    </a>
                </li>

                <li class="menu-item {{ Str::is('', Route::currentRouteName()) ? 'active' : '' }}">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div>Reporting 2</div>
                    </a>
                </li>


            </ul>
        </li>



        @endcan
        


        @can('onglet_metier')

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MENU METIER</span>
        </li>

        <li class="menu-item">
            <a href="app-email.html" class="menu-link">
                <i class="menu-icon tf-icons fas fa-genderless"></i>
                <div>Type de produit</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="app-email.html" class="menu-link">
                <i class="menu-icon tf-icons fas fa-genderless"></i>
                <div>Paramètres de pesée</div>
            </a>
        </li>

        @endcan



        @can('onglet_parametres')
            
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MENU PARAMETRES</span>
        </li>

        <li class="menu-item {{ Str::is('users.*', Route::currentRouteName()) ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fas fa-user-friends"></i>
                <div>Utilisateurs</div>
            </a>
        </li>

        <li class="menu-item {{ Str::is('roles.*', Route::currentRouteName()) ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fas fa-shield-alt"></i>
                <div>Rôles & Permissions</div>
            </a>
        </li>


        @endcan
        

















    </ul>



</aside>