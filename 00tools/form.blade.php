<div class="card card-custom gutter-b">
    <div class="card-header">
     <div class="card-title">
      <h3 class="card-label">
     Création d'un rôle utilisateur
      
      </h3>
     </div>
    </div>
    
    <form action="" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
         
         <div class="form-group">
          <label>Nom <span class="text-danger">*</span></label>
          <input type="text" name="input1" class="form-control @error('input1') is-invalid @enderror" value="{{ old('input1') }}" required />
         </div>



         


        
        </div>
        <div class="card-footer">
         <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
         <button type="reset" class="btn btn-secondary">Annuler</button>
        </div>
    </form>

</div>





<div class="form-group">
    <label>Scellés <span class="text-danger">*</span></label>
    <select name="droit" id="u_droit" class="form-control select @error('droit') is-invalid @enderror" style="width: 100%"  required>
        <option value="">Choisissez une option</option>
        @foreach($roles as $role)
        <option value="{{ $role->name }}" {{ old('droit') == $role->name ? 'selected' : '' }}> {{ $role->name }} </option>
         @endforeach
    </select>
</div>



$('.select').select2({
    dropdownParent: $('#editForm')
});



<div class="form-group">
    <label>Feuille de route <span class="text-danger">*</span></label>
    <input type="text" id="u_fr" name="fr" readonly  class="form-control @error('fr') is-invalid @enderror" value="{{ old('fr') }}" required />
</div>