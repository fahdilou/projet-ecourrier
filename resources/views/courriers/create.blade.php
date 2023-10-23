@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />


<!-- Icons -->
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />



<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}" />
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>



<!-- Inclure le fichier CSS d'Awesomplete -->
<link rel="stylesheet" href="{{ asset('assets/css/awesomplete.css') }}" />

<!-- Inclure la bibliothèque JavaScript d'Awesomplete -->
<script src="{{ asset('assets/js/awesomplete2.js') }}"></script>
 

<style>
    /* Custom CSS to change the background color of the input field when there's an error */
    .input-error {
        background-color: #ffe6e6; 
    }
</style>

<style>

    /* Style pour l'Awesomplete */
    .awesomplete {
        display: block;
        position: relative;
    }
    /* Style pour le conteneur de l'Awesomplete (peut-être redondant, selon vos besoins) */
    .awesomplete > ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    /* Style pour l'input avec Awesomplete */
    .awesomplete-input {
        width: calc(100% - 24px); /* Ajustez la largeur totale du conteneur parent avec une marge de 12px de chaque côté */
        border: 1px solid #ccc;
        padding: 6px 12px; /* Ajustez la marge intérieure selon vos besoins */
        border-radius: 4px; /* Ajustez la bordure arrondie selon vos besoins */
        margin-right: 12px; /* Espacement entre l'input et le label */
        vertical-align: top; /* Aligner l'input au sommet */
    }
    
    /* Style pour le label */
    .control-label {
        margin-bottom: 6px; /* Ajustez l'espacement entre le label et l'input */
        vertical-align: top; /* Aligner le label au sommet */
    }
    
    /* Style lorsque l'input a le focus */
    .awesomplete-input:focus {
        border-color: #1e4db7;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    /* Style pour les suggestions d'Awesomplete (liste déroulante) */
    .awesomplete > ul > li {
        padding: 6px 12px; /* Ajustez la marge intérieure selon vos besoins */
        cursor: pointer;
    }
    
    /* Style pour les suggestions d'Awesomplete au survol de la souris */
    .awesomplete > ul > li:hover {
        background-color: #f0f0f0; /* Ajustez la couleur d'arrière-plan au survol selon vos besoins */
    }
    
    /* Style pour le label */
    .control-label {
        margin-bottom: 6px; /* Ajustez l'espacement entre le label et l'input */
    }
    
    </style>
    


<div class="container-xxl flex-grow-1 container-p-y">

  
    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="card">
                <form action="{{ route('courriers.store') }}" method="POST" autocomplete="off">
                    @csrf
                <div class="card-header">  Nouveau courrier</div>
                <div class="card-body">
                    
                    <div class="row pt-3">
                        <div class="col-md-6">
                         <div class="mb-3 @error('date_arriver') has-danger @enderror">
                            <label class="control-label">Date d'arrivée<span class="text-danger">*</span></label>
                            <input required
                            type="date"
                            name="date_arriver"
                            value="{{ old('date_arriver') }}"
                            id="date_arriver"
                            class="form-control input-uppercase @error('date_arriver') input-error @enderror"
                            style="border-color: #ccc;"
                            onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                            oninput="removeErrorStyles()"
                            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"/>
                            @error('date_arriver')
                            <small class="form-control-feedback"> {{ $message }}  </small>
                            @enderror
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3 @error('expediteur') has-danger @enderror">
                              <label class="control-label">Expéditeur<span class="text-danger">*</span></label>
                              <input required
                              type="text"
                              name="expediteur"
                              value="{{ old('expediteur') }}"
                              id="expediteur"
                              class="form-control input-uppercase @error('expediteur') input-error @enderror"
                              style="border-color: #ccc;"
                              onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                              oninput="removeErrorStyles()"
                              onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"/>
                              @error('expediteur')
                              <small class="form-control-feedback"> {{ $message }}  </small>
                              @enderror
                            </div>
                          </div>
                        <!--/span-->
                    </div>
                     
                        <!--/span-->


                    
                    
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="mb-3 @error('affectation') has-danger @enderror">
                                <label class="control-label">Affectation</label>
                                <input
                                        type="text"
                                        name="affectation"
                                        value="{{ old('affectation') }}"
                                        id="affectation"
                                        class="form-control input-uppercase @error('affectation') input-error @enderror"
                                        style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                    />
                                    @error('affectation')
                                        <small class="form-control-feedback"> {{ $message }}  </small>
                                    @enderror
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="mb-3 @error('observation') has-danger @enderror">
                                  <label class="control-label">Observation</label>
                                  <input
                                        type="text"
                                        name="observation"
                                        value="{{ old('observation') }}"
                                        id="observation"
                                        class="form-control input-uppercase @error('observation') input-error @enderror"
                                        style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                    />
                                    @error('observation')
                                  <small class="form-control-feedback"> {{ $message }}  </small>
                                  @enderror
                                </div>
                              </div>
                            <!--/span-->
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 @error('motif') has-danger @enderror">
                                <label style="font-size: 1rem; ">Motifs du courrier<span class="text-danger">*</span></label>
                                <textarea required
                                type="text"
                                name="motif"
                                value="{{ old('motif') }}"
                                id="motif"
                                class="form-control input-uppercase @error('motif') input-error @enderror"
                                style="border-color: #ccc;"
                                onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                oninput="removeErrorStyles()"
                                onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';" rows="3" style="height: 82px;"></textarea>
                                @error('motif')
                                <small class="form-control-feedback"> {{ $message }}  </small>
                                @enderror
                              </div>
                            </div>
                          </div>

                         
                     
                      <input type="hidden" name="who_create" id="who_create" class="form-control" value="{{ auth()->user()->name }}" required>
               
                    <!-- Champ caché pour la date de début de traitement -->
                    <input type="hidden" name="date_debut_traitement" id="date_debut_traitement">
                    <!-- Champ caché pour la date de fin de traitement -->
                    <input type="hidden" name="date_fin_traitement" id="date_fin_traitement">
                      
                  
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger rounded-pill px-4 me-2" data-bs-dismiss="modal">
                          Annuler
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                          Valider
                        </button>
                      </div>
                     

                </div>
              </form> 
              </div>
            


<style>
#courrier_jour td {
    white-space: normal; /* ou "break-word" si vous préférez */
}
  </style>


                <div class="card">
                  
                  <div class="card-header">  Courriers de la journée</div>
                  <div class="card-body">

                    <div class="table-responsive"  >
            
                      <table id="courrier_jour" style="width: 100%;" class="table table-hover table-striped table-bordered  display  text-nowrap " >
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>date d'arriver</th>
                            <th>Expediteur</th>
                            <th>Motif</th>
                            
                            <th>Affectation</th>
                            <th>Statut</th>
                            <th>Observation</th>
                            
                           
                           
                           
                           
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


