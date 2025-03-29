<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.serie') </span></h2>
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.serie') </p> 
  
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
                    <h2>@lang('message.serie')</h2>
                  </div>
          
          
                <div class="row portfolio-container">
  
                  @foreach ($domaines as $domaine)
  
                  <div class="col-lg-4 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp">
                    <div class="portfolio-wrap">
                      <figure class="skeleton-loader" data-loaded="false">
                        <div class="skeleton-item"></div>
                        <img src="{{URL::asset('assets/img/admin/books1.jpg')}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
                      </figure>
          
                      <div class="portfolio-info">
                        <h4><a href="{{route('detailsseries', $domaine->slug)}}" class="btn btn-primary voir-plus"> Afficher les catégories </a></h4>
                        <p>{{ucfirst($domaine->intitule)}}</p>
                      </div>
                    </div>
                  </div>
  
                  @endforeach
                    
  
        
    
                  
          
        
                </div>
          
                {{$domaines->links('pagination::bootstrap-4')}}
      
        
                </div>
              </section><!-- End Portfolio Section -->
        
  
            
          </div>
  
          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Domaines récents</h3>
              <ul>
  
                  @forelse ($cats as $domaine)
                  <li><strong><a href="{{route('detailsseries', $domaine->slug)}}">{{strtoupper($domaine->intitule)}}</a></strong>
                    
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
  