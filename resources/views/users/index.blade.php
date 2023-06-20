@extends('layouts.app')

@section('content')


<div class="container-xxl flex-grow-1 container-p-y">

<div class="row">
    <div class="col">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres Systeme /</span> Utilisateurs</h4>
    </div>

    <div class="col text-end">
        <div class="dt-buttons btn-group flex-wrap">
            <button type="button" class="btn btn-primary waves-effect waves-light m-3 mb-md-0" data-bs-toggle="modal" data-bs-target="#addForm">
                <span class="fas fa-user-plus me-1"></span>Ajouter un utilisateur
            </button>
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
                            <h5 class="card-header">Liste des utilisateurs</h5>
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
                                <th>Email</th>
                                <th>Poste</th>
                                <th>Droit</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody >

                                @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->poste }}</td>
                                    <td>{{ $item->droit }}</td>
                                    <td class="text-center">
                                        @if ($item->type_connexion=='WINDOWS')
                                        <i class="fab fa-windows text-danger"></i>
                                        @else
                                        <i class="fas fa-database text-primary"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->est_actif == 1)
                                        <span class="badge rounded-pill bg-success bg-glow">Actif</span>
                                        
                                        @else
                                        <span class="badge rounded-pill bg-danger bg-glow">Inactif</span>
                                        @endif
                                       
                                    
                                    </td>

                                    <td>

                                        <button onclick="editModal({{ $item->id }})" type="button" class="btn-sm btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                                            <span class="ti ti-pencil"></span>
                                        </button>

                                    
                                        @if ($item->email <> 'admin@admin.com' & $item->email != Auth::user()->email)
                                       
                                        <button onclick="deleteModal({{ $item->id }})"  type="button" class="btn-sm btn rounded-pill btn-icon btn-danger waves-effect waves-light">
                                            <span class="ti ti-trash"></span>
                                        </button>
                                        @endif

        
                                       
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


<!-------------------Extra Js--------------------------------------->
@push('extra-js')


<script>


    //datatable
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
        dom: `<'row'<'col-sm-2 text-left mb-3'B><'col-sm-10 text-right'f>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 mt-3 col-md-5'i><'col-sm-12 mt-3 col-md-7 dataTables_pager'lp>>`,

        buttons: [
            'copyHtml5',
            'excelHtml5',
        ],
    });  


    // suppression
    function deleteModal(id) {
        Swal.fire({
                title: "Voulez-vous supprimer l'élément ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Oui ",
                cancelButtonText: "Non !",
            }).then(function(result) {
                if (result.value) {
                    window.location.href="{{url('users/delete')}}"+"/"+id;
                    Swal.fire(
                        "Suppression !",
                        "En cours de traitement ...",
                        "success"
                    )
                }
            });
    }


    // edition
    function editModal(id){
            var e_id = id;
            $.ajax({
                type: "GET",
                url: "{{url('/users/edit')}}" + '/' + e_id,
                success: function (data) {

                
                    $('#u_id').val(data.id);
                    $('#u_name').val(data.name);
                    $('#u_email').val(data.email);
                    $('#u_poste').val(data.poste);
                    $('#u_type_connexion').val(data.type_connexion).change();
                    $('#u_est_actif').val(data.est_actif).change();
                    $('#u_droit').val(data.droit).change();
            
                    
                
                    $('#editForm').modal('show');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
    }
 


</script>

@include('layouts.partials.alert_js')
<!----------------------Modal------------------------------------------>


@include('users.create')

@include('users.edit')




@endpush



