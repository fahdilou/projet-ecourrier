@extends('layouts.app')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres Systeme /</span> Rôles & Permissions </h4>
        </div>
    
        <div class="col text-end">
            <div class="dt-buttons btn-group flex-wrap">
                <a href="{{ route('roles.create') }}" type="button" class="btn btn-primary waves-effect waves-light m-3 mb-md-0" >
                    <span class="fas fa-user-shield me-1"></span>Ajouter un rôle
                </a>
            </div>
        </div>
    
    </div>
    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-header">Liste des rôles utilisateur</h5>
                        </div>
                        {{-- <div class="col text-end">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button type="button" class="btn btn-primary waves-effect waves-light m-3 mb-md-0" data-bs-toggle="modal" data-bs-target="#addForm">
                                    <span class="fas fa-user-plus me-1"></span>Ajouter un utilisateur
                                </button>
                            </div>
                        </div> --}}
                    </div>


                    <div class="card-body">


                    
                        <table style="width: 100%;" class="table table-hover table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach ($roles as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                   

                                    <td>

                                        <a href="{{ route('roles.show',$item->id) }}" type="button" class="btn-sm btn rounded-pill btn-icon btn-secondary waves-effect waves-light">
                                            <span class="ti ti-eye"></span>
                                        </a>

                                        <a  href="{{ route('roles.edit',$item->id) }}" type="button" class="btn-sm btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                                            <span class="ti ti-pencil"></span>
                                        </a>

                                        <button onclick="deleteModal({{ $item->id }})"  type="button" class="btn-sm btn rounded-pill btn-icon btn-danger waves-effect waves-light">
                                            <span class="ti ti-trash"></span>
                                        </button>

                                        
                                       
                                    </td>
                                </tr>
                                @endforeach

            
                            </tbody>
                         
                        </table>
                        

                    </div>
                  
                </div>
            </div>

        </div>
    </div>


</div>
    


@endsection



@push('extra-js')
<script>

$(".table").DataTable({
    order: [[0, 'asc']],
    "scrollX": true,
    "lengthChange": false,
    "language": {
        "lengthMenu": "Show _MENU_",
    },
    "oLanguage": {
        "sUrl": "assets/plugins/datatable/french.json"
    },
    dom: `<'row'<'col-sm-2 text-left'B><'col-sm-10 text-right'f>>
          <'row'<'col-sm-12'tr>>
          <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

    buttons: [
        'copyHtml5',
        'excelHtml5',
    ],
});


function deleteModal(id) {
            Swal.fire({
                title: "Voulez-vous supprimer l'élément ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Oui ",
                cancelButtonText: "Non !",
            }).then(function (result) {
                if (result.value) {
                    window.location.href = "{{ url('monrole/delete') }}" + "/" + id;
                    Swal.fire(
                        "Suppression !",
                        "En cours de traitement ...",
                        "success"
                    )
                }
            });
        }



</script>

@endpush


@push('extra-modal')


@endpush
