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
<script src="{{ asset('assets/js/awesomplete.js') }}"></script>
 


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
                <form action="{{ route('factures.store') }}" method="POST" autocomplete="off">
                    @csrf
                <div class="card-header">  Nouvelle facture</div>
                <div class="card-body">


                    <div class="row pt-3">
                        <div class="col-md-6">
                         <div class="mb-3 @error('numero_facture') has-danger @enderror">
                            <label class="control-label">Numéro de facture<span class="text-danger">*</span></label>
                            <input required
                            type="text"
                            name="numero_facture"
                            value="{{ old('numero_facture') }}"
                            id="numero_facture"
                            class="form-control input-uppercase @error('numero_facture') input-error @enderror"
                            style="border-color: #ccc;"
                            onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                            oninput="removeErrorStyles()"
                            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                        />
                            @error('numero_facture')
                            <small class="form-control-feedback"> {{ $message }}  </small>
                            @enderror
                          </div>
                        </div>
                        <!--/span-->
                        

                      <div class="col-md-6">
                        <div class="mb-3 @error('fournisseur') has-danger @enderror">
                          <label class="control-label">Fournisseur<span class="text-danger">*</span></label>
                          <input required
                                    type="text"
                                    name="fournisseur"
                                    value="{{ old('fournisseur') }}"
                                    id="fournisseur"
                                    class="form-control input-uppercase @error('fournisseur') input-error @enderror"
                                    style="border-color: #ccc;"
                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                    oninput="removeErrorStyles()"
                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                />
                          @error('fournisseur')
                          <small class="form-control-feedback"> {{ $message }}  </small>
                          @enderror
                        </div>
                      </div>


                      
                        <!--/span-->
                    </div>



                    
                    <div class="row pt-3">
                        <div class="col-md-6">
                         <div class="mb-3 @error('date_facture') has-danger @enderror">
                            <label class="control-label">Date facture<span class="text-danger">*</span></label>
                            <input required
                            type="date"
                            name="date_facture"
                            value="{{ old('date_facture') }}"
                            id="date_facture"
                            class="form-control input-uppercase @error('date_facture') input-error @enderror"
                            style="border-color: #ccc;"
                            onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                            oninput="removeErrorStyles()"
                            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                        />
                            @error('date_facture')
                            <small class="form-control-feedback"> {{ $message }}  </small>
                            @enderror
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3 @error('date_arriver_facture') has-danger @enderror">
                              <label class="control-label">Date d'arriver facture<span class="text-danger">*</span></label>
                              <input required
                                        type="date"
                                        name="date_arriver_facture"
                                        value="{{ old('date_arriver_facture') }}"
                                        id="date_arriver_facture"
                                        class="form-control input-uppercase @error('date_arriver_facture') input-error @enderror"
                                        style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                    />
                              @error('date_arriver_facture')
                              <small class="form-control-feedback"> {{ $message }}  </small>
                              @enderror
                            </div>
                          </div>
                        <!--/span-->
                    </div>




                    <div class="row pt-3">
                        <div class="col-md-6">
                         <div class="mb-3 @error('montant_hidden') has-danger @enderror">
                            <label class="control-label">Montant<span class="text-danger">*</span></label>
                            <input required
                            type="text"
                            name="montant"
                            value="{{ old('montant') }}"
                            id="montant"
                            class="form-control input-uppercase @error('montant_hidden') input-error @enderror"
                            style="border-color: #ccc;"
                            onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                            oninput="removeErrorStyles()"
                            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                        />
                        <input
                            type="hidden"
                            name="montant_hidden"
                            value="{{ old('montant') }}"
                            id="montant_hidden"
                        />
                            @error('montant_hidden')
                            <small class="form-control-feedback"> {{ $message }}  </small>
                            @enderror
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3 @error('devise') has-danger @enderror">
                              <label class="control-label">Devise<span class="text-danger">*</span></label>
                              <select required name="devise" id="devise" class="form-control @error('devise') input-error @enderror"  style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        <option value="">Sélectionner une devise</option>
                                        <option value="XOF" @if(old('devise') === 'XOF') selected @endif>XOF</option>
                                        <option value="EUR" @if(old('devise') === 'EUR') selected @endif>EUR</option>
                                        <option value="USD" @if(old('devise') === 'USD') selected @endif>USD</option>
                                    </select>
                              @error('devise')
                              <small class="form-control-feedback"> {{ $message }}  </small>
                              @enderror
                            </div>
                          </div>
                        <!--/span-->
                    </div>


                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="mb-3 @error('commentaire') has-danger @enderror">
                            <label style="font-size: 1rem; ">Commentaire</label>
                            <textarea 
                            type="text"
                            name="commentaire"
                            value="{{ old('commentaire') }}"
                            id="commentaire"
                            class="form-control input-uppercase @error('commentaire') input-error @enderror"
                            style="border-color: #ccc;"
                            onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                            oninput="removeErrorStyles()"
                            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';" rows="3" style="height: 82px;"></textarea>
                            @error('commentaire')
                            <small class="form-control-feedback"> {{ $message }}  </small>
                            @enderror
                          </div>
                        </div>
                        <!--/span-->
                        

                      
                        <!--/span-->
                    </div>

                

                    



                     
                      <input type="hidden" name="who_create" id="who_create" class="form-control" value="{{ auth()->user()->name }}" required>
               
                    <!-- Champ caché pour la date de début de traitement -->
                    <input type="hidden" name="etat_workflow" id="etat_workflow" value="1">
                    <!-- Champ caché pour la date de fin de traitement -->
                    <input type="hidden" name="etat_traitement" id="etat_traitement" value="1">
                      
                  
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger rounded-pill px-4 me-2" data-bs-dismiss="modal">
                          Annuler
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                          Valider
                        </button>
                      </div>
                      

                </div>
              </div>
            </form>


                <div class="card">
                  
                    <div class="card-header">  Facture de la journée</div>
                    <div class="card-body">



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
                        <div class="table-responsive"  >
            
                            <table id="facture_create" style="width: 100%;" class="table table-hover table-striped table-bordered  display  text-nowrap " >
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Numéro facture</th>
                                  <th>Fournisseur</th>
                                  <th>statut</th>
                                  <th>Date facture</th>
                                  
                                  <th>Date d'arrivée facture</th>
                                  <th >Montant</th>
                                  <th >Devise</th>
                                  <th >Commentaire</th>

                                                                  
                                  
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

        </div>
    </div>


