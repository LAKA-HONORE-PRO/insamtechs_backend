  @php
  use App\Models\Video;
  use App\Models\Formation;
  use App\Models\Commander;
  use App\Models\Chapitre;
  use App\Models\Confirmation;
  use Illuminate\Support\Facades\DB;
  @endphp

  {{-- Formulation de validation des acquis --}}

  <!-- Fenêtre modale pour validation des acquis -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- En-tête de la fenêtre modale -->
        <div class="modal-header">
          {{-- <h5 class="modal-title" id="myModalLabel">Ma fenêtre modale</h5> --}}
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        
        <!-- Contenu du formulaire -->
        <div class="modal-body">
          <form id="form">
            @csrf

            <input type="hidden" name="idvideo" id="idvideo" value=" ">
            <input type="hidden" name="formation_id" id="formation_id" value="{{$formation->id}}">

            <div class="form-check">
              <label class="form-check-label" for="checkbox1"> Avez vous parcouru intégralement la vidéo ? </label>

              <input class="form-check-input" type="checkbox" id="checkbox1" value="" name="checkbox1">
            </div>


            <div class="form-check">
              <label class="form-check-label" for="checkbox2"> Avez vous eu des difficultés à appréhender les compétences à acquérir ? </label>

              <input class="form-check-input" type="checkbox" id="checkbox2" value="" name="checkbox2">
            </div>

            <div class="form-check">
              <label class="form-check-label" for="checkbox3">Avez vous besoin d’assistance pour mieux appréhender lesdites compétences ? </label>

              <input class="form-check-input" type="checkbox" id="checkbox3" value="" name="checkbox3">
            </div>

            <br>
            <div class="form-group">
              <label class="form-check-label" for="observation">Observation</label>

              <textarea class="form-control" name="observation" id="observation" cols="30" rows="5"></textarea>
            </div>

            <br>  
            <div class="d-flex justify-content-end align-items-end">
              <input type="submit" value="Soumettre" class="btn btn-primary text-align-end justify-content-end" id="soumettre">
            </div>

          </form>
        </div>
        
        <!-- Pied de la fenêtre modale -->
        <div class="modal-footer">
        <p>Vous ne pourrez obtenir votre attestation de formation que lorsque vous aurez validé les acquis de toutes les vidéos de la formation en cours!</p>

          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> --}}
        </div>
      </div>
    </div>
  </div>

  @auth
      <!--modale pour update nom et prenom-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('update_profil_for_attestation')}}" autocomplete="off">
            @csrf 
              <input type="hidden" name="formation_id" value="{{$formation->id}}">
              <input type="hidden" name="nationalite" value="">
              <input type="hidden" name="phone" value="">
              <input type="hidden" name="email" value="">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nom de l'apprenant:</label>
              <input type="text" class="form-control" id="name" name="nom" value="{{strtoupper(Auth::user()->nom)}}" required>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Prénom de l'apprenant:</label>
              <input type="text" class="form-control" id="surname" name="prenom" value="{{strtoupper(Auth::user()->prenom)}}">
            </div>

            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Enegistrer">
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  @endauth
  {{-- Fin formulaire de validation des acquis --}}

  <section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>

      <div class="carousel-inner_other" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other col-sm-10 col-md-12 col-lg-6 col-xl-12">
              {{-- <h2 class="animate__animated animate__fadeInDown"><span> {{ucfirst($formation->intitule)}} </span></h2> --}}
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / {{ucfirst($formation->intitule)}} </p> 

              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
            </div>
          </div>
        </div>



      </div>


    </div>
  </section><!-- End Hero -->



  <main id="main">
    <div class="loader-bg">
      <div class="loader">

      </div>

    </div>  
      <!-- ======= Portfolio Details Section ======= -->
      <section id="portfolio-details" class="portfolio-details">
        <div class="container-fluid">

          <div class="row gy-4">

            <div class="col-lg-9">
            

                  <div class="container-fluid">

                      
                      <div class="embed-responsive embed-responsive-16by9" style="height: 400px">

                      
                        <!-- <img src="assets/img/admin/books1.jpg" alt=""> -->
                        @if($premiere_video->lien !== 'null')
                        <iframe style="height: 100%" class="w-100 embed-responsive-item" src="{{$premiere_video->lien}}" title="YouTube video player" frameborder="0" allowfullscreen allow="autoplay; encrypted-media" 
    sandbox="allow-same-origin allow-scripts"></iframe> 
                        @else
                        <iframe style="height: 100%" class="w-100 embed-responsive-item" src="" title="YouTube video player" frameborder="0" allowfullscreen>
                          <span style="color: red">Aucune vidéo à afficher pour le moment.</span>
                          </iframe> 
                        @endif
                      <h4 id="titr" style="color: #4924c2; font-weight:bold; font-size:25px"></h4> 
                      </div>

                  </div>

                  <style>
                  .custom-grayed-out {
                        color: #999999; /* Couleur de texte grisé */
                        opacity: 0.6; /* Opacité réduite pour l'effet de grisage */
                        pointer-events: none; /* Désactive les événements de clic sur les éléments */
                    }

                    .custom-grayed-out-2 {
                        color: #0f70b6; /* Couleur de texte grisé */
                        opacity: 0.6; /* Opacité réduite pour l'effet de grisage */
                        pointer-events: none; /* Désactive les événements de clic sur les éléments */
                    }
                  </style>



              <section id="faq" class="faq">
                <div class="container" >
                  
                  <div class="section-title" >
                    <h2>Contenu du cours</h2>
                  </div>
            
          
                  <ul class="faq-list">


                    <li class="disabled-link">
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq1"> {{ucfirst(Chapitre::find($premiere_video->chapitre_id)->intitule)}} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                      
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                          <br>
                          <ul>
                            @php
                                  $all = Video::where('chapitre_id', $premiere_video->chapitre_id)->get();
                            @endphp
                            @forelse($all as $item)
                                <li>
                                  <a href="#" class="item" data-value="{{URL::asset('storage/'. $item->lien )}}" data-titre="{{ucfirst($item->intitule)}}">{{ucfirst($item->intitule)}}</a>

                                @auth
                                  @php
                                    $confirmation = Confirmation::where(['video_id'=>$item->id, 'user_id'=>Auth::user()->id])->first();
                                  @endphp

                                  @if($confirmation === null)
                                      <a href="#" style="color: rgb(88, 16, 197)" aria-id="{{$item->id}}" class="validate" data-bs-toggle="modal" data-bs-target="#myModal">Validation des acquis</a>
                                  @endif
                                @endauth
                                </li>
                            @empty

                            @endforelse
                          </ul>
                        </div>

                      </li>


                      {{-- Si déconnecté --}}

                    @guest

                              @if (sizeof($chapitres) > 0)

                              @php
                                $i = 1;
                              @endphp
              
                              @forelse ($chapitres as $chapitre)
              
                                  @php
                                  $i = $i + 1;
                                  @endphp
              
                              <li class="disabled-link custom-grayed-out">
                                <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{$i}}"> {{ucfirst(trim($chapitre->titre, '"'))}} <i class="bi bi-lock icon-lock"></i></div>
                              
                                <div id="faq{{$i}}" class="collapse" data-bs-parent=".faq-list">
                                  <br>
                                  <ul>
                                      <li>
                                          <a href="#">Validation des acquis</a>
                                        </li>
                                  </ul>
                                </div>
              
                              </li>
              
                                
                              @empty
                                
                              @endforelse
              
                            @endif
                      
                    @endguest

                      {{-- Fin Si déconnecté --}}

                {{-- Si connecté--}}

                  @auth

                  @if (sizeof($chapitres) > 0)

                      @php
                        $activation = Commander::where(['user_id'=>Auth::user()->id, 'formation_id'=>$formation->id])->first();  
                      @endphp

                            @if ($activation === null)

                                      @if (sizeof($chapitres) > 0)

                                          @php
                                            $i = 1;
                                          @endphp
                          
                                          @forelse ($chapitres as $chapitre)
                                              @php
                                                $i = $i + 1;
                                              @endphp
                          
                                          <li class="disabled-link custom-grayed-out">
                                            <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{$i}}"> {{ucfirst(trim($chapitre->titre, '"'))}} <i class="bi bi-lock icon-lock"></i></div>
                                          
                                            <div id="faq{{$i}}" class="collapse" data-bs-parent=".faq-list">
                                              <br>
                                              <ul>
                                                    <li>
                                                      <a href="#">Validation des acquis</a>
                                                    </li> 
                                              </ul>
                                            </div>
                          
                                          </li>
                          
                                            
                                          @empty
                                            
                                          @endforelse
                      
                                    @endif
          
                              @else

                                  @if ($activation->etat_commande === 0)

                                                        @if (sizeof($chapitres) > 0)

                                                              @php
                                                                $i = 1;
                                                              @endphp
                                              
                                                              @forelse ($chapitres as $chapitre)
                                              
                                                                  @php
                                                                  $i = $i + 1;
                                                                  @endphp
                                              
                                                                  <li class="disabled-link custom-grayed-out">
                                                                    <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{$i}}"> {{ucfirst(trim($chapitre->titre, '"'))}} <i class="bi bi-lock icon-lock"></i></div>
                                                                  
                                                                    <div id="faq{{$i}}" class="collapse" data-bs-parent=".faq-list">
                                                                      <br>
                                                                      <ul>
                                                                            <li>
                                                                              <a href="#">Validation des acquis</a>
                                                                            </li>
                                                                      </ul>
                                                                    </div>
                                                  
                                                                  </li>
                                              
                                                                
                                                                @empty
                                                                
                                                              @endforelse
                                              
                                                      @endif
                                      @else


                                      
                                                @if (sizeof($chapitres) > 0)

                                                @php
                                                  $i = 1;
                                                @endphp
                                
                                                @forelse ($chapitres as $chapitre)
                                
                                                    @php
                                                    $i = $i + 1;

                                                      $videos = Video::where('chapitre_id', $chapitre->id)->get();

                                                      $videos_count = Video::where('chapitre_id', $chapitre->id)->count();

                                                      $confirmation_count = DB::table('confirmations')
                                                        ->join('videos', 'videos.id', '=', 'confirmations.video_id')
                                                        ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                                                        ->where(['chapitres.id'=> $chapitre->id])
                                                        ->count();



                                                          //echo $videos_count;
                                                          //echo $confirmation_count;

                                                    @endphp
                                
                                                <li>
                                                  <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{$i}}"> {{ucfirst(trim($chapitre->titre, '"'))}} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                                
                                                  <div id="faq{{$i}}" class="collapse" data-bs-parent=".faq-list">
                                                    <br>

                                                    @if (sizeof($videos) > 0)
                                                  
            
                                                    <ul>
                                                      @forelse ($videos as $video)
                                                      @php
                                                        $confirmation = Confirmation::where(['video_id'=>$video->id, 'user_id'=>Auth::user()->id])->first();
                                                      @endphp

                                                            <li>
                                                              <a href="#" class="disabled-link custom-grayed-out-2">{{ucfirst($video->intitule)}}</a>

                                                              @if ($confirmation === null)
                                                              <a href="#" style="color: rgb(88, 16, 197)" aria-id="{{$video->id}}" class="validate" data-bs-toggle="modal" data-bs-target="#myModal">Validation des acquis</a>
                                                              @endif

                                                            </li>
                                                      @empty
                                                        
                                                      @endforelse

                                                    </ul>
                                                      
                                                    @endif

                                                  </div>
                                
                                                </li>
                                

                                                @php 
                                                $count = DB::table('videos')
                                                  ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                                                  ->where(['chapitres.formation_id'=> $formation->id])
                                                  ->count();
                              
                                                  $count_confirmation = Confirmation::where(['user_id'=>Auth::user()->id, 'formation_id'=>$formation->id])->count();
                              
                                                @endphp
                              
                                                @if($count === $count_confirmation)                          
                                                <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                                                    <a href="#" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-heart-fill"></i> &nbsp; @lang('message.obtenir_attestation') </a>
                                                </div>
                                                @endif
                                                                                                  
                                                @empty
                                                  
                                                @endforelse
                                
                                              @endif
                                
                                    
                                  @endif

                      
                            @endif


                    @endif



                  @endauth


    
              {{--Fin  Si connecté --}}
        
    
          
                  </ul>
          
                </div>
              </section>



            </div>

            <div class="col-lg-3">


              
              <div class="portfolio-info">
                <h3>Description</h3>
                  <p class="justify-text">
                    {{ucfirst($formation->description)}}
                  </p>
              </div>
              <div class="d-flex justify-content-center align-items-center" style="margin-top:20px; margin-bottom:20px">
                <h4 style="font-style: italic; font-size:20px; color : white; background-color:#f39200; padding:10px"> NB : @lang('message.formation_distribuee_en') {{ucfirst($formation->langue_formation)}}</h4>
              </div>


              <div class="portfolio-info">

                <h3>@lang('message.dernieres_formations')</h3>
                <ul>
                  @foreach ($formations as $form)
                      @php
                      $forms = DB::table('videos')
                              ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                              ->join('formations', 'formations.id', '=', 'chapitres.formation_id')
                              ->where(['formations.id'=> $form->id])
                              ->select('videos.*')
                              ->first();
                    @endphp

                    @if ($forms != null)
                      <li><strong><a href="{{route('formation', $form->slug)}}">{{ucfirst($form->intitule)}}</a></strong>
                    @endif


                  @endforeach
                </ul>
              </div>



              @auth
                @php
                  $commander = Commander::where(['user_id'=>Auth::user()->id, 'formation_id'=>$formation->id])->first();  
                @endphp
              @endauth


              @auth
                    <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                      <a href="@if($commander != null){{route('panier')}}@else {{route('create_commande', $formation->slug)}} @endif" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "> &nbsp; @if($commander != null) <i class="bi bi-cart4"></i> Voir le panier   @else <i class="bi bi-heart-fill"></i> @lang('message.je_commande') @endif</a>
                    </div>
              @endauth
            @guest
                <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                    <a href="{{route('create_commande', $formation->slug)}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "><i class="bi bi-heart-fill"></i> &nbsp; @lang('message.je_commande') </a>
                </div>
            @endguest


            
          </div>

        </div>
      </section>

    </main>