</div>
    


@endsection



@push('extra-js')



<script>
    $(document).ready(function() {
      
        var table = $('#courrier_jour').DataTable({
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
                url: "{{ route('courriers.create-table') }}", 
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
                        <span class="mb-1 badge bg-warning text-dark" >ENREGISTREMENT</span>
                        `;
                    }
                },
                { data: 'observation', name: 'observation' },
                
    
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                      
                        <button onclick="editModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                <i class="fas fa-edit fa-lg text-info"></i>
                              </button>
                      
                              @can('courrier_delete')
                              <button onclick="deleteModal(${full.id}, '{{ auth()->user()->name }}')" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                  <i class="fas fa-trash-alt fa-lg text-danger"></i>
                              </button>
                              @endcan
              
                        `;
                    }
                },
            ]
        });
    
    
        
    });
    
    
    
    </script>
    
  


<script>

 
  function removeErrorStyles() {
      const inputElement = document.getElementById('u_affectation');
      inputElement.classList.remove('input-error');
  }

  function editModal(id) {
  var courrierId = id;

  const affectationRequired = document.getElementById('affectation-required');
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
<script src="{{ asset('assets/dist/js/buttons/dataTables.buttons.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/jszip/3.1.3/jszip.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.html5.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>

<!-- This Page JS -->
<script src="{{ asset('assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/dist/js/pages/forms/select2/select2.init.js') }}"></script>


<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>




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
                              <label class="control-label text-end col-md-3">Date d'arrivée<span class="text-danger">*</span></label>
                              <div class="col-md-9">
                                  <input required
                                      type="date"
                                      name="date_arriver"
                                      value="{{ old('date_arriver') }}"
                                      id="u_date_arriver"
                                      class="form-control input-uppercase @error('date_arriver') input-error @enderror"
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
                              <label class="control-label text-end col-md-3">Expéditeur<span class="text-danger">*</span></label>
                              <div class="col-md-9">
                                  <input required
                                      type="text"
                                      name="expediteur"
                                      value="{{ old('expediteur') }}"
                                      id="u_expediteur"
                                      class="form-control input-uppercase @error('expediteur') input-error @enderror"
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
                          <label class="control-label text-end col-md-3">Motifs du courrier<span class="text-danger">*</span></label>
                          <div class="col-md-9">
                              <input required
                                  type="text"
                                  name="motif"
                                  value="{{ old('motif') }}"
                                  id="u_motif"
                                  class="form-control input-uppercase @error('motif') input-error @enderror"
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
                          <label class="control-label text-end col-md-3">Affectation<span class="text-danger" id="affectation-required" style="display: none">*</span></label>
                          <div class="col-md-9">
                              <input
                                  type="text"
                                  name="affectation"
                                  value="{{ old('affectation') }}"
                                  id="u_affectation"
                                  class="form-control input-uppercase @error('affectation') input-error @enderror"
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
                                  class="form-control input-uppercase @error('observation') input-error @enderror"
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
                          <label class="control-label text-end col-md-3">Statut<span class="text-danger">*</span></label>
                          <div class="col-md-9">
                              <select name="statut" id="u_statut" class="form-control form-select">
                                  <option value="ENREGISTREMENT" selected>ENREGISTREMENT</option>
                                  <option value="EN COURS DE TRAITEMENT" disabled>EN COURS DE TRAITEMENT</option>
                                  <option  value="TRAITE" disabled>TRAITE</option>
                              </select>
                              @error('statut')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  
                  <input type="hidden" name="who_update" id="who_update" class="form-control input-uppercase" value="{{ auth()->user()->name }}" required>

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
</script>

 

<script>
    // JavaScript function to remove error styles when the user starts typing
    function removeErrorStyles() {
        const inputElement = document.getElementById('expediteur');
        inputElement.classList.remove('input-error');
    }



</script>

<?php

// Formater en tableau associatif
$formattedAffectations = [];
foreach ($affectations as $affectation) {
    $formattedAffectations[$affectation] = new stdClass();
}

// Encodage en JSON
$affectationsJson = json_encode($formattedAffectations);
?>

  <script>
   
var affectations = <?php echo $affectationsJson; ?>;
console.log(affectations);
var input = document.getElementById("affectation");
var myAwesomeComplete = new Awesomplete(input, { list: Object.keys(affectations) });

  </script>

@endpush


@push('extra-modal')


@endpush
