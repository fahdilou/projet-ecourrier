@extends('layouts.app')

@section('content')

<!-- Icons -->
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />
<script src="{{ asset('assets/js/moment.js') }}"></script>

<style>
    /* Custom CSS to change the background color of the input field when there's an error */
    .input-error {
        background-color: #ffe6e6; 
    }
</style>




<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}" />
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />



<div class="container-xxl flex-grow-1 container-p-y">

   

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="card">
               
                <div class="card-header">  Courriers traités</div>
                <div class="card-body">
                    
              <div class="table-responsive"  >

                <!-- filtrage  -->
                <div class="mb-3 row">
                    <label class="control-label text-end col-md-2">Date début</label>
                    <div class="col-md-2">
                        <input type="date" id="start_date" class="form-control" value="{{ $start_date ?? '' }}">

                    </div>
                    <label class="control-label text-end col-md-2">Date fin</label>
                    <div class="col-md-2">
                        <input type="date" id="end_date" class="form-control" value="{{ $end_date ?? '' }}">
                    </div>
                    <label class="control-label text-end col-md-2">Affectations</label>
                    <div class="col-md-2">
                        <select id="affectation_filter" class="form-control">
                            <option value="">Tous</option>
                            @foreach($affectations as $affectation)
                                <option value="{{ $affectation }}" @if ($affectation_filter == $affectation) selected @endif>{{ $affectation }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    
                </div>
                <div class="d-flex justify-content-center my-2">
                    <button class="btn btn-primary mx-3" onclick="applyFilter()">Filtrer</button>
                    <button class="btn btn-secondary" onclick="resetDataTable()">Réinitialiser</button>
                </div>
                
                
                <style>
                    /* CSS */
                    #table-container {
                    width: 1700px;
                    overflow-x: auto;
                    }


                </style>

<style>
    /* CSS */
    #table-container {
    width: 1700px;
    overflow-x: auto;
    }


    /* Appliquez la position sticky à la dernière colonne */
    table.dataTable tbody td:last-child {
        position: sticky;
        right: 0;
        z-index: 1;
        background-color: #f9f9f9;
    }


</style>
            
                <table id="courrier_traite" style="width: 100%;" class="table table-hover table-striped table-bordered  display  text-nowrap " >
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>date d'arriver</th>
                      <th>Expediteur</th>
                      <th>Motif</th>
                      
                      <th>Affectation</th>
                      <th>Statut</th>
                      <th>Observation</th>
                      <th>Date debut traitement</th>
                      <th>Date fin traitement</th>
                     
                     
                                
                      <th style="position: sticky; right: 0; z-index: 1; background-color: #f9f9f9;">Options</th>
                    </tr>
                  </thead>
                  <tbody>
                 
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
    $(document).ready(function() {
        // Initialize DataTable  


        var table_traite = $('#courrier_traite').DataTable({
            serverSide: true,
            deferRender: true,
            dom: 'Bfrtip',
            scrollY: '300px',
            scrollX: true,
            buttons: ['copy', 'excel'],
            language: frenchTranslation,
            order: [],
            scrollCollapse: true,
            ajax: {
                url: "{{ route('courriers.traite-table') }}", // L'URL de votre route Laravel
                type: 'GET',
            },
            processing: true,
            columns: [
                // Configurez ici les colonnes de votre DataTable
                { data: 'id', name: 'id' },
                { data: 'date_arriver', name: 'date_arriver',
                    render: DataTable.render.date('DD/MM/YYYY')
                },
                { data: 'expediteur', name: 'expediteur' },
                { data: 'motif', name: 'motif' },
                { data: 'affectation', name: 'affectation' },
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                        <span class="mb-1 badge bg-primary" >TRAITE</span>
                        `;
                    }
                },
                { data: 'observation', name: 'observation' },
                { data: 'date_debut_traitement', name: 'date_debut_traitement' },
                { data: 'date_fin_traitement', name: 'date_fin_traitement' },
                
    
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                      
                        <div class="d-flex align-items-center">
                 
                 @can('courrier_edition')
                     <button type="button" onclick="editModal(${full.id})" class="btn btn-rounded btn-primary d-flex align-items-center" style="max-width: 120px;" >
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                       Traiter
                     </button>
                 @endcan
           
                   @can('courrier_delete')
                   <button onclick="deleteModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                       <i class="fas fa-trash-alt fa-lg text-danger"></i>
                   </button>
                  @endcan
                  
               </div>
              
                        `;
                    }
                },
            ]
        });
    
        
    });
    
    
    
    </script>
    


