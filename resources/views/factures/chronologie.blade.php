@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="{{ asset('assets/css/chronologie.css') }}" />

<!-- partial:index.partial.html -->
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>


<ul class="timeline" id="timeline" style="content: none">
  <!-- Workflows de type "Début" -->
  @foreach($workflowsDebut as $workflow)
        <li class="li {{ $etatsFacture->where('workflow_id', $workflow->id)->isNotEmpty() ? 'complete' : '' }}">
            <div class="timestamp">
              @if (optional($etatsFacture->where('workflow_id', $workflow->id)->first())->date_entree)
                    <span class="author">{{ $etatsFacture->where('workflow_id', $workflow->id)->first()->date_entree }}</span>
                
                @else
                  <span class="author">N.A</span>

                @endif
                @if (optional($etatsFacture->where('workflow_id', $workflow->id)->first())->date_sortie)
                   <span class="date">{{ $etatsFacture->where('workflow_id', $workflow->id)->first()->date_sortie }}</span>
               
                @else
                    <span class="date">N.A</span>
                @endif
            </div>
            <div class="status">
                <h4 style="padding-top: 15px;">{{ $workflow->libelle }}</h4>
            </div>
        </li>
    @endforeach

  <!-- Workflows de type "En cours" -->
  @foreach($workflowsEnCours as $workflow)
    <li class="li {{ $etatsFacture->where('workflow_id', $workflow->id)->isNotEmpty() ? 'complete' : '' }}">
        <div class="timestamp">
          @if (isset($etatsFacture->where('workflow_id', $workflow->id)->first()->date_entree))
              <span class="author">{{ $etatsFacture->where('workflow_id', $workflow->id)->first()->date_entree }}</span>
          
          @else
            <span class="author">N.A</span>

          @endif
          @if (isset($etatsFacture->where('workflow_id', $workflow->id)->first()->date_sortie))
            <span class="date">{{ $etatsFacture->where('workflow_id', $workflow->id)->first()->date_sortie }}</span>
        
          @else
              <span class="date">N.A</span>
          @endif
      </div>
      <div class="status">
          <h4 style="padding-top: 15px;">{{ $workflow->libelle }}</h4>
      </div>
  </li>
  @endforeach

  <!-- Workflows de type "Fin" -->
  @foreach($workflowsFin as $workflow)
      <li class="li {{ $etatsFacture->where('workflow_id', $workflow->id)->isNotEmpty() ? 'complete' : '' }}">
          <div class="timestamp">
            @if (isset($etatsFacture->where('workflow_id', $workflow->id)->first()->date_entree))
                <span class="author">{{ $etatsFacture->where('workflow_id', $workflow->id)->first()->date_entree }}</span>
            
            @else
              <span class="author">N.A</span>

            @endif
            @if (isset($etatsFacture->where('workflow_id', $workflow->id)->first()->date_sortie))
              <span class="date">{{ $etatsFacture->where('workflow_id', $workflow->id)->first()->date_sortie }}</span>
          
            @else
                <span class="date">N.A</span>
            @endif
        </div>
        <div class="status">
            <h4 style="padding-top: 15px;">{{ $workflow->libelle }}</h4>
        </div>
    </li>
  @endforeach
</ul>






@endsection


@push('extra-js')



@endpush



@push('extra-modal')

@endpush
