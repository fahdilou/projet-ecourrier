@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<style>
    /* Custom CSS to change the background color of the input field when there's an error */
    .input-error {
        background-color: #ffe6e6; 
    }
</style>




<div class="container-xxl flex-grow-1 container-p-y">

   

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">
    


        <div class="row">
  <div class="col-lg-6 col-md-12">
    <div class="card">
      <div class="border-bottom title-part-padding d-flex justify-content-between">
        <h4 class="card-title mb-0">Workflow</h4>
        <div class="btn-group mb-2">
            <button class="btn btn-light-primary text-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                <li> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#createWorkflow">Creation Workflow</a>
                </li>
                <li> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editWorkflow">Edition Workflow</a>
                </li>
                <li> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#statesWorkflow">Désactiver Workflow</a>
                </li>
            </ul>
        </div>
    </div>
    
      <div class="card-body">
        <div class="dd myadmin-dd" id="nestable-menu">
          <div class="divider" style="width: 100%; display: flex; align-items: center; text-align: center; margin-bottom: 30px;">
            <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
            <div class="divider-text" style="margin: 0 10px;">
                <strong><span style="font-size: 20px;">Ordre de workflow</span></strong>
            </div>
            <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
        </div>
        
          <!-- Form -->
          <form id="enregistrer-ordre-form" action="{{ route('metiers.enregistrer-ordre') }}" method="POST">
            @csrf
            @method('POST')
            <ol class="dd-list">
              @foreach ($workflows as $index => $workflow)
              <li class="dd-item" data-id="{{ $workflow->id }}">
                <div class="dd-handle">{{ $workflow->libelle }}</div>
                <input type="hidden" name="workflow[{{ $index }}][id]" value="{{ $workflow->id }}">
                <input type="hidden" name="workflow[{{ $index }}][num_ordre]" value="{{ $workflow->num_ordre }}">
              </li>
              @endforeach
            </ol>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-12">
    <div class="card">
      <div class="border-bottom title-part-padding d-flex justify-content-between">
        <h4 class="card-title mb-0">Etapes traitement</h4>
        <div class="btn-group mb-2">
            <button class="btn btn-light-primary text-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                <li> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#createEtapetraitement">Creation Etape traitement</a>
                </li>
                <li> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editEtapetraitement">Edition Etape traitement</a>
                </li>
                <li> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#statesEtapetraitement">statut Etape traitement</a>
                </li>
            </ul>
        </div>
    </div>
    
      <div class="card-body">


      <div class="myadmin-dd dd" id="nestable">
        
          <!-- Form -->
          <form id="enregistrer-ordre-traitement-form" action="{{ route('metiers.enregistrer-ordre-traitement') }}" method="POST">
            @csrf
            @method('POST')
            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <label class="control-label text-end col-md-3">Workflow</label>
                                    <div class="col-md-9">
                                        <select required name="workflow_id" id="workflow_id" class="form-control @error('workflow') input-error @enderror" style="border-color: #ccc;"
                                            onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                            oninput="removeErrorStyles()"
                                            onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                            <option value="">Sélectionner un workflow</option>
                                            @foreach ($workflows_any as $workflow)
                                            <option value="{{ $workflow->id }}" data-num-ordre="{{ $workflow->num_ordre }}">{{ $workflow->libelle }}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="divider" style="width: 100%; display: flex; align-items: center; text-align: center; margin-top: 30px; margin-bottom: 30px;">
                              <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
                              <div class="divider-text" style="margin: 0 10px;">
                                  <strong><span style="font-size: 20px;">Ordre de traitement workflow</span></strong>
                              </div>
                              <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
                          </div>
                            <ol class="dd-list" id="etapes_traitement_list">
                                @foreach ($etapetraitements as $index => $etapetraitement)
                                    <li class="dd-item etapes-traitement etapes-traitement-{{ $etapetraitement->parent_id }}" data-id="{{ $etapetraitement->id }}" style="display: none;">
                                        <div class="dd-handle">{{ $etapetraitement->libelle }}</div>
                                        <input type="hidden" name="etapetraitement[{{ $index }}][id]" value="{{ $etapetraitement->id }}">
                                        <input type="hidden" name="etapetraitement[{{ $index }}][num_ordre]" value="{{ $etapetraitement->num_ordre }}">
                                        <input type="hidden" name="etapetraitement[{{ $index }}][parent_id]" value="{{ $etapetraitement->parent_id }}">
                                    </li>
                                @endforeach
                            </ol>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </form>
        </div>



      </div>



      



      
    </div>
  </div>


  <div class="col-lg-6 col-md-12">
    <div class="card">
      <div class="border-bottom title-part-padding d-flex justify-content-between">
        <h4 class="card-title mb-0">Configuration</h4>
        
    </div>
    
      <div class="card-body">
        <div class="dd myadmin-dd" id="nestable-menu">
          <div class="divider" style="width: 100%; display: flex; align-items: center; text-align: center; margin-bottom: 30px;">
            <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
            <div class="divider-text" style="margin: 0 10px;">
                <strong><span style="font-size: 20px;">Montant d'autorisation</span></strong>
            </div>
            <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
        </div>
        
          <!-- Form -->
          <form id="enregistrer-config-form" action="{{ route('metiers.enregistrer-config') }}" method="POST">
            @csrf
            @method('POST')
            <div class="col-md-12">
              <div class="mb-3 ">
                
                 <input required
                 type="text"
                 name="montant_autorisation"
                 value="{{ $montant_autorisation->value }}"
                 id="montant_autorisation"
                 class="form-control input-uppercase @error('montant_autorisation') input-error @enderror"
                 style="border-color: #ccc;"
                 onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                 oninput="removeErrorStyles()"
                 onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
             />
             
                
               </div>
             </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  

