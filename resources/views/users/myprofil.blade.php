



@extends('layouts.app')

@section('content')
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />


<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}" />
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>


<div class="container-xxl flex-grow-1 container-p-y">


    <!---------FIN BREADCRUMB------------------------------------------>


    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
            <div class="container-fluid">
                <!-- ============================================================= -->
                <!-- Start Page Content -->
                <!-- ============================================================= -->
                <!-- Row -->
                <div class="row">
                  <!-- Column -->
                  <div class="col-lg-3 col-xlg-3 col-md-5">
                    <div class="card">
                      <div class="card-body">
                        <center class="mt-4">
                          <img src="{{ asset('assets/img/avatars/blank.png') }}" class="rounded-circle" width="150">
                          <h4 class="mt-2">{{ auth()->user()->name }}</h4>
                          <h6 class="card-subtitle">{{ auth()->user()->email }}</h6>
                          
                        </center>
                      </div>
                      <div>
                        <hr>
                      </div>
                    
                    </div>
                  </div>
                  <!-- Column -->
                  <!-- Column -->
                 
                  <div class="col-lg-6 col-xlg-6 col-md-7">

                    <div class="card overflow-hidden">
                      <!-- Tabs -->
                      <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="true">Informations</a>
                        </li>
                      </ul>
                      <!-- Tabs -->
                      <div class="tab-content" id="pills-tabContent">
                         <form action="{{ route('myprofil.update') }}" method="post">
                    @csrf
                        <div class="tab-pane fade active show" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                          <div class="card-body">
                            <form class="form-horizontal form-material">
                              <div class="mb-3">
                                <label class="col-md-12">Nom & Prénom</label>
                                <div class="col-md-12">
                                  <input type="text" required disabled="disabled" name="name" value="{{ auth()->user()->name }}" class="form-control form-control-line">
                                </div>
                              </div>
                              <div class="mb-3">
                                <label for="example-email" class="col-md-12">Adresse Email</label>
                                <div class="col-md-12">
                                  <input type="email" disabled="disabled" value="{{ auth()->user()->email }}" class="form-control form-control-line">
                                </div>
                              </div>
                              <div class="mb-3">
                                <label for="example-email" class="col-md-12">Poste</label>
                                <div class="col-md-12">
                                  <input type="text" name="poste" required  value="{{ auth()->user()->poste }}" class="form-control form-control-line">
                                </div>
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                              </div>
                              
                              <div class="row mt-5">
                                <div class="col text-left">
                                    <button class="btn btn-primary" type="submit">Sauvegarder</button>
                                </div>

                                @if (Auth::user()->type_connexion=='SQL')
                                <div class="col text-right">
                                    <button class="btn btn-danger"  type="button" data-bs-toggle="modal" data-bs-target="#addForm">Changer de mot de passe</button>
                                </div>
                                @endif
                                
                              </div>
                            </form>
                            
                          </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                 
                  <!-- Column -->
                  <div class="col-lg-3 col-xlg-3 col-md-3">

                    <div class="card overflow-hidden">
                      <!-- Tabs -->
                      <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="true">Rȏle Utilisateur</a>
                        </li>
                      </ul>
                      <!-- Tabs -->
                      <div class="tab-content" id="pills-tabContent">
                         <form >
                    @csrf
                        <div class="tab-pane fade active show" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                          <div class="card-body">
                            <form class="form-horizontal form-material">
                              <div class="mb-3">
                                <label class="col-md-12">Profil</label>
                                <div class="col-md-12">
                                  <input type="text" disabled="disabled"    value="{{ Auth::user()->getRoleNames() }} " class="form-control form-control-line">
                                </div>
                              </div>
                              
                              
                             
                            </form>
                          </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Row -->
                <!-- ============================================================= -->
                <!-- End PAge Content -->
                <!-- ============================================================= -->
              </div>
    </div>



</div>


@endsection


<div class="modal fade" id="addForm" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('myprofil.changepassword') }}" method="POST" autocomplete="off">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Changement de mot de passe </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                {{-- content --}}

                <div class="mb-2 input-group-sm">
                    <label class="form-label">Mouveau mot de passe</label>
                    <input type="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} "
                        id="password" name="password" required>
                </div>

                <div class="mb-2 input-group-sm">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation"
                        name="password_confirmation" required>
                </div>

                <input type="hidden" name="user_id2" value="{{ auth()->user()->id }}">

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
            </div>
        </div>
        </div>
    </form>
</div>






<!-------------------Extra Js--------------------------------------->
@push('extra-js')




<!----------------------Modal------------------------------------------>




@endpush



