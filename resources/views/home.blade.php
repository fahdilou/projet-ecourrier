@extends('layouts.app')

@section('content')



<script src="{{ asset('assets/js/chart.js') }}"></script>

<!-- Container fluid  -->
        <!-- ============================================================== -->
       
        
            <!-- row -->
            <div class="row">
              <style>
                .rotate-container {
                  overflow: hidden;
                  width: 100%;
                  position: relative;
                }
              
                .card-group {
                  /* Largeur totale du conteneur, assurez-vous d'ajuster cette valeur en fonction du nombre d'éléments .card */
                  width: 2000px;
                  /* Vitesse de défilement ajustée pour créer l'effet de rotation */
                  animation: rotateCards 30s linear infinite;
                }
              
                .card {
                  display: inline-block;
                  width: 200px; /* Ajustez cette valeur selon vos besoins */
                  margin-right: 10px;
                }
              
                .card:last-child {
                  margin-right: 0;
                }
              
                @keyframes rotateCards {
                  0% {
                    /* La valeur utilisée pour la translation (ici 0%) doit être égale à 100% divisé par le nombre d'éléments .card */
                    transform: translateX(20%);
                  }
                  100% {
                    /* La valeur utilisée pour la translation (ici -100%) doit être égale à 100% divisé par le nombre d'éléments .card */
                    transform: translateX(-100%);
                  }
                }
              </style>
              
              
              
              

              <div class="col-lg-12 rotate-card-group" style="
              margin-bottom: 50px;
          ">
                <div class="rotate-container">
                <div class="card-group">
                  <div class="card">
                    <div class="card-body">
                      <span class="
                      btn btn-xl btn-light-info
                      text-info
                      btn-circle
                      d-flex
                      align-items-center
                      justify-content-center
                        ">
                        <i class="fa-solid fa-file-circle-plus"></i>
                                            </span>
                      <h3 class="mt-3 pt-1 mb-0">
                        @php
                              $val1 = 0;
                              $val2 = 0;
                              $val3 = 0;
                              $val4 = 0;
                              $val5 = 0;
                              $val6 = 0;
                          @endphp
                        @for ($i = 0; $i < 12; $i++)
                          @php
                              $val1 += $enregistrerData[$i]
                          @endphp
                       
                        @endfor
                       {{$val1}}
                      </h3>
                      <h6 class="text-muted mb-0 fw-normal">Courrier enrégistré</h6>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <span
                        class="
                          btn btn-xl btn-light-info
                          text-info
                          btn-circle
                          d-flex
                          align-items-center
                          justify-content-center
                        "
                      >
                     
                      <i class="fa-solid fa-spinner"></i>
                      </span>
                      <h3 class="mt-3 pt-1 mb-0">
                        @for ($i = 0; $i < 12; $i++)
                        @php
                            $val2 += $encourData[$i]
                        @endphp
                     
                      @endfor
                     {{$val2}}
                        
                      </h3>
                      <h6 class="text-muted mb-0 fw-normal">Courrier en cours</h6>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <span
                        class="
                        btn btn-xl btn-light-info
                        text-info
                        btn-circle
                        d-flex
                        align-items-center
                        justify-content-center
                        "
                      >
                     
                      <i class="fa-solid fa-check"></i>
                      </span>
                      <h3 class="mt-3 pt-1 mb-0">
                       
                        @for ($i = 0; $i < 12; $i++)
                          @php
                              $val3 += $traiteData[$i]
                          @endphp
                       
                        @endfor
                       {{$val3}}
                        
                      </h3>
                      <h6 class="text-muted mb-0 fw-normal">Courrier traiter</h6>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <span
                        class="
                        btn btn-xl btn-light-success
                        text-success
                        btn-circle
                        d-flex
                        align-items-center
                        justify-content-center
                        "
                      >
                      <i class="fa-solid fa-file-circle-plus"></i>
                      </span>
                      <h3 class="mt-3 pt-1 mb-0">
                     
                        @for ($i = 0; $i < 12; $i++)
                          @php
                              $val4 += $enregistrerData_facture[$i]
                          @endphp
                       
                        @endfor
                       {{$val4}}
                       
                      </h3>
                      <h6 class="text-muted mb-0 fw-normal">Facture enregistrer</h6>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <span
                        class="
                        btn btn-xl btn-light-success
                        text-success
                        btn-circle
                        d-flex
                        align-items-center
                        justify-content-center
                        "
                      >
                     
                      <i class="fa-solid fa-spinner"></i>
                      </span>
                      <h3 class="mt-3 pt-1 mb-0 d-flex align-items-center">
                      
                        @for ($i = 0; $i < 12; $i++)
                          @php
                              $val5 += $encourData_facture[$i]
                          @endphp
                       
                        @endfor
                       {{$val5}}
                        
                      </h3>
                      <h6 class="text-muted mb-0 fw-normal">Facture en cours</h6>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <span
                        class="
                          btn btn-xl btn-light-success
                          text-success
                          btn-circle
                          d-flex
                          align-items-center
                          justify-content-center
                        "
                      >
                    
                      <i class="fa-solid fa-check"></i>
                      </span>
                      <h3 class="mt-3 pt-1 mb-0">
                       
                        @for ($i = 0; $i < 12; $i++)
                          @php
                              $val6 += $traiteData_facture[$i]
                          @endphp
                       
                        @endfor
                       {{$val6}}
                       
                      </h3>
                      <h6 class="text-muted mb-0 fw-normal">Facture traiter</h6>
                    </div>
                  </div>
                </div>
                </div>
              </div>



              <div class="row">
        <div class="col-md-6">
            <h2>Courriers par Mois</h2>
            <canvas id="courriersParMois" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6">
            <h2>Factures par Mois</h2>
            <canvas id="facturesParMois" width="400" height="200"></canvas>
        </div>
    </div>

    
       





                           



              
              <!-- column -->
          
            
              <!-- column -->
          
           



              <!-- column -->
          
              <!-- column -->

             



          
              <!-- column -->
            
              <!-- column -->
            
              <!-- column -->
            
              <!-- column -->
             
              <!-- column -->
              
            </div>
        
          <!-- ============================================================== -->
        
          <script>
        // Récupérer la date actuelle
        const dateActuelle = new Date();

        // Tableau des noms de mois
        const nomsMois = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        // Récupérer le mois actuel (0 pour janvier, 1 pour février, etc.)
        const moisActuel = dateActuelle.getMonth();

        // Créer un tableau des mois jusqu'en décembre de l'année en cours
        const labelsMois = [];
        for (let i = 0; i < 12; i++) { // Commencer à partir de janvier (mois 0)
            labelsMois.push(nomsMois[i]);
        }

        // Données factices représentant le nombre de courriers pour chaque mois
        const Courriers_enregistrer = [{{$enregistrerData[0]}}, {{$enregistrerData[1]}}, {{$enregistrerData[2]}}, {{$enregistrerData[3]}}, {{$enregistrerData[4]}}, {{$enregistrerData[5]}}, {{$enregistrerData[6]}}, {{$enregistrerData[7]}}, {{$enregistrerData[8]}}, {{$enregistrerData[9]}}, {{$enregistrerData[10]}}, {{$enregistrerData[11]}}];
        const Courriers_encour = [{{$encourData[0]}}, {{$encourData[1]}}, {{$encourData[2]}}, {{$encourData[3]}}, {{$encourData[4]}}, {{$encourData[5]}}, {{$encourData[6]}}, {{$encourData[7]}}, {{$encourData[8]}}, {{$encourData[9]}}, {{$encourData[10]}}, {{$encourData[11]}}];
        const Courriers_traite = [{{$traiteData[0]}}, {{$traiteData[1]}}, {{$traiteData[2]}}, {{$traiteData[3]}}, {{$traiteData[4]}}, {{$traiteData[5]}}, {{$traiteData[6]}}, {{$traiteData[7]}}, {{$traiteData[8]}}, {{$traiteData[9]}}, {{$traiteData[10]}}, {{$traiteData[11]}}];
        

        // Données factices représentant le nombre de factures pour chaque mois
        const factures_enregistrer = [{{$enregistrerData_facture[0]}}, {{$enregistrerData_facture[1]}}, {{$enregistrerData_facture[2]}}, {{$enregistrerData_facture[3]}}, {{$enregistrerData_facture[4]}}, {{$enregistrerData_facture[5]}}, {{$enregistrerData_facture[6]}}, {{$enregistrerData_facture[7]}}, {{$enregistrerData_facture[8]}}, {{$enregistrerData_facture[9]}}, {{$enregistrerData_facture[10]}}, {{$enregistrerData_facture[11]}}];
        const factures_encour = [{{$encourData_facture[0]}}, {{$encourData_facture[1]}}, {{$encourData_facture[2]}}, {{$encourData_facture[3]}}, {{$encourData_facture[4]}}, {{$encourData_facture[5]}}, {{$encourData_facture[6]}}, {{$encourData_facture[7]}}, {{$encourData_facture[8]}}, {{$encourData_facture[9]}}, {{$encourData_facture[10]}}, {{$encourData_facture[11]}}];
        const factures_traite = [{{$traiteData_facture[0]}}, {{$traiteData_facture[1]}}, {{$traiteData_facture[2]}}, {{$traiteData_facture[3]}}, {{$traiteData_facture[4]}}, {{$traiteData_facture[5]}}, {{$traiteData_facture[6]}}, {{$traiteData_facture[7]}}, {{$traiteData_facture[8]}}, {{$traiteData_facture[9]}}, {{$traiteData_facture[10]}}, {{$traiteData_facture[11]}}];
        

        // Configuration du graphique
        const configGraphique_courrier = {
            type: 'bar',
            data: {
                labels: labelsMois,
                datasets: [{
                    label: 'Enregistrer',
                    data: Courriers_enregistrer,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'En cours',
                    data: Courriers_encour,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Traités',
                    data: Courriers_traite,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur verte, par exemple.
                    borderColor: 'rgba(75, 192, 192, 1)', // Couleur verte, par exemple.
                    borderWidth: 1
                }]
            },
            
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Configuration du graphique facture
        const configGraphique_facture = {
            type: 'bar',
            data: {
                labels: labelsMois,
                datasets: [{
                    label: 'Enregistrer',
                    data: factures_enregistrer,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'En cours',
                    data: factures_encour,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Traités',
                    data: factures_traite,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Créer le graphique dans le canvas courrier
        const ctx_courrier = document.getElementById('courriersParMois').getContext('2d');
        new Chart(ctx_courrier, configGraphique_courrier);

        // Créer le graphique dans le canvas facture
        const ctx_facture = document.getElementById('facturesParMois').getContext('2d');
        new Chart(ctx_facture, configGraphique_facture);


    </script>  

            
@endsection
