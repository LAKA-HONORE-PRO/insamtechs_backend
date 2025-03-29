@php
    use App\Models\Question;
@endphp


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulaire de soumission.</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="d-flex flex-column gap-4" action="{{route('composer_fascicule_pdf.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" class="form-control" name="booklet_id" id="booklet_id" value="">
          <input type="text" class="form-control" name="user_id" id="user_id" value="{{Auth::user()->id}}">
         
          <div class="">
            <label for="booklet_link">Noms</label>
            <input type="text" class="form-control" name="nom" value="{{strtoupper(Auth::user()->nom)}}" id="" readOnly>
          </div>


          <div class="">
            <label for="booklet_link">Prénoms</label>
            <input type="text" class="form-control" name="nom" value="{{strtoupper(Auth::user()->prenom)}}" id="" readOnly>
          </div>


          <div class="">
            <label for="booklet_link">Sélectionnez le fichier <sup style="color:red">*</sup></label>
           <input type="file" class="form-control" name="booklet_file" accept=".pdf" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-success">Sauvegarder</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.fascicule')</span></h2>
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / {{ ucfirst($categorie->intitule) }} </p> 
  
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
            </div>
          </div>
        </div>
  
      </div>
    </div>
</section><!-- End Hero -->


  
  <main id="main">

  
      <!-- ======= Portfolio Details Section ======= -->
      <section id="portfolio-details" class="portfolio-details">
        <div class="container-fluid">
  
          <div class="row gy-4">
  
            <div class="col-lg-9">
              <a href="#" onclick="goBack()" style="font-size: 20px">
                <i class="bi bi-arrow-left"></i> Retour
              </a>
  
  
              <section id="portfolio" class="section-bg ">
                  <div class="container">
  
                    
                    <div class="section-title" >
                      <h2>@lang('message.fascicule')</h2>
                    </div>
              
            
            @if (sizeof($fascicules) > 0)
              
                  <div class="row portfolio-container">

                  @php
                    $i = 0;
                  @endphp
  
                    @forelse ($fascicules as $fascicule)
                  @php
                    $i = $i + 1;
                  @endphp
  
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp">
                      <div class="portfolio-wrap">
                        <figure class="skeleton-loader" data-loaded="false">
                          <div class="skeleton-item"></div>
                          <img src="{{URL::asset('assets/img/admin/dossier1.jpg')}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
                        </figure>
            
                        <div class="portfolio-info">
                            <?php
                                 $mot = $fascicule->lien;
    
                                if (str_contains($mot, "http")) {
                                ?> 
                                
                                {{--<a href="{{route('telecharger_fichier', $fascicule->slug)}}" target="_blank" class="btn btn-primary see">@lang('message.voir_fichier')</a>--}}
                                
                                <a href="{{$fascicule->lien}}" target="_blank" class="btn btn-primary see">@lang('message.voir_fichier') &nbsp; <i class="bi bi-book"></i></a>
                                <br>
                                
                                <?php
                                } else {

                                  if($fascicule->etat === 1){

                                    ?>
                                    
                                    <div class="d-flex flex-row gap-2 justify-content-center">
                                      <a href="{{URL::asset('storage/'.$fascicule->lien)}}" class="btn btn-primary see" target="_blank">Voir l'épreuve &nbsp; <i class="bi bi-book"></i></a>
                                      
                                      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $fascicule->id }}">Téléverser un PDF &nbsp; <i class="bi bi-pdf"></i></button>
                                    </div>
                                    <br>
                                
                                    <?php
                                  }
                                }
                        
                                
                                // dd($cheminFichier);
                                ?>
                                    
    
                                          {{-- </h4> --}}
                                          &nbsp;
                                          &nbsp;  
                                          &nbsp;
                                          {{-- <h4> --}}
                                                <!-- @php
                                                    $questions = Question::where('formation_id', $fascicule->id)->first();
                                                @endphp
                                                @if ($questions)
                                                  <br>
                                                    {{-- <a href="#" class="btn btn-success see" onclick="info({{$fascicule}})">@lang('message.passer_test_btn')</a> --}}
                                                  <hr style="color: rgb(88, 16, 197)">
                                                @endif -->
                                            
                          <p>{{ucfirst($fascicule->intitule)}}</p>
                        </div>
                      </div>
                    </div>
  
                    @empty
                      
  
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                        <h4 style="color: rgb(88, 16, 197)">@lang('message.aucun_fascicule')</h4>
                    </div>
                    
                    
                    @endforelse
            
    
                  </div>

                  {{$fascicules->links('pagination::bootstrap-4')}}
            
                  </div>
            @else
              
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <h4 style="color: rgb(88, 16, 197); font-size:14px">@lang('message.aucun_element') !</h4>
            </div>
            @endif
              
              </section>
          
  
              
            </div>
  
            <div class="col-lg-3">
              <div class="portfolio-info">
                <h3>Catégories de Fascicules</h3>
                <ul>
                  @forelse ($cats as $cat)
  
                    <li><strong><a href="{{route('detailsfascicule', $cat->slug)}}">{{strtoupper($cat->intitule)}}</a></strong>  
  
                  @empty        
  
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                      <h4 style="color: rgb(88, 16, 197); font-size:14px">@lang('message.aucun_element') !</h4>
                    </div>
  
                  @endforelse
            
                </ul>
              </div>
              
  
  
            </div>
  
  
          </div>
  
        </div>
      </section><!-- End Portfolio Details Section -->
  
  </main>
  