</div>




        <div class="row">
            <div class="col-lg-0 col-md-0" style="display:none">
              <div class="card">
                <div class="border-bottom title-part-padding">
                  <h4 class="card-title mb-0">Nestable1</h4>
                </div>
                <div class="card-body">
                  <div class="myadmin-dd dd" id="nestable">
                   
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-0 col-md-0" style="display:none">
              <div class="card">
                <div class="border-bottom title-part-padding">
                  <h4 class="card-title mb-0">Nestable2</h4>
                </div>
                <div class="card-body">
                  <div class="myadmin-dd-empty dd" id="nestable2">
                    
                  </div>
                </div>
              </div>
            </div>

        </div>
    

    </div>
</div>
</div>
    


@endsection



@push('extra-js')


<script src="{{ asset('assets/dist/libs/nestable/jquery.nestable.js') }}"></script>


    




    <script>
function enregistrerOrdre() {
  let items = document.querySelectorAll('.dd-item');
  items.forEach((item, index) => {
    let input = item.querySelector('input[name="workflow[' + index + '][num_ordre]"]');
    if (input) {
      input.value = index + 1;
    }
  });

  document.getElementById('workflowForm').submit();
}
</script>




<script>
      $(function () {
        // Nestable
        var updateOutput = function (e) {
          var list = e.length ? e : $(e.target),
            output = list.data("output");
          if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable("serialize"))); //, null, 2));
          } else {
            output.val("JSON browser support required for this demo.");
          }
        };

        $("#nestable")
          .nestable({
            group: 1,
          })
          .on("change", updateOutput);

        $("#nestable2")
          .nestable({
            group: 1,
          })
          .on("change", updateOutput);

        updateOutput($("#nestable").data("output", $("#nestable-output")));
        updateOutput($("#nestable2").data("output", $("#nestable2-output")));

       
        $("#nestable-menu").nestable();
      });
    </script>

@include('metiers.modal')

