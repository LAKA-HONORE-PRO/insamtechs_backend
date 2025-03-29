<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.bibliotheque') </span></h2>
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
                      <h2>@lang('message.bibliotheque')</h2>
                    </div>
              
            
            @if (sizeof($livrescat) > 0)
              
                  <div class="row portfolio-container">
  
                    @forelse ($livrescat as $livre)
  
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp">
                      <div class="portfolio-wrap">
                        <figure class="skeleton-loader" data-loaded="false">
                          <div class="skeleton-item"></div>
                          <img src="{{URL::asset('assets/img/admin/book2.jpg')}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
                        </figure>
            
                        <div class="portfolio-info">
                          <h4><a href="{{route('detailslivre', ['slug'=>$livre->slug, 'lang'=>$lang])}}" class="btn btn-primary voir-plus"> Détails du livres </a></h4>
                          <p>{{ucfirst($livre->intitule)}}</p>
                        </div>
                      </div>
                    </div>
  
                    @empty
                      
  
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                      <h4 style="color: rgb(88, 16, 197); font-size:14px">@lang('message.aucun_element') !</h4>
                    </div>
                    
                    @endforelse
            
    
                  </div>

                 {{-- {{$categories->links('pagination::bootstrap-4')}} --}}
            
         
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
                <h3>@lang('message.categories_livres')</h3>
                <ul>
                  @forelse ($cats as $cat)
  
                    <li><strong><a href="{{route('detailbibliotheque', $cat->slug)}}">{{strtoupper($cat->intitule)}}</a></strong>  
  
                  @empty        
  
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                      <h4 style="color: rgb(88, 16, 197); font-size:14px">@lang('message.aucun_element') !</h4>
                    </div>
  
                  @endforelse
            
                </ul>
              </div>
              
  
              <div class="portfolio-info">
                <h3>@lang('message.derniers_livres')</h3>
                <ul>
  
                  @forelse ($livres as $item)
  
                      <li><strong><a href="{{route('detailslivre', $item->slug)}}">{{strtoupper($item->intitule)}}</a></strong>            
  
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
  
  