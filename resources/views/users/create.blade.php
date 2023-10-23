

<div class="modal fade" id="addForm" tabindex="-1" aria-hidden="true" style="display: none;">
    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Enregistrement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                {{-- content --}}

                <div class="row">

                    <div class="mb-2 col-md-6">
                        <label class="form-label">Nom <span class="text-danger">*</span> </label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}"  id="name"  required="" >
                    </div>

                    <div class="mb-2 col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span> </label>

                        <input required type="email" name="email" value="{{ old('email') }}"  id="email"  class="form-control @error('email') is-invalid @enderror" >
                    </div>

                </div>

                <div class="row">

                    <div class="mb-2 col-md-6">
                        <label class="form-label">Poste <span class="text-danger">*</span> </label>
                        <input required type="text" name="poste" value="{{ old('poste') }}"  id="poste"  class="form-control form-control-md @error('poste') is-invalid @enderror" >
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Type de connexion</label>
                        <select required name="type_connexion" id="type_connexion" class="form-select form-select-md @error('type_connexion') is-invalid @enderror"  style="width: 100%">
                            <option value="">Choisissez une option</option>
                          
                            <option value="SQL"
                            {{ old('type_connexion') == 'SQL' ? 'selected' : '' }}>
                                SQL
                            </option>

                            <option value="WINDOWS"
                            {{ old('type_connexion') == 'WINDOWS' ? 'selected' : '' }}>
                                WINDOWS
                            </option>

                        </select>
                      </div>



                </div>

                <div class="row">

                    <div class="mb-2 col-md-6">
                        <label class="form-label">Mot de passe <span class="text-danger">*</span> </label>
                        <input required type="password" name="password" value="{{ old('password') }}"  id="password"  class="form-control form-control-md @error('password') is-invalid @enderror" >
                    </div>

                    <div class="mb-2 col-md-6">
                        <label class="form-label">Confirmation mot de passe <span class="text-danger">*</span> </label>
                        <input required  type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"  id="password_confirmation"  class="form-control form-control-md @error('password_confirmation') is-invalid @enderror" >
                    </div>



                </div>


                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Actif</label>
                        <select required name="est_actif" id="est_actif" class="form-select form-select-md @error('est_actif') is-invalid @enderror"  style="width: 100%">
                            <option value="">Choisissez une option</option>
                          
                            <option value="1"
                            {{ old('est_actif') == '1' ? 'selected' : '' }}>
                            ACTIF</option>
                        <option value="0"
                            {{ old('est_actif') == '0' ? 'selected' : '' }}>
                            INACTIF</option>

                        </select>

                        <select class="form-control select2-hidden-accessible" id="select2-search-hide" style="width: 100%; height: 36px" data-select2-id="select2-data-select2-search-hide" tabindex="-1" aria-hidden="true">
                           
                              <option value="AK" data-select2-id="select2-data-45-mtrj">Alaska</option>
                              <option value="HI" data-select2-id="select2-data-722-r0zj">Hawaii</option>
                           
                         
                         
                          </select>
                    </div>

                  
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Droit</label>
                        <select required name="droit" id="droit" class="form-select form-select-md @error('droit') is-invalid @enderror"  style="width: 100%">
                            <option value="">Choisissez une option</option>
                          
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('droit') == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }} 
                                </option>
                            @endforeach

                        </select>
                    </div>



                </div>

                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">
                    Annuler
                  </button>
                  
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    Valider
                  </button>
            </div>
        </div>
        </div>
    </form>
</div>