<!-- Modal state Etape traitement -->
<div class="modal fade" id="statesEtapetraitement" tabindex="-1" aria-hidden="true">
  <form action="{{ route('metiers.stateEtapetraitement') }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')
      <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel3">Statut Etape traitement</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 
          

                <div class="row">
                
                                        

                  <!--/span-->
                    <div class="col-md-12">
                            <div class="mb-3 row">
                                <label class="control-label text-end col-md-3">Etape</label>
                                <div class="col-md-9">
                                    <select required name="etape" id="etape" class="form-control @error('etape') input-error @enderror" style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                        <option value="">Sélectionner une étape</option>
                                        @foreach ($etapetraitements_any as $etapetraitement)
                                        <option value="{{ $etapetraitement->id }}" data-num-ordre="{{ $etapetraitement->num_ordre }}">{{ $etapetraitement->libelle }}</option>
                                        @endforeach
                                    </select>
                                
                                </div>
                            </div>
                        </div>

              
            
                    <!--/span-->
                  </div>


                  <div class="row">


                      <div class="col-md-12">
                              <div class="mb-3 row">
                                  <label class="control-label text-end col-md-3">Statut</label>
                                  <div class="col-md-9">
                                      <select required name="statut" id="statut" class="form-control @error('statut') input-error @enderror" style="border-color: #ccc;"
                                          onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                          oninput="removeErrorStyles()"
                                          onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                          <option value="">Sélectionner un statut</option>
                                          <option value="ACTIF">ACTIF</option>
                                          <option value="INACTIF">INACTIF</option>
                                          
                                      </select>
                                    
                                  </div>
                              </div>
                          </div>
                          <input type="hidden" name="who_update" id="who_update" class="form-control input-uppercase" value="{{ auth()->user()->name }}" required>

                          <!--/span-->
                        
                      
                          <!--/span-->
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







<!-- Modal Edit Etape traitement -->
<div class="modal fade" id="editEtapetraitement" tabindex="-1" aria-hidden="true">
  <form action="{{ route('metiers.updateEtapetraitement') }}" method="POST" autocomplete="off">
      @csrf
      @method('PUT')
      <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel3">Modification Etape traitement</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 
          

               <div class="row">
              
                                       

                 <!--/span-->
                 <div class="col-md-12">
                      <div class="mb-3 row">
                          <label class="control-label text-end col-md-3">Etape</label>
                          <div class="col-md-9">
                              <select required name="etape" id="etape" class="form-control @error('workflow') input-error @enderror" style="border-color: #ccc;"
                                  onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                  oninput="removeErrorStyles()"
                                  onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                  <option value="">Sélectionner une etape de traitement</option>
                                  @foreach ($etapetraitements as $etapetraitement)
                                  <option value="{{ $etapetraitement->id }}">{{ $etapetraitement->libelle }}</option>
                                  @endforeach
                              </select>
                             
                          </div>
                      </div>
                  </div>

            
           
                  <!--/span-->
           </div>


           <div class="row">


                  <div class="col-md-12">
                      <div class="mb-3 row">
                          <label class="control-label text-end col-md-3">Libellé</label>
                          <div class="col-md-9">
                              <input required
                                  type="text"
                                  name="libelle_et"
                                  value="{{ old('libelle_et') }}"
                                  id="libelle_et"
                                  class="form-control input-uppercase @error('lebelle_t') input-error @enderror"
                                  style="border-color: #ccc;"
                                  onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                  oninput="removeErrorStyles()"
                                  onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                              />
                              @error('libelle_et')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <input type="hidden" name="who_update" id="who_update" class="form-control input-uppercase" value="{{ auth()->user()->name }}" required>

                  <!--/span-->
                 
                    
                  <!--/span-->
                </div>
                                  

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




 
    <!-- Modal create Etape traitement -->
    <div class="modal fade" id="createEtapetraitement" tabindex="-1" aria-hidden="true">
      <form action="{{ route('metiers.createEtapetraitement') }}" method="POST" autocomplete="off">
          @csrf
          <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel3">Creation étape</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">           
                    
                    
                    <div class="row">
                    
                                             

                      <!--/span-->
                       <div class="col-md-12">
                               <div class="mb-3 row">
                                   <label class="control-label text-end col-md-3">Workflow</label>
                                   <div class="col-md-9">
                                       <select required name="workflow" id="workflow" class="form-control @error('workflow') input-error @enderror" style="border-color: #ccc;"
                                           onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                           oninput="removeErrorStyles()"
                                           onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                                           <option value="">Sélectionner un workflow</option>
                                           @foreach ($workflows_any as $workflow)
                                           <option value="{{ $workflow->id }}" data-num-ordre="{{ $workflow->num_ordre }}">{{ $workflow->libelle }}</option>
                                           @endforeach
                                       </select>
                                   
                                   </div>
                               </div>
                           </div>

                 
                
                       <!--/span-->
                      </div>

              

                   <div class="row">


                   <div class="col-md-12">
                          <div class="mb-3 row">
                              <label class="control-label text-end col-md-3">Libellé</label>
                              <div class="col-md-9">
                                  <input required
                                      type="text"
                                      name="libelle_t"
                                      value="{{ old('libelle_t') }}"
                                      id="libelle_c"
                                      class="form-control input-uppercase @error('lebelle_t') input-error @enderror"
                                      style="border-color: #ccc;"
                                      onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                      oninput="removeErrorStyles()"
                                      onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                  />
                                  @error('libelle_t')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                      </div>
                  
                      <input type="hidden" name="who_create_t" id="who_create_t" class="form-control input-uppercase" value="{{ auth()->user()->name }}" required>

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






   






    //changer la valeur de libellé en temps reels
    <script>
    document.getElementById('workflow').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var libelle = selectedOption.text;
        document.getElementById('libelle').value = libelle;
    });


    //changer libelle edition etape traitement

    document.getElementById('etape').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var libelle = selectedOption.text;
        document.getElementById('libelle_et').value = libelle;
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

