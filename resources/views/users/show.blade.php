@extends('layouts.app')

@section('content')

<!--begin::BREADCRUMB-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Paramètres / Rôles & Permissions</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Administrer les rôles et permissions</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::BREADCRUMB-->


<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
    <div class="container">


        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        Rôle -- {{ $role->name }}
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a type="button" href="{{ route('roles.index') }}"
                        class="btn btn-secondary btn-sm">Retour à la liste</a>
                </div>
            </div>






            <div class="card-body">

                <div class="form-group">
                    <label>Nom <span class="text-danger">*</span></label>
                    <input type="text" name="name" readonly class="form-control @error('name') is-invalid @enderror"
                        value="{{ $role->name }}" required />
                </div>


                <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                                Permissions
                            </div>
                        </div>
                        <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                            <div class="card-body">

                                @foreach($rolePermissions as $value)
                                    <div class="form-group row m-0">
                                        <input type="checkbox" checked />
                                        <label class="col-md-6 col-form-label">{{ $value->name }}</label>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>




            </div>



        </div>


    </div>
</div>
<!--end::Entry-->

@endsection


@push('extra-js')


@endpush