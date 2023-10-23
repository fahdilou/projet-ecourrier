@extends('layouts.app')

@section('content')

<!-- Icons -->
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />


<style>
    /* Custom CSS to change the background color of the input field when there's an error */
    .input-error {
        background-color: #ffe6e6; /* Replace this with the desired red color */
    }
</style>

<style>

/* Styles personnalisés pour le label */
label {
  font-weight: bold; /* Mettre en gras */
  font-size: 15px; /* Augmenter la taille du texte */
}



</style>



<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}" />
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<!-- Inclure le fichier CSS d'Awesomplete -->
<link rel="stylesheet" href="{{ asset('assets/css/awesomplete.css') }}" />

<!-- Inclure la bibliothèque JavaScript d'Awesomplete -->
<script src="{{ asset('assets/js/awesomplete.js') }}"></script>

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

<div class="ontainer-fluid note-has-grid">


    <ul class="nav nav-pills p-3 bg-white border mb-3 align-items-center">

        @can('onglet_facture_suivi_enregistrer')
      <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2 active " id="enregistrement" >
            <i class="fa-solid fa-star" style="margin-right: 5px;"></i><span class="d-none d-md-block font-weight-medium">Enregistrés</span></a>
        </li>
        @endcan
      

        @can('onglet_facture_suivi_encour')
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2 " id="en-cour">
            <i class="fa-solid fa-hourglass-end" style="margin-right: 5px;"></i><span class="d-none d-md-block font-weight-medium">En cours</span></a>
        </li>
        @endcan
       

        @can('onglet_courrier_suivi_traite')
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="traite">
            <i class="fa-solid fa-check-to-slot" style="margin-right: 5px;"></i><span class="d-none d-md-block font-weight-medium">Traités</span></a>
        </li>
        @endcan
       
        
       
      </ul>

   

    <!---------FIN BREADCRUMB------------------------------------------>

      <div id="facture_edition" data-can-edit="{{ auth()->user()->can('facture_edit') ? 'true' : 'false' }}" hidden></div>
      <div id="facture_suppression" data-can-delete="{{ auth()->user()->can('facture_delete') ? 'true' : 'false' }}" hidden></div>

    <div class="tab-content">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div id="note-full-container" class="note-has-grid row">

            <div class="col-md-12 single-note-item all-category enregistrement">
               
                <div class="card card-body" >
                    
              <div class="table-responsive"  >

              
                
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
            
                <table id="facture_enregistrement" style="width: 100%;" class="table table-hover table-striped table-bordered  display  text-nowrap " >
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Numéro facture</th>
                        <th>Fournisseur</th>
                        <th>statut</th>
                        <th>Date facture</th>
                        
                        <th>Date d'arrivée facture</th>
                        <th>Montant</th>
                        <th>Devise</th>
                        <th>Commentaire</th>
                        @foreach($workflows_debut as $workflow)
                        <th>Date Enregistrement </th> 
                        
                        @endforeach
                       
                        
                     
                     
                                
                      <th style="position: sticky; right: 0; z-index: 1; background-color: #f9f9f9;">Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  
                </table>
              </div>



              

                </div>
              </div>


              <div class="col-md-12 single-note-item all-category en-cour"  style="display: none" >
                <div class="card card-body">


                <div class="table-responsive"  >
                    
                <table id="facture_encour" style="width: 100%;" class="table table-hover table-striped table-bordered  display  text-nowrap " >
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Numéro facture</th>
                    <th>Fournisseur</th>
                    <th>statut</th>
                    <th>Etat</th>
                    <th>Date facture</th>
                    
                    <th>Date d'arrivée facture</th>
                    <th>Montant</th>
                    <th>Devise</th>
                    <th>Commentaire</th>
                    @foreach($workflows_debut as $workflow)
                    <th>Date Enregistrement </th> 
                    
                    @endforeach
                    @foreach($workflows_any as $workflow)
                    <th>Date Début {{ $workflow->libelle }}</th> 
                    <th>Date Fin {{ $workflow->libelle }}</th>  
                  @endforeach

                             
                   
                              
                  <th style="position: sticky; right: 0; z-index: 1; background-color: #f9f9f9;" >Options</th>
                </tr>
              </thead>
              <tbody>
              
              </tbody>
             
              
            </table>
          </div>
              
                </div>
              </div>





              <div class="col-md-12 single-note-item all-category traite" style="display: none"  >
                <div class="card card-body">


                <div class="table-responsive"  >
            
                <table id="facture_traite" style="width: 100%;" class="table table-hover table-striped table-bordered  display  text-nowrap " >
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Numéro facture</th>
                    <th>Fournisseur</th>
                    <th>statut</th>
                    <th>Date facture</th>
                    
                    <th>Date d'arrivée facture</th>
                    <th>Montant</th>
                    <th>Devise</th>
                    <th>Commentaire</th>
                    @foreach($workflows_debut as $workflow)
                    <th>Date Enregistrement </th> 
                    
                    @endforeach
                    @foreach($workflows_any as $workflow)
                    <th>Date Début {{ $workflow->libelle }}</th> 
                    <th>Date Fin {{ $workflow->libelle }}</th>  
                  @endforeach

                  @foreach($workflows_fin as $workflow)
              
                    <th>Date Banque </th>  
                  @endforeach
                 
                            
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
    var table = $('#facture_enregistrement').DataTable({
        serverSide: true,
        deferRender: true,
        dom: 'Bfrtip',
        scrollY: '400px',
        scrollX: true,
        buttons: ['copy', 'excel'],
        language: frenchTranslation,
        order: [],
        scrollCollapse: true,
        ajax: {
            url: "{{ route('factures.enregistrement-table') }}", 
            type: 'GET',
        },
        processing: true,
        columns: [
           
            { data: 'id', name: 'id' },
            { data: 'numero_facture', name: 'numero_facture' },
            { data: 'fournisseur', name: 'fournisseur' },
            {
                data: null,
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return `
                    <span class="mb-1 badge bg-warning text-dark" >DEBUT</span>
                    `;
                }
            },
            { data: 'date_facture', name: 'date_facture',
                render: DataTable.render.date('DD/MM/YYYY')
    },
    { data: 'date_arriver_facture', name: 'date_arriver_facture',
                render: DataTable.render.date('DD/MM/YYYY')
    },
    {
    data: 'montant',
    name: 'montant',
    render: function(data, type, row, meta) {
        // Si le type est "display", formatez la valeur
        if (type === 'display') {
            // Utilisez la fonction toLocaleString pour ajouter une virgule pour les milliers
            var formattedValue = parseFloat(data).toLocaleString('fr-FR', {
                minimumFractionDigits: 2, // Affiche toujours 2 décimales
                maximumFractionDigits: 2, // Affiche toujours 2 décimales
            });

            // Supprimez ".00" des nombres entiers
            formattedValue = formattedValue.replace(/\,00$/, '');

            return formattedValue;
        }
        return data;
    }
},

            { data: 'devise', name: 'devise' },
            { data: 'commentaire', name: 'commentaire' },
            { data: 'date_enregistrement', name: 'date_enregistrement' },
           
            {
                data: null,
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return `
                   
              <div class="d-flex align-items-center">
            
               
                 <a href="{{ route('factures.chronologie') }}?facture_id=${full.id}" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
                    <span class="fas fa-eye fa-lg text-info"></span>
                </a>

                 

              @can('facture_edit')
            <button onclick="editModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation">
                <i class="fas fa-pencil-alt fa-lg text-primary"></i>
            </button>
            @endcan

            @can('facture_delete')
          <button onclick="deleteModal(${full.id}, '{{ auth()->user()->name }}')" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation">
              <i class="fas fa-trash-alt fa-lg text-danger"></i>
          </button>
          @endcan

          

                 
          @can('facture_traitement')
            <button type="button" onclick="traiterModal(${full.id} , '{{ auth()->user()->name }}')" class="btn btn-rounded btn-primary d-flex align-items-center" style="max-width: 120px;" >
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
              Traiter
            </button>
          @endcan

              


                 
              </div>
          
                    `;
                }
            }
        ]
    });



    var table_encour =$('#facture_encour').DataTable({
        serverSide: true,
        deferRender: true,
        destroy: true,
        dom: 'Bfrtip',
        scrollY: '400px',
        scrollX: true,
        buttons: [ 'pageLength','copy', 'excel'],
        language: frenchTranslation,

      
        order: [],
        
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
        pagingType: "full_numbers",
      

        ajax: {
            url: "{{ route('factures.encours-table') }}", 
            type: 'GET',
            
        },
        processing: true,
        columns: [
          
            { data: 'id', name: 'id' },
            { data: 'numero_facture', name: 'numero_facture' },
            { data: 'fournisseur', name: 'fournisseur' },
            {
                data: null,
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return `
                    <span class="mb-1 badge bg-success text-dark" >EN COURS</span>
                    `;
                }
            },
            { data: 'etat', name: 'etat' },
            { data: 'date_facture', name: 'date_facture',
                render: DataTable.render.date('DD/MM/YYYY')
    },
    { data: 'date_arriver_facture', name: 'date_arriver_facture',
                render: DataTable.render.date('DD/MM/YYYY')
    },
    {
    data: 'montant',
    name: 'montant',
    render: function(data, type, row, meta) {
        // Si le type est "display", formatez la valeur
        if (type === 'display') {
            // Utilisez la fonction toLocaleString pour ajouter une virgule pour les milliers
            var formattedValue = parseFloat(data).toLocaleString('fr-FR', {
                minimumFractionDigits: 2, // Affiche toujours 2 décimales
                maximumFractionDigits: 2, // Affiche toujours 2 décimales
            });

            // Supprimez ".00" des nombres entiers
            formattedValue = formattedValue.replace(/\,00$/, '');

            return formattedValue;
        }
        return data;
    }
},

            { data: 'devise', name: 'devise' },
            { data: 'commentaire', name: 'commentaire' },
            { data: 'date_enregistrement', name: 'date_enregistrement' },
            { data: 'date_entrer_workflow1', name: 'date_entrer_workflow1' },
            { data: 'date_sortie_workflow1', name: 'date_sortie_workflow1' },
            { data: 'date_entrer_workflow2', name: 'date_entrer_workflow2' },
            { data: 'date_sortie_workflow2', name: 'date_sortie_workflow2' },
            { data: 'date_entrer_workflow3', name: 'date_entrer_workflow3' },
            { data: 'date_sortie_workflow3', name: 'date_sortie_workflow3' },
            { data: 'date_entrer_workflow4', name: 'date_entrer_workflow4' },
            { data: 'date_sortie_workflow4', name: 'date_sortie_workflow4' },
           
           {
    data: null,
    name: 'actions',
    orderable: false,
    searchable: false,
    
    render: function (data, type, full, meta) {
        var id = full.id;
        var etatWorkflow = data.etat_workflow; // Accédez à la valeur de etat_workflow dans le JSON

        // Calculer la position actuelle de la facture dans le workflow en JavaScript
        var positionActuelle = etatWorkflow - 2;

        // Calculer le pourcentage de progression en JavaScript
        var pourcentage = (positionActuelle / {{ $nombreWorkflow }}) * 100;

        var facture_id = data.id;
        var workflows = @json($workflows_any);

        var columnIndex = table_encour.column('date_entree_workflow1:name').index();
        var dates_entrer = []; // Déclarez un tableau vide

        dates_entrer[0] = full.date_entrer_workflow1; 
        dates_entrer[1] = full.date_entrer_workflow2;
        dates_entrer[2] = full.date_entrer_workflow3; 
        dates_entrer[3] = full.date_entrer_workflow4;

        var dates_sortie = []; // Déclarez un tableau vide

        dates_sortie[0] = full.date_sortie_workflow1; 
        dates_sortie[1] = full.date_sortie_workflow2;
        dates_sortie[2] = full.date_sortie_workflow3; 
        dates_sortie[3] = full.date_sortie_workflow4;


        var i = 0 ;
        // Créez une variable pour stocker le contenu HTML conditionnel
        var htmlContent = '';

      
        htmlContent += `
        <style>
            .progress-bar {
                transition: width 0.5s ease-in-out; /* Animation de la progression */
            }
        </style>
        <div class="btn-group align-items-center">
            <a href="{{ route('factures.chronologie') }}?facture_id=${full.id}" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
    <span class="fas fa-eye fa-lg text-info"></span>
</a>


            @can('facture_edit')
            <button onclick="editModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation" >
                <i class="fas fa-pencil-alt fa-lg text-primary"></i>
            </button>
            @endcan
            @can('facture_delete')
            <button onclick="deleteModal(${full.id}, '{{ auth()->user()->name }}')" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation">
                <i class="fas fa-trash-alt fa-lg text-danger"></i>
            </button>
            @endcan
           
            <style>
                              /* Définissez une variable CSS personnalisée pour l'inset */
                  :root {
                    --inset-value: 241px; /* Valeur par défaut */
                  }

                  /* Utilisez la variable CSS pour définir l'inset */
                  .dropdown-menu.show {
                    inset: 0px var(--inset-value) auto auto !important;
                  }

              
              </style>

              @can('facture_traitement')
                  <button type="button" class="btn btn-rounded btn-primary d-flex align-items-center" data-bs-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false"
                          style="width: 100%; position: relative; overflow: hidden; border-radius: 20px;">
                      <div class="progress-bar"
                           style="position: absolute; top: 0; left: 0; width: ${pourcentage}%; height: 100%; background-color: #007bff;"></div>
                      <div style="position: relative;  display: flex; align-items: center; justify-content: center; height: 100%; padding: 0px;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                               stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2">
                              <line x1="22" y1="2" x2="11" y2="13"></line>
                              <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                          </svg>
                          Traiter 
                      </div>
                  </button>
              @endcan
              <div class="dropdown-menu">
             
            
        `;
        workflows.forEach(function (workflow) {
          
            if (workflow.id == full.etat_workflow) {
                    if (dates_sortie[i] == "") {

                        if (dates_entrer[i] == "") {
                        htmlContent += `
                            <a class="dropdown-item  d-flex justify-content-between" href="#" onclick="traiterModal2(${full.id}, '{{ auth()->user()->name }}', ${workflow.id})">
                                <span class="workflow-label">${workflow.libelle}<i class="fa fa-plus text-info" aria-hidden="true"></i></span>
                            </a>`;
                        } 
                        else {
                        htmlContent += `
                            <a class="dropdown-item d-flex justify-content-between" href="#" onclick="traiterModal3(${full.id}, '{{ auth()->user()->name }}', {{ $workflow->id }})">
                                <span class="workflow-label">${workflow.libelle} <i class="fa-solid fa-spinner"></i></span>
                            </a>`;
                         }
                        
                            
                    } else {
                        
                            htmlContent += `
                                <a class="dropdown-item disabled d-flex justify-content-between" href="#" aria-disabled="true">
                                    <span class="workflow-label">${workflow.libelle} <i class="fa fa-check text-success" aria-hidden="true"></i></span>
                                </a>`;
                    }
            } 
           
            else if (workflow.id == parseInt(full.etat_workflow) + 1) {
                    if (dates_sortie[i-1] == "") {

                        
                        htmlContent += `
                            <a class="dropdown-item disabled d-flex justify-content-between" href="#" onclick="traiterModal2(${full.id}, '{{ auth()->user()->name }}', ${workflow.id})">
                                <span class="workflow-label">${workflow.libelle} <i class="fa fa-plus text-info" aria-hidden="true"></i></span>
                            </a>`;
                        
                        
                        
                            
                    } else {
                        
                        htmlContent += `
                            <a class="dropdown-item  d-flex justify-content-between" href="#" onclick="traiterModal2(${full.id}, '{{ auth()->user()->name }}', ${workflow.id})">
                                <span class="workflow-label">${workflow.libelle} <i class="fa fa-plus text-info" aria-hidden="true"></i></span>
                            </a>`;
                    }
                    





                    
            }
            else {
                    if (dates_sortie[i] == "") {

                        if (dates_entrer[i] == "") {
                        htmlContent += `
                            <a class="dropdown-item disabled d-flex justify-content-between" href="#" onclick="traiterModal2(${full.id}, '{{ auth()->user()->name }}', ${workflow.id})">
                                <span class="workflow-label">${workflow.libelle}<i class="fa fa-plus text-info" aria-hidden="true"></i></span>
                            </a>`;
                        } 
                        else {
                        htmlContent += `
                            <a class="dropdown-item disabled d-flex justify-content-between" href="#" onclick="traiterModal3(${full.id}, '{{ auth()->user()->name }}', {{ $workflow->id }})">
                                <span class="workflow-label">${workflow.libelle} <i class="fa-solid fa-spinner"></i></span>
                            </a>`;
                         }
                        
                            
                    } else {
                        
                            htmlContent += `
                                <a class="dropdown-item disabled d-flex justify-content-between" href="#" aria-disabled="true">
                                    <span class="workflow-label">${workflow.libelle} <i class="fa fa-check text-success" aria-hidden="true"></i></span>
                                </a>`;
                    }
                    





                    
            }
            i =i+1;
                });
                if (full.etat_workflow == 10 || full.date_sortie_workflow4 != "") {
                htmlContent += `
                            <a class="dropdown-item d-flex justify-content-between" href="#" onclick="traiterModal4(${full.id}, '{{ auth()->user()->name }}', {{ $workflow->id }})">
                                <span class="workflow-label">BANQUE <i class="fa fa-plus text-info"></i></span>
                            </a>`;
                }
                else
                {
                    htmlContent += `
                            <a class="dropdown-item disabled d-flex justify-content-between" href="#" onclick="traiterModal4(${full.id}, '{{ auth()->user()->name }}', {{ $workflow->id }})">
                                <span class="workflow-label">BANQUE <i class="fa fa-plus text-info"></i></span>
                            </a>`;
                }
        htmlContent += `
         
      </div>`;
        // Enfin, retournez le contenu HTML généré
        return htmlContent;
    }
},



        ]
    });

    






    var table_traite =$('#facture_traite').DataTable({
        serverSide: true,
        deferRender: true,
        dom: 'Bfrtip',
        scrollY: '400px',
        scrollX: true,
        buttons: ['copy', 'excel'],
        language: frenchTranslation,
        order: [],
        scrollCollapse: true,
        ajax: {
            url: "{{ route('factures.traiter-table') }}", 
            type: 'GET',
        },
        processing: true,
        columns: [
           
            { data: 'id', name: 'id' },
            { data: 'numero_facture', name: 'numero_facture' },
            { data: 'fournisseur', name: 'fournisseur' },
            {
                data: null,
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return `
                   <span class="mb-1 badge bg-info text-dark" >FIN</span>
                    `;
                }
            },
            { data: 'date_facture', name: 'date_facture',
                render: DataTable.render.date('DD/MM/YYYY')
    },
    { data: 'date_arriver_facture', name: 'date_arriver_facture',
                render: DataTable.render.date('DD/MM/YYYY')
    },
    {
    data: 'montant',
    name: 'montant',
    render: function(data, type, row, meta) {
        // Si le type est "display", formatez la valeur
        if (type === 'display') {
            // Utilisez la fonction toLocaleString pour ajouter une virgule pour les milliers
            var formattedValue = parseFloat(data).toLocaleString('fr-FR', {
                minimumFractionDigits: 2, // Affiche toujours 2 décimales
                maximumFractionDigits: 2, // Affiche toujours 2 décimales
            });

            // Supprimez ".00" des nombres entiers
            formattedValue = formattedValue.replace(/\,00$/, '');

            return formattedValue;
        }
        return data;
    }
},

            { data: 'devise', name: 'devise' },
            { data: 'commentaire', name: 'commentaire' },
            { data: 'date_enregistrement', name: 'date_enregistrement' },
            { data: 'date_entrer_workflow1', name: 'date_entrer_workflow1' },
            { data: 'date_sortie_workflow1', name: 'date_sortie_workflow1' },
            { data: 'date_entrer_workflow2', name: 'date_entrer_workflow2' },
            { data: 'date_sortie_workflow2', name: 'date_sortie_workflow2' },
            { data: 'date_entrer_workflow3', name: 'date_entrer_workflow3' },
            { data: 'date_sortie_workflow3', name: 'date_sortie_workflow3' },
            { data: 'date_entrer_workflow4', name: 'date_entrer_workflow4' },
            { data: 'date_sortie_workflow4', name: 'date_sortie_workflow4' },
            { data: 'date_fin', name: 'date_fin' },
            {
                data: null,
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return `
                        <div class="d-flex align-items-center">
                            <a href="{{ route('factures.chronologie') }}?facture_id=${full.id}" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
                                <span class="fas fa-eye fa-lg text-info"></span>
                            </a>
                            @can('facture_edit')
                            <button onclick="editModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation">
                                <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                            </button>
                            @endcan
                            @can('facture_delete')
                            <button onclick="deleteModal(${full.id}, '{{ auth()->user()->name }}')" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation">
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

  


   


    function editModal(id) {
    var factureId = id;

    const affectationRequired = document.getElementById('affectation-required');
    $.ajax({
        type: "GET",
        url: "{{ url('/facture/edit') }}" + '/' + factureId,
        success: function (response) {
            var data = response.facture;
            var data1 = response.workflow_all;

            $('#edit_facture_id').val(data.id);
            $('#u_numero_facture').val(data.numero_facture);
            $('#u_fournisseur').val(data.fournisseur);
            $('#u_date_facture').val(data.date_facture);
            $('#u_date_arriver_facture').val(data.date_arriver_facture);
            $('#u_montant').val(data.montant);
            $('#u_devise').val(data.devise);
            $('#u_etat_workflow').val(data.etat_workflow);

            $('#editForm').modal('show');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}





    function traiterModal(id, who_update) {
    Swal.fire({
        title: "Confirmer la date de traitement ?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler",
        html: '<input type="date" id="datepicker" class="swal2-input" placeholder="Sélectionnez une date">',
        preConfirm: function () {
            return $('#datepicker').val();
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            var selectedDate = result.value;

            $.ajax({
                type: "POST",
                url: "{{ route('factures.traiter') }}", // Utilisation de la route nommée
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    who_update: who_update,
                    selected_date: selectedDate
                },
                success: function (response) {
                    if (response.error) {
                        Swal.fire(
                            "Erreur !",
                            response.message,
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Traitement réussi !",
                            response.message,
                            "success"
                        );
                        $("#facture_enregistrement").DataTable().draw();
                    }
                },

                error: function (xhr, status, error) {
                    Swal.fire(
                        "Erreur !",
                        "Une erreur est survenue lors du traitement.",
                        "error"
                    );
                    // Gérer les erreurs si nécessaire
                }
            });
        }
    });

    // Initialiser le sélecteur de date
    $('#datepicker').datepicker();
}


function traiterModal2(id, who_update) {
    Swal.fire({
        title: "Confirmer la date d'entrée ",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler",
        html: '<input type="date" id="datepicker" class="swal2-input" placeholder="Sélectionnez une date">',
        preConfirm: function () {
            return $('#datepicker').val();
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            var selectedDate = result.value;

            $.ajax({
                type: "POST",
                url: "{{ route('factures.traiter_etapes') }}", 
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    who_update: who_update,
                    selected_date: selectedDate
                },
                success: function (response) {
                    if (response.error) {
                        Swal.fire(
                            "Erreur !",
                            response.message,
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Traitement réussi !",
                            response.message,
                            "success"
                        );
                        $("#facture_encour").DataTable().draw();

                       
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        "Erreur !",
                        "Une erreur est survenue lors du traitement.",
                        "error"
                    );
                   
                }
            });
        }
    });

    // Initialiser le sélecteur de date
    $('#datepicker').datepicker();
}



function traiterModal3(id, who_update) {
    Swal.fire({
        title: "Confirmer la date de sortie",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler",
        html: '<input type="date" id="datepicker" class="swal2-input" placeholder="Sélectionnez une date">',
        preConfirm: function () {
            return $('#datepicker').val();
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            var selectedDate = result.value;

            $.ajax({
                type: "POST",
                url: "{{ route('factures.traiter_etapes_sortie') }}", // Utilisation de la route nommée
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    who_update: who_update,
                    selected_date: selectedDate
                },
                success: function (response) {
                    if (response.error) {
                        Swal.fire(
                            "Erreur !",
                            response.message,
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Traitement réussi !",
                            response.message,
                            "success"
                        );
                        $("#facture_encour").DataTable().draw();
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        "Erreur !",
                        "Une erreur est survenue lors du traitement.",
                        "error"
                    );
                    // Gérer les erreurs si nécessaire
                }
            });
        }
    });

    // Initialiser le sélecteur de date
    $('#datepicker').datepicker();
}






function traiterModal4(id, who_update) {
    Swal.fire({
        title: "Confirmer la date d'envoie à la banque",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler",
        html: '<input type="date" id="datepicker" class="swal2-input" placeholder="Sélectionnez une date">',
        preConfirm: function () {
            return $('#datepicker').val();
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            var selectedDate = result.value;

            $.ajax({
                type: "POST",
                url: "{{ route('factures.traiter_etapes_banque') }}", 
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    who_update: who_update,
                    selected_date: selectedDate
                },
                success: function (response) {
                    if (response.error) {
                        Swal.fire(
                            "Erreur !",
                            response.message,
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Traitement réussi !",
                            response.message,
                            "success"
                        );
                        $("#facture_encour").DataTable().draw();
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        "Erreur !",
                        "Une erreur est survenue lors du traitement.",
                        "error"
                    );
                  
                }
            });
        }
    });

    // Initialiser le sélecteur de date
    $('#datepicker').datepicker();
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
                    window.location.href = "{{ url('factures/delete') }}" + "/" + id;
                    Swal.fire(
                        "Suppression !",
                        "En cours de traitement ...",
                        "success"
                    )
                }
            });
        }

 

// Récupérer les autorisations de l'utilisateur depuis les attributs HTML personnalisés
const editElement = document.querySelector('#facture_edition');
const canEdit = editElement ? editElement.getAttribute('data-can-edit') === 'true' : false;

const deleteElement = document.querySelector('#facture_suppression');
const canDelete = deleteElement ? deleteElement.getAttribute('data-can-delete') === 'true' : false;

// Définir la valeur du 'inset' en fonction des autorisations
let insetValue = '241px'; // Valeur par défaut

if (!canEdit && !canDelete) {
  // L'utilisateur n'a pas les autorisations nécessaires, réduisez la valeur de 'inset'
  insetValue = '168px'; // Nouvelle valeur pour les utilisateurs sans autorisations
}

// Appliquez la nouvelle valeur de la variable CSS personnalisée
document.documentElement.style.setProperty('--inset-value', insetValue);





      
</script>


<script src="{{ asset('assets/dist/js/pages/notes/notes_factures.js') }}"></script>




<script src="{{ asset('assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="{{ asset('assets/dist/js/buttons/dataTables.buttons.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.html5.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.print.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/jszip/3.1.3/jszip.min-1.js') }}"></script>

 <!-- This Page JS -->
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/dist/js/pages/forms/select2/select2.init.js') }}"></script>






 <!-- Modal Edit Courrier -->
 <div class="modal fade" id="editForm" tabindex="-1" aria-hidden="true">
    <form action="{{ route('facture.update') }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Modification d'une facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_facture_id">
                   
            
  
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="control-label text-end col-md-3">Numéro de facture</label>
                            <div class="col-md-9">
                                <input required
                                    type="text"
                                    name="u_numero_facture"
                                    value="{{ old('numero_facture') }}"
                                    id="u_numero_facture"
                                    class="form-control input-uppercase @error('numero_facture') input-error @enderror"
                                    style="border-color: #ccc;"
                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                    oninput="removeErrorStyles()"
                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                />
                                @error('numero_facture')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
  
                    
  
                    <!--/span-->
                   
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="control-label text-end col-md-3">Fournisseur</label>
                            <div class="col-md-9">
                                <input required
                                    type="text"
                                    name="u_fournisseur"
                                    value="{{ old('fournisseur') }}"
                                    id="u_fournisseur"
                                    class="form-control input-uppercase @error('fournisseur') input-error @enderror"
                                    style="border-color: #ccc;"
                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                    oninput="removeErrorStyles()"
                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                />
                                @error('fournisseur')
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
                <label class="control-label text-end col-md-3">Date facture</label>
                <div class="col-md-9">
                    <input required
                        type="date"
                        name="u_date_facture"
                        value="{{ old('date_facture') }}"
                        id="u_date_facture"
                        class="form-control input-uppercase @error('date_facture') input-error @enderror"
                        style="border-color: #ccc;"
                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                        oninput="removeErrorStyles()"
                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                    />
                    @error('date_facture')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
          </div>
  
        
  
        <!--/span-->
       
        <div class="col-md-6">
            <div class="mb-3 row">
                <label class="control-label text-end col-md-3">Date d'arriver facture</label>
                <div class="col-md-9">
                    <input required
                        type="date"
                        name="u_date_arriver_facture"
                        value="{{ old('date_arriver_facture') }}"
                        id="u_date_arriver_facture"
                        class="form-control input-uppercase @error('date_arriver_facture') input-error @enderror"
                        style="border-color: #ccc;"
                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                        oninput="removeErrorStyles()"
                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                    />
                    @error('date_arriver_facture')
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
            <label class="control-label text-end col-md-3">Montant</label>
            <div class="col-md-9">
                <input required
                    type="text"
                    name="u_montant"
                    value="{{ old('montant') }}"
                    id="u_montant"
                    class="form-control input-uppercase @error('montant') input-error @enderror"
                    style="border-color: #ccc;"
                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                    oninput="removeErrorStyles()"
                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                />
                @error('montant')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
  
    
  
    <!--/span-->
   
    <div class="col-md-6">
        <div class="mb-3 row">
            <label class="control-label text-end col-md-3">Devise</label>
            <div class="col-md-9">
                <select required name="u_devise" id="u_devise" class="form-control @error('devise') input-error @enderror"  style="border-color: #ccc;"
                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                    oninput="removeErrorStyles()"
                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                    <option value="">Sélectionner une devise</option>
                    <option value="XOF" @if(old('devise') === 'XOF') selected @endif>XOF</option>
                    <option value="EUR" @if(old('devise') === 'EUR') selected @endif>EUR</option>
                    <option value="USD" @if(old('devise') === 'USD') selected @endif>USD</option>
                </select>
                @error('devise')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
  
  
  
    
  
    <input type="hidden" name="who_update" id="who_update" class="form-control input-uppercase" value="{{ auth()->user()->name }}" required>
  
   
    <!-- Champ caché pour la date de fin de traitement -->
    <input type="hidden" name="etat_traitement" id="etat_traitement" value="1">
      
    
   
    <!--/span-->
  </div>
  
  
  <div class="row">
  
  
  
  <!--/span-->
  
  <div class="col-md-6">
      <div class="mb-3 row">
          <label class="control-label text-end col-md-3">Etat</label>
          <div class="col-md-9">
              <select required name="u_etat_workflow" id="u_etat_workflow" class="form-control @error('etat_workflow') input-error @enderror"  style="border-color: #ccc;"
                  onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                  oninput="removeErrorStyles()"
                  onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                  <option value="">Sélectionner une devise</option>
                  @forEach($workflows_debut as $workflow_test)
                    <option value="{{$workflow_test->id}}"  @if(old('u_etat_workflow') === $workflow_test->id) selected @endif>{{$workflow_test->libelle}}</option>
                   @endforeach
                  @forEach($workflows_any as $workflow_test)
                    <option value="{{$workflow_test->id}}" @if(old('u_etat_workflow') === $workflow_test->id) selected @endif>{{$workflow_test->libelle}}</option>
                   @endforeach
                   @forEach($workflows_fin as $workflow_test)
                    <option value="{{$workflow_test->id}}" @if(old('u_etat_workflow') === $workflow_test->id) selected @endif>{{$workflow_test->libelle}}</option>
                   @endforeach
              </select>
              @error('etat_workflow')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      </div>
  </div>
  
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
  
    
  



@endpush


@push('extra-modal')


@endpush
