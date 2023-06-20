@if(session()->has('success'))
    <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row p-5 mb-5">
        <span class="svg-icon me-4 mb-5 mb-sm-0 svg-icon-light bi bi-check-circle-fill"></span>

        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Succès</h4>
            <span>{!! session('success') !!} </span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light bi bi-x-lg"></span>
        </button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-5">
        <span class="svg-icon me-4 mb-5 mb-sm-0 svg-icon-light bi bi-exclamation-circle-fill"></span>

        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Erreur</h4>
            <span>{{ session('error') }}</span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light bi bi-x-lg"></span>
        </button>
    </div>
@endif


@if(session()->has('info'))
    <div class="alert alert-dismissible bg-primary d-flex flex-column flex-sm-row p-5 mb-5">
        <span class="svg-icon me-4 mb-5 mb-sm-0 svg-icon-light bi bi-exclamation-circle-fill"></span>

        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Info</h4>
            <span> {{ session('info') }}</span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light bi bi-x-lg"></span>
        </button>
    </div>
@endif


@if($errors->any())
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-5">
        <span class="svg-icon me-4 mb-5 mb-sm-0 svg-icon-light bi bi-exclamation-circle-fill"></span>

        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Erreur</h4>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light bi bi-x-lg"></span>
        </button>
    </div>
@enderror