<script>
    document.getElementById('workflow').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var numOrdre = selectedOption.dataset.numOrdre;
        var statutSelect = document.getElementById('statut');

        if (numOrdre) {
            // Le numOrdre existe, le statut sera Actif
            statutSelect.value = 'ACTIF';
        } else {
            // Le numOrdre n'existe pas, le statut sera Inactif
            statutSelect.value = 'INACTIF';
        }
    });

    document.getElementById('etape').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var numOrdre = selectedOption.dataset.numOrdre;
        var statutSelect = document.getElementById('statut');

        if (numOrdre) {
            // Le numOrdre existe, le statut sera Actif
            statutSelect.value = 'ACTIF';
        } else {
            // Le numOrdre n'existe pas, le statut sera Inactif
            statutSelect.value = 'INACTIF';
        }
    });
</script>

<script>
    // Fonction pour mettre à jour la liste des étapes de traitement en fonction du workflow sélectionné
    function updateEtapesTraitementList() {
        var workflowId = document.getElementById('workflow_id').value;
        var etapesTraitementList = document.getElementById('etapes_traitement_list');
        var etapesTraitementItems = etapesTraitementList.getElementsByClassName('etapes-traitement');

        // Masquer toutes les étapes de traitement
        for (var i = 0; i < etapesTraitementItems.length; i++) {
            etapesTraitementItems[i].style.display = 'none';
        }

        // Afficher les étapes de traitement associées au workflow sélectionné
        var etapesTraitementForWorkflow = etapesTraitementList.getElementsByClassName('etapes-traitement-' + workflowId);
        for (var j = 0; j < etapesTraitementForWorkflow.length; j++) {
            etapesTraitementForWorkflow[j].style.display = 'list-item';
        }
    }

    // Appeler la fonction updateEtapesTraitementList lorsque la sélection du workflow change
    document.getElementById('workflow_id').addEventListener('change', updateEtapesTraitementList);

    // Appeler la fonction updateEtapesTraitementList au chargement de la page pour afficher les étapes de traitement initiales
    updateEtapesTraitementList();
</script>



@endpush


@push('extra-modal')


@endpush
