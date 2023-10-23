@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<div class="container-xxl flex-grow-1 container-p-y">

   

    <!---------FIN BREADCRUMB------------------------------------------>



    <div class="d-flex flex-column-fluid">
        {{-- <div class="container-fluid" mettre conatiner-fluid pour plus de largeur > --}}
        <div class="container-fluid">

            <div class="card">
               
                <div class="card-header">  Vue d'un rôle utilisateur</div>
                <div class="card-body">
                    <div class="scroll-area-lg">
                        <div class="scrollbar-container ps--active-y ps" style="max-height: 300px; overflow-y: auto;">
                          <div class="mb-2 col-md-12">
                            <label class="form-label">Nom <span class="text-danger">*</span> </label>
                            <input disabled required type="text" name="name" value="{{ $role->name }}"  id="name"  class="form-control form-control-md @error('name') is-invalid @enderror" style="border-color: #ccc;" onfocus="this.style.borderColor='#1e4db7'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';" onblur="this.style.borderColor='#ccc'; this.style.boxShadow='none';">
                        </div>
                      
                          <div class="divider" style="width: 100%; display: flex; align-items: center; text-align: center; margin-top: 30px;">
                            <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
                            <div class="divider-text" style="margin: 0 10px;">Permissions</div>
                            <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
                          </div>
                          
                      
                          <div class="permissions-container ps" style="margin-top: 30px;">
                            @foreach ($rolePermissions as $roleChunk)
                              <div class="row m-0">
                                @foreach ($roleChunk as $role)
                                  <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <input type="checkbox" checked>
                                      <label class="form-check-label">{{ $role->name }}</label>
                                    </div>
                                  </div>
                                @endforeach
                              </div>
                            @endforeach

                          

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

<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script>
  // Initialisation du plugin PerfectScrollbar
  const ps = new PerfectScrollbar('.ps', {
    suppressScrollX: true, // Supprime la barre de défilement horizontale
  });
</script>


@endpush


@push('extra-modal')


@endpush