</div>
    


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
  
  <div class="col-md-6" hidden>
      <div class="mb-3 row">
          <label class="control-label text-end col-md-3">Etat</label>
          <div class="col-md-9">
              <select required name="u_etat_workflow" id="u_etat_workflow" class="form-control @error('etat_workflow') input-error @enderror"  style="border-color: #ccc;"
                  onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                  oninput="removeErrorStyles()"
                  onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';" >
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

@endsection



@push('extra-js')


<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#facture_create').DataTable({
            serverSide: true,
            deferRender: true,
            dom: 'Bfrtip',
            scrollY: '300px',
            scrollX: true,
            buttons: ['copy', 'excel'],
            language: frenchTranslation,
            order: [[11, 'desc']],
            scrollCollapse: true,
            ajax: {
                url: "{{ route('factures.create-table') }}", 
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
                      
                        <button onclick="editModal(${full.id})" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                <i class="fas fa-edit fa-lg text-info"></i>
                              </button>
                      
                              @can('facture_delete')
                              <button onclick="deleteModal(${full.id}, '{{ auth()->user()->name }}')" type="button" class="btn btn-sm btn-info me-2" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteForm" data-id="" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                  <i class="fas fa-trash-alt fa-lg text-danger"></i>
                              </button>
                              @endcan
              
                        `;
                    }
                },
                
                { data: 'updated_at', name: 'updated_at', visible: false },
            ]
        });
    
    
        
    });
    
    
    
    </script>
    
    



<script src="{{ asset('assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="{{ asset('assets/dist/js/buttons/dataTables.buttons.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/ajax/jszip/3.1.3/jszip.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/buttons/buttons.html5.min-1.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>

<!-- This Page JS -->
<script src="{{ asset('assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
 <script src="{{ asset('assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/dist/js/pages/forms/select2/select2.init.js') }}"></script>


<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script>
  // Initialisation du plugin PerfectScrollbar
  const ps = new PerfectScrollbar('.ps', {
    suppressScrollX: true, // Supprime la barre de défilement horizontale
  });



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
        const inputElement = document.getElementById('fournisseur');
        inputElement.classList.remove('input-error');
    }



</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fournisseurs = <?php echo json_encode($fournisseurs); ?>;
   console.log(fournisseurs);

   var input = document.querySelector("#fournisseur");
    new Awesomplete(input, {
        list: fournisseurs,
        minChars: 2
    });
    
});

   
</script>

<script>
    // Fonction pour formater le montant avec des espaces pour les milliers, les millions, etc.
    function formatAmount(input) {
        
        // Supprimez d'abord tous les espaces de la valeur
        var value = input.value.replace(/\s+/g, '');

        // Vérifiez si la valeur est un nombre valide
        if (!isNaN(value)) {
            // Convertissez la valeur en nombre
            var numericValue = Number(value);

            // Formatez le nombre avec des espaces pour les milliers, les millions, etc.
            var formattedValue = numericValue.toLocaleString('fr-FR'); // Utilisez 'fr-FR' pour le format français (espaces comme séparateurs)

            // Mettez à jour la valeur du champ de saisie avec la version formatée
            input.value = formattedValue;
        
        }
        // Mettez à jour la valeur du champ caché avec la valeur non formatée
        document.getElementById('montant_hidden').value = numericValue;

        

    }

    // Obtenir une référence au champ de saisie
    var montantInput = document.querySelector("#montant");

    // Ajoutez un gestionnaire d'événement pour détecter les changements de saisie
    montantInput.addEventListener("input", function() {
        formatAmount(this);
    });
</script>




@endpush


@push('extra-modal')


@endpush
