@extends('layouts.app')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres Systeme /</span> <a href="{{ route('roles.index') }}"> Rôles & Permissions </a> /  {{$role->name}} </h4>
        </div>
    
 
    
    </div>

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="main-card mb-3 card">
                <div class="card-header">
                    <i class="bi bi-person-lines-fill header-icon icon-gradient bg-plum-plate"> </i>
                   {{$role->name}}
  
                </div>
                <div class="card-body">
                    <div class="scroll-area-lg">
                        <div class="scrollbar-container ps--active-y ps">

                            

                            <div class="mb-2 col-md-12">
                                <label class="form-label">Nom <span class="text-danger">*</span> </label>
                                <input disabled required type="text" name="name" value="{{ $role->name }}"  id="name"  class="form-control form-control-sm @error('name') is-invalid @enderror" >
                            </div>


                            <div class="divider">
                                <div class="divider-text">Permissions</div>
                            </div>


  

                                            @foreach ($rolePermissions as $roleChunk)
                                                <div class="row m-0">
                                                    @foreach ($roleChunk as $role)
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="checkbox" checked>
                                                                <label class="col-form-label">{{ $role->name }}</label>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            @endforeach
                                       
                                       
            

                        <div class="ps__rail-x" style="left: 0px; bottom: -291px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 291px; height: 500px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 119px; height: 500px;"></div></div></div>
                    </div>
                </div>
               
            </div>

        </div>
    </div>


</div>


    


@endsection



@push('extra-js')


@endpush


@push('extra-modal')


@endpush