<script>
     function applyFilter() {
    // Récupérez les valeurs des champs de filtrage
    var startDate = document.getElementById('start_date').value;
    var endDate = document.getElementById('end_date').value;
    var affectationFilter = document.getElementById('affectation_filter').value;
   
    // Effectuez une requête Ajax pour récupérer les données filtrées
    $.ajax({
        type: 'GET',
        url: "{{ route('courriers.traite-table-filter') }}", 
        data: {
            start_date: startDate,
            end_date: endDate,
            affectation_filter: affectationFilter
        },
        dataType: 'json',
        success: function(data) {
            // Mettez à jour le DataTable avec les nouvelles données
            var table = $('#courrier_traite').DataTable();
            table.clear().destroy(); // Supprimer et détruire le DataTable existant
           
            
            var tables = $('#courrier_traite').DataTable({
           
            dom: 'Bfrtip',
            scrollY: '300px',
            scrollX: true,
            buttons: ['copy', 'excel'],
            language: frenchTranslation,
            order: [],
            scrollCollapse: true,
            processing: true,
            data: data,
            columns: [
               
                { data: 'id', name: 'id' },
                { data: 'date_arriver', name: 'date_arriver',
                    render: DataTable.render.date('DD/MM/YYYY')
                },
                { data: 'expediteur', name: 'expediteur' },
                { data: 'motif', name: 'motif' },
                { data: 'affectation', name: 'affectation' },
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                        <span class="mb-1 badge bg-primary" >TRAITE</span>
                        `;
                    }
                },
                { data: 'observation', name: 'observation' },
                { data: 'date_debut_traitement', name: 'date_debut_traitement' },
                { data: 'date_fin_traitement', name: 'date_fin_traitement' },
                
    
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                      
                        <div class="d-flex align-items-center">
                 
                 @can('facture_edit')
                     <button type="button" onclick="editModal(${full.id})" class="btn btn-rounded btn-primary d-flex align-items-center" style="max-width: 120px;" >
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                       Traiter
                     </button>
                 @endcan
           
                   @can('facture_delete')
                   <button onclick="deleteModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                       <i class="fas fa-trash-alt fa-lg text-danger"></i>
                   </button>
                  @endcan
                  
               </div>
              
                        `;
                    }
                },
            ]
        });
        tables.draw();
           
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}







function resetDataTable() {
     
    document.getElementById("start_date").value = "";
    document.getElementById("end_date").value = "";
    document.getElementById("affectation_filter").value = "";
        var table = $('#courrier_traite').DataTable();
        table.clear().destroy(); // Supprimer et détruire le DataTable existant

        var tables = $('#courrier_traite').DataTable({
            serverSide: true,
            deferRender: true,
            dom: 'Bfrtip',
            scrollY: '300px',
            scrollX: true,
            buttons: ['copy', 'excel'],
            language: frenchTranslation,
            order: [],
            scrollCollapse: true,
            ajax: {
                url: "{{ route('courriers.traite-table') }}", 
                type: 'GET',
            },
            processing: true,
            columns: [
               
                { data: 'id', name: 'id' },
                { data: 'date_arriver', name: 'date_arriver',
                    render: DataTable.render.date('DD/MM/YYYY')
                },
                { data: 'expediteur', name: 'expediteur' },
                { data: 'motif', name: 'motif' },
                { data: 'affectation', name: 'affectation' },
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                        <span class="mb-1 badge bg-primary" >TRAITE</span>
                        `;
                    }
                },
                { data: 'observation', name: 'observation' },
                { data: 'date_debut_traitement', name: 'date_debut_traitement' },
                { data: 'date_fin_traitement', name: 'date_fin_traitement' },
                
    
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                      
                        <div class="d-flex align-items-center">
                 
                 @can('courrier_traitement')
                     <button type="button" onclick="editModal(${full.id})" class="btn btn-rounded btn-primary d-flex align-items-center" style="max-width: 120px;" >
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                       Traiter
                     </button>
                 @endcan
           
                   @can('courrier_delete')
                   <button onclick="deleteModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                       <i class="fas fa-trash-alt fa-lg text-danger"></i>
                   </button>
                  @endcan
                  
               </div>
              
                        `;
                    }
                },
            ]
        });
    
        tables.draw();

      
    }


