@extends('layouts.app')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">


<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Utilisateur /</span>Mon Profil</h4>




<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
    <div class="container-fluid">



        <div class="card mx-5">
            <div class="card-body">

                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                    class="rounded-circle mt-5" width="150px"
                                    src="{{ asset('assets/img/avatars/blank.png') }}"><span
                                    class="font-weight-bold">{{ auth()->user()->name }}</span><span
                                    class="text-black-50">{{ auth()->user()->email }}</span><span> </span></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Informations</h4>
                                </div>

                                <form action="{{ route('myprofil.update') }}" method="post">
                                    @csrf
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3"><label class="labels">Nom & Prénom</label><input
                                                type="text" class="form-control" required disabled="disabled"
                                                name="name" value="{{ auth()->user()->name }}"></div>
                                        <div class="col-md-12 mb-3"><label class="labels">Adresse Email</label><input
                                                type="text" class="form-control" disabled="disabled"
                                                value="{{ auth()->user()->email }}"></div>
                                        <div class="col-md-12"><label class="labels">Poste</label><input type="text"
                                                class="form-control" name="poste" required
                                                value="{{ auth()->user()->poste }}"></div>

                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

                                    </div>

                                    <div class="row mt-5">
                                        <div class="col text-left">
                                            <button class="btn btn-primary" type="submit">Sauvegarder</button>
                                        </div>
                                </form>

                                @if (Auth::user()->type_connexion=='SQL')
                                <div class="col text-right">
                                    <button class="btn btn-danger"  type="button" data-bs-toggle="modal" data-bs-target="#addForm">Changer de mot de passe</button>
                                </div>
                                @endif



                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                            <h4 class="text-left">Rȏle Utilisateur</h4>

                            <div class="col-md-12"><label class="labels">Profil</label><input type="text"
                                    class="form-control" disabled="disabled"
                                    value="{{ Auth::user()->getRoleNames() }} "></div> <br>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




 

</div>
</div>
<!--end::Entry-->

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




