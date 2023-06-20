@extends('layouts.app')

@section('content')



    <!---------BREADCRUMB------------------------------------------>
    <div class="app-page-title app-page-title-simple">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon p-0">
                    <i class="bi bi-house icon-gradient bg-ripe-malin"></i>
                </div>
                <div>Tableau de bord
                    <div class="page-title-subheading">Obtenez une vue d'ensemble claire et concise de votre activité grâce à notre tableau de bord intuitif</div>
                </div>
            </div>


            <div class="page-title-actions">

                
                {{-- <button type="button"  class="btn btn-primary">
                    <i class="fa-solid fa-plus px-1"></i>Nouveau
                </button> --}}
            </div>

        </div>
    </div>

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            {{-- {{ 'contenu' }} --}}

        </div>
    </div>



    


@endsection



@push('extra-js')


@endpush


@push('extra-modal')


@endpush
