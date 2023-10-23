

    <!-- Modal state Workflow -->
    <div class="modal fade" id="statesWorkflow" tabindex="-1" aria-hidden="true">
        <form action="{{ route('metiers.stateWorkflow') }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Statut workflow</h5>
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
                                            @foreach ($workflows_anys as $workflow)
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
                                <label class="control-label text-end col-md-3">Statut</label>
                                <div class="col-md-9">
                                    <select required name="statut" id="statut" class="form-control @error('workflow') input-error @enderror" style="border-color: #ccc;"
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


 


<!-- Modal Edit Workflow -->
 <div class="modal fade" id="editWorkflow" tabindex="-1" aria-hidden="true">
        <form action="{{ route('metiers.updateWorkflow') }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Modification workflow</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_workflow_id">
                       
                

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
                                        @foreach ($workflows as $workflow)
                                        <option value="{{ $workflow->id }}">{{ $workflow->libelle }}</option>
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
                                        name="libelle"
                                        value="{{ old('libelle') }}"
                                        id="libelle"
                                        class="form-control input-uppercase @error('lebelle') input-error @enderror"
                                        style="border-color: #ccc;"
                                        onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                        oninput="removeErrorStyles()"
                                        onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                    />
                                    @error('libelle')
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



    <!-- Modal create Workflow -->
 <div class="modal fade" id="createWorkflow" tabindex="-1" aria-hidden="true">
        <form action="{{ route('metiers.createWorkflow') }}" method="POST" autocomplete="off">
            @csrf
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Création de workflow</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">                       
                

                                <div class="row">


                                <div class="col-md-12">
                                        <div class="mb-3 row">
                                            <label class="control-label text-end col-md-3">Libellé</label>
                                            <div class="col-md-9">
                                                <input required
                                                    type="text"
                                                    name="libelle_c"
                                                    value="{{ old('libelle_c') }}"
                                                    id="libelle_c"
                                                    class="form-control input-uppercase @error('lebelle_c') input-error @enderror"
                                                    style="border-color: #ccc;"
                                                    onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                                                    oninput="removeErrorStyles()"
                                                    onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';"
                                                />
                                                @error('libelle_c')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                
                                    <input type="hidden" name="who_create_c" id="who_create_c" class="form-control input-uppercase" value="{{ auth()->user()->name }}" required>

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
         </div>
        </form>
    </div>