</script>



<script>




function editModal(id) {
        var courrierId = id;
        $.ajax({
            type: "GET",
            url: "{{ url('/courrier/edit') }}" + '/' + courrierId,
            success: function (data) {
                $('#edit_courrier_id').val(data.id);
                $('#u_date_arriver').val(data.date_arriver);
                $('#u_expediteur').val(data.expediteur);
                $('#u_motif').val(data.motif);
                $('#u_affectation').val(data.affectation);
                $('#u_date_debut_traitement').val(data.date_debut_traitement);
                $('#u_date_fin_traitement').val(data.date_fin_traitement);
                $('#u_observation').val(data.observation);
                $('#u_statut').val(data.statut);

                

                $('#editForm').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function deleteModal(id) {
            Swal.fire({
                title: "Voulez-vous supprimer l'élément ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Oui ",
                cancelButtonText: "Non !",
            }).then(function (result) {
                if (result.value) {
                    window.location.href = "{{ url('courriers/delete') }}" + "/" + id;
                    Swal.fire(
                        "Suppression !",
                        "En cours de traitement ...",
                        "success"
                    )
                }
            });
        }


</script>






<script src="{{ asset('assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="{{ asset('assets/dist/js/buttons/dataTables.buttons.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.flash.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/jszip/3.1.3/jszip.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.html5.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.print.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>


 <!-- This Page JS -->
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/dist/js/pages/forms/select2/select2.init.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatable/french.json') }}"></script>







 <!-- Modal Edit Courrier -->
 <div class="modal fade" id="editForm" tabindex="-1" aria-hidden="true">
    <form action="{{ route('courrier.update') }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Modification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_courrier_id">
                   
            

                 <div class="row">
                
                            <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="control-label text-end col-md-3">Date d'arrivée</label>
                                <div class="col-md-9">
                                    <input required
                                        type="date"
                                        name="date_arriver"
                                        value="{{ old('date_arriver') }}"
                                        id="u_date_arriver"
                                        class="form-control @error('date_arriver') input-error @enderror"
                                        style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                    />
                                    @error('date_arriver')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

              

                   <!--/span-->
             
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="control-label text-end col-md-3">Expéditeur</label>
                                <div class="col-md-9">
                                    <input required
                                        type="text"
                                        name="expediteur"
                                        value="{{ old('expediteur') }}"
                                        id="u_expediteur"
                                        class="form-control @error('expediteur') input-error @enderror"
                                        style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                    />
                                    @error('expediteur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
              
             
                    <!--/span-->
             </div>


             <div class="row">


                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="control-label text-end col-md-3">Motifs du courrier</label>
                            <div class="col-md-9">
                                <input required
                                    type="text"
                                    name="motif"
                                    value="{{ old('motif') }}"
                                    id="u_motif"
                                    class="form-control @error('motif') input-error @enderror"
                                    style="border-color: #ccc;"
                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                    oninput="removeErrorStyles()"
                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                />
                                @error('motif')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!--/span-->
                   
                      <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="control-label text-end col-md-3">Affectation</label>
                            <div class="col-md-9">
                                <input
                                    type="text"
                                    name="affectation"
                                    value="{{ old('affectation') }}"
                                    id="u_affectation"
                                    class="form-control @error('affectation') input-error @enderror"
                                    style="border-color: #ccc;"
                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                    oninput="removeErrorStyles()"
                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                />
                                @error('motif')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                  </div>


                  <div class="row">
                    
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="control-label text-end col-md-3">Observation</label>
                            <div class="col-md-9">
                                <input
                                    type="text"
                                    name="observation"
                                    value="{{ old('observation') }}"
                                    id="u_observation"
                                    class="form-control @error('observation') input-error @enderror"
                                    style="border-color: #ccc;"
                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                    oninput="removeErrorStyles()"
                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                />
                                @error('observation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    

                      <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="control-label text-end col-md-3">Statut</label>
                            <div class="col-md-9">
                                <select name="statut" id="u_statut" class="form-control form-select">
                                  
                                    <option value="ENREGISTREMENT" {{ request('statut') === 'ENREGISTREMENT' ? 'selected' : '' }}>ENREGISTREMENT</option>
                                    <option value="EN COURS DE TRAITEMENT" {{ request('statut') === 'EN COURS DE TRAITEMENT' ? 'selected' : '' }}>EN COURS DE TRAITEMENT</option>
                                    <option  value="TRAITE" {{ request('statut') === 'TRAITE' ? 'selected' : '' }}>TRAITE</option>
                                </select>
                                @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="who_update" id="who_update" class="form-control" value="{{ auth()->user()->name }}" required>

                     <!-- Champ caché pour la date de début de traitement -->
                <input type="hidden" name="date_debut_traitement" id="u_date_debut_traitement">
                <!-- Champ caché pour la date de fin de traitement -->
                <input type="hidden" name="date_fin_traitement" id="u_date_fin_traitement">
                  

                    <!--/span-->
                  </div>
               


            
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>



<script>



        // Récupérer tous les éléments input avec la classe "input-uppercase"
        const inputFields = document.querySelectorAll('.input-uppercase');

        // Parcourir tous les champs d'entrée et ajouter l'écouteur d'événement pour détecter les changements
        inputFields.forEach(input => {
            input.addEventListener('input', function() {
                // Mettre en majuscules le texte saisi
                this.value = this.value.toUpperCase();
            });
        });




  // Écouteur d'événement pour détecter le changement du statut
  document.getElementById('u_statut').addEventListener('change', function() {
      const statut = this.value;
      const dateDebutTraitementInput = document.getElementById('u_date_debut_traitement');
      const dateFinTraitementInput = document.getElementById('u_date_fin_traitement');
      const affectationInput = document.getElementById('u_affectation');

      // Mettre à jour les valeurs des champs cachés en fonction du statut sélectionné
      if (statut === 'EN COURS DE TRAITEMENT') {
          const currentDate = new Date().toISOString().slice(0, 10);
          dateDebutTraitementInput.value = currentDate;
          dateFinTraitementInput.value = ''; 
          affectationInput.required = true; // Affectation est requise lorsque le statut est "EN COURS DE TRAITEMENT"
      } else if (statut === 'TRAITE') {
          const currentDate = new Date().toISOString().slice(0, 10);
          dateFinTraitementInput.value = currentDate;
          if (dateDebutTraitementInput.value === '') {
              dateDebutTraitementInput.value = currentDate; // Remplir la date de début de traitement avec la date du jour s'il est vide
          }
          affectationInput.required = true; // Affectation est requise lorsque le statut est "TRAITE"
      } else {
          dateDebutTraitementInput.value = '';
          dateFinTraitementInput.value = '';
          affectationInput.required = false; // Affectation n'est pas requise pour les autres statuts
      }
  });
</script>





@endpush


@push('extra-modal')


@endpush
