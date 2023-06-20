@extends('layouts.app')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres Systeme /</span> <a href="{{ route('roles.index') }}"> Rôles & Permissions </a> / Création</h4>
        </div>
    
 
    
    </div>

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="main-card mb-3 card">
                <form action="{{ route('roles.store') }}" method="POST" autocomplete="off">
                    @csrf
                <div class="card-header">
                    <i class="bi bi-person-lines-fill header-icon icon-gradient bg-plum-plate"> </i>
                  Création d'un rôle utilisateur
  
                </div>
                <div class="card-body">
                    <div class="scroll-area-lg">
                        <div class="scrollbar-container ps--active-y ps">

                            
                            <div class="mb-2 col-md-12">
                                <label class="form-label">Nom <span class="text-danger">*</span> </label>
                                <input required type="text" name="name" value="{{ old('name') }}"  id="name"  class="form-control form-control-sm @error('name') is-invalid @enderror" >
                            </div>


                            



                            <div class="divider">
                                <div class="divider-text">Permissions</div>
                            </div>




                                            @foreach ($permissions as $roleChunk)
                                                <div class="row m-0">
                                                    @foreach ($roleChunk as $role)
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="permissions[]" value="{{ $role->id }}" />
                                                                <label class="col-md-6 col-form-label">{{ $role->name }}</label>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            @endforeach
                                       
                                       


                        <div class="ps__rail-x" style="left: 0px; bottom: -291px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 291px; height: 500px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 119px; height: 500px;"></div></div></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-label-secondary waves-effect mx-3" >Annuler</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
             
                </div>
            <form>
            </div>

        </div>
    </div>


</div>
    


@endsection



@push('extra-js')


@endpush


@push('extra-modal')


@endpush
