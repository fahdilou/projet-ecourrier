@extends('layouts.app')

@section('content')

<!-- Icons -->
<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

<style>
    /* Custom CSS to change the background color of the input field when there's an error */
    .input-error {
        background-color: #ffe6e6; 
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

<div class="container-xxl flex-grow-1 container-p-y">

   

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="card">
               
                <div class="card-header">  Factures traités</div>
                <div class="card-body">
                    
              <div class="table-responsive"  >

                <!-- filtrage  -->
               
                <div class="mb-3 row">
                    <label class="control-label text-end col-md-2">Date début</label>
                    <div class="col-md-2">
                    <input type="date" id="start_date" class="form-control">

                    </div>
                    <label class="control-label text-end col-md-2">Date fin</label>
                    <div class="col-md-2">
                         <input type="date" id="end_date" class="form-control">
                    </div>
                    <label class="control-label text-end col-md-2">Fournisseurs</label>
                    <div class="col-md-2">
                        <input type="text" id="fournisseur_filter" class="form-control input-uppercase">
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


                    /* Appliquez la position sticky à la dernière colonne */
                    table.dataTable tbody td:last-child {
                        position: sticky;
                        right: 0;
                        z-index: 1;
                        background-color: #f9f9f9;
                    }


                </style>
            
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
    var table = $('#facture_traite').DataTable({
        serverSide: true,
        deferRender: true,
        dom: 'Bfrtip',
        scrollY: '400px',
        scrollX: true,
        buttons: [ 'pageLength','copy', 'excel'],
        language: frenchTranslation,
        order: [],
        scrollCollapse: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
        pagingType: "full_numbers",
        ajax: {
            url: "{{ route('factures.traite-table') }}", 
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
                            <a href="{{ route('factures.chronologie') }}/${full.id}" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
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

    // Gestionnaire d'événement pour le bouton de filtrage
$('#filter_buttonSS').on('click', function() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var fournisseur = $('#fournisseur_filter').val();

    // Définir la colonne Date Facture
    var dateFactureColumn = table.column(4);

   
    dateFactureColumn
        .search(function (value, regex, index) {
            var dateFacture = moment(value, 'DD/MM/YYYY'); 
            
            if (dateFacture.isValid()) {
                return dateFacture.isSameOrAfter(start_date) && dateFacture.isSameOrBefore(end_date);
            } else {
                return false;
            }
        })
        .draw();

    // Vérifier si la colonne Fournisseur existe
    var fournisseurColumn = table.column(2);
    if (fournisseurColumn.nodes().length > 0) {
       
        // Appliquer le filtre sur la colonne Fournisseur
        fournisseurColumn.search(fournisseur).draw();
    } 
});


    // Gestionnaire d'événement pour le bouton de réinitialisation
    $('#reset_button').on('click', function() {
        // Réinitialiser les champs de filtre
        $('#start_date').val('');
        $('#end_date').val('');
        $('#fournisseur_filter').val('');

        // Réinitialiser le filtre et redessiner la table
        table
            .columns().search('')
            .draw();
    });

    
});

</script>


<script>
    function applyFilter() {
   // Récupérez les valeurs des champs de filtrage
   var startDate = document.getElementById('start_date').value;
   var endDate = document.getElementById('end_date').value;
   var fournisseur = document.getElementById('fournisseur_filter').value;
  
   // Effectuez une requête Ajax pour récupérer les données filtrées
   $.ajax({
       type: 'GET',
       url: "{{ route('factures.traite-table-filter') }}", // L'URL de votre route Laravel pour récupérer les données
       data: {
           start_date: startDate,
           end_date: endDate,
           fournisseur: fournisseur
       },
       dataType: 'json',
       success: function(data) {
           // Mettez à jour le DataTable avec les nouvelles données
           var table = $('#facture_traite').DataTable();
           table.clear().destroy(); // Supprimer et détruire le DataTable existant
           
           
           var tables = $('#facture_traite').DataTable({
        
        dom: 'Bfrtip',
        scrollY: '300px',
        scrollX: true,
        buttons: ['copy', 'excel'],
        language: frenchTranslation,
        order: [],
        scrollCollapse: true,
        processing: true,
        data: data.data,
        columns: [
            // Configurez ici les colonnes de votre DataTable
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
                            <a href="{{ route('factures.chronologie') }}/${full.id}" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
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
       tables.draw();
          
       },

       error: function(xhr, status, error) {
           console.error(xhr.responseText);
       }
   });
}







function resetDataTable() {
    // Réinitialiser les champs d'entrée
    document.getElementById("start_date").value = "";
    document.getElementById("end_date").value = "";
    document.getElementById("fournisseur_filter").value = "";
       var table = $('#facture_traite').DataTable();
       table.clear().destroy(); // Supprimer et détruire le DataTable existant

       var tables = $('#facture_traite').DataTable({
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
            url: "{{ route('factures.traite-table') }}", // L'URL de votre route Laravel
            type: 'GET',
        },
        processing: true,
        columns: [
            // Configurez ici les colonnes de votre DataTable
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
                            <a href="{{ route('factures.chronologie') }}/${full.id}" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;">
                                <span class="fas fa-eye fa-lg text-info"></span>
                            </a>
                            @can('facture_delete')
                            <button onclick="editModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Validation">
                                <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                            </button>
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
   
       tables.draw();
   }


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
                  <option value="">Sélectionner un état</option>
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
    var fournisseurs = <?php echo json_encode($fournisseurs); ?>;
 
    var input = document.querySelector("#fournisseur_filter");
     new Awesomplete(input, {
         list: fournisseurs,
         minChars: 2
     });
     
 </script>

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
