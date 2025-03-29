@php
    use App\Models\Question;
@endphp
<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.job_description')</span></h2>
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
                      <h2>@lang('message.job_description')</h2>
                    </div>
              
            
            @if (sizeof($fascicules) > 0)
              
                  <div class="row portfolio-container">
  
                    @forelse ($fascicules as $fascicule)
  
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp">
                      <div class="portfolio-wrap">
                        <figure class="skeleton-loader" data-loaded="false">
                          <div class="skeleton-item"></div>
                          <img src="{{URL::asset('assets/img/admin/job.jpg')}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
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
                                ?>
                            
                                    <a href="{{URL::asset('storage/'.$fascicule->lien)}}" class="btn btn-primary see" target="_blank">@lang('message.voir_fichier') &nbsp; <i class="bi bi-book"></i></a>
                                    <br>
                                
                                <?php
                                }
                        
                                
                                // dd($cheminFichier);
                                ?>
                                    
    
                                          {{-- </h4> --}}
                                          &nbsp;
                                          &nbsp;  
                                          &nbsp;
                                          {{-- <h4> --}}

                                           @php
                                                  $questions = Question::where('formation_id', $fascicule->id)->first();
                                              @endphp
                                              @if ($questions)
                                                <br>
                                                  <a href="#" class="btn btn-success see" onclick="info({{$fascicule}})">@lang('message.passer_test_btn')</a>
                                                <hr style="color: rgb(88, 16, 197)">
                                              @endif 

                                          
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
                <h3>Catégories de Jobs</h3>
                <ul>
                  @forelse ($cats as $cat)
  
                    <li><strong><a href="{{route('detailsjobs', $cat->slug)}}">{{strtoupper($cat->intitule)}}</a></strong>  
  
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
  
  