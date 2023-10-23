

@push('extra-button')

<div class="
                col-lg-4 col-md-6
                d-none d-md-flex
                align-items-center
                justify-content-end
              ">
              
              <button type="button" class="btn btn-primary waves-effect waves-light m-3 mb-md-0" data-bs-toggle="modal" data-bs-target="#addForm">
                <span class="fas fa-user-plus me-1"></span>Ajouter un utilisateur
            </button>
            </div>


@endpush

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

            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-header">Liste des utilisateurs</h5>
                         
                            
                        </div>
                        
                    </div>

               

                   
                    <div class="card-body">

                        <div class="table-responsive"  >
            
                            <table id="users" class="table table-hover table-striped table-bordered  display  text-nowrap " >
                              <thead>
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
                              <tbody>
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

                                        <button onclick="editModal({{ $item->id }})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" >
                                            <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                                        </button>

                                        
                                        
                                        <!-- Bouton Delete -->
                                       

                                    
                                        @if ($item->email <> 'admin@admin.com' & $item->email != Auth::user()->email)
                                       
                                        <button onclick="deleteModal({{ $item->id }})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
                                            <i class="fas fa-trash-alt fa-lg text-danger"></i>
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



</div>


@endsection


<!-------------------Extra Js--------------------------------------->
@push('extra-js')


<script>
// suppression
          function deleteModal(id) {
            Swal.fire({
        title: "Voulez-vous supprimer l'élément ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui",
        confirmButtonColor: "blue",
        cancelButtonText: "Non !",
        cancelButtonColor: "red !",
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



<script src="{{ asset('assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="{{ asset('assets/dist/js/buttons/dataTables.buttons.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.flash.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/jszip/3.1.3/jszip.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/pdfmake/0.1.32/pdfmake.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/pdfmake/0.1.32/vfs_fonts-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.html5.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.print.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>


 <!-- This Page JS -->
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/dist/js/pages/forms/select2/select2.init.js') }}"></script>




<!----------------------Modal------------------------------------------>


@include('users.create')

@include('users.edit')




@endpush



