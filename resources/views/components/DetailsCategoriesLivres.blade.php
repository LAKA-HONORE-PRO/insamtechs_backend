<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              {{-- <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.bibliotheque') </span></h2> --}}
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / {{ucfirst($categorie->intitule)}} </p> 
  
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
              

                    <form action="{{ route('details_categorie_bibliotheque_search', ['slug'=>$categorie->slug]) }}" method="GET" autocomplete="off">
                      <div class="input-group">
                          <input type="text" class="form-control" name="search" placeholder="Rechercher..." value="<?php if(!empty($search)){echo $search;}?>">
                          <input type="hidden" name="lang" value="{{ $lang }}">
                          <div class="input-group-append">
                              <button class="btn btn-secondary" type="submit">Rechercher</button>
                          </div>
                      </div>
                  </form>
    
                  <br>
                  <br>
            
            
                  <div class="row portfolio-container">
  
                    @forelse ($livres as $livre)
  
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
                      <h4 style="color: rgb(88, 16, 197);">@lang('message.aucun_element') !</h4>
                    </div>
                    
                    @endforelse
            
                  </div>

                  {{-- {{$livres->links('pagination::bootstrap-4')}} --}}
                  
          
                  </div>
              </section>
          
  
              
            </div>
  
            <div class="col-lg-3">
              <div class="portfolio-info">
                <h3>@lang('message.categories_livres')</h3>
                <ul>
                  @forelse ($cats as $cat)
  
                    <li><strong><a href="{{route('detailscategorieslivres', ['slug'=>$cat->slug, 'lang'=>$lang])}}">{{strtoupper($cat->intitule)}}</a></strong>  
  
                  @empty        
  
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                      <h4 style="color: rgb(88, 16, 197);">@lang('message.aucun_element') !</h4>
                    </div>
  
                  @endforelse
            
                </ul>
              </div>
              

              {{-- @auth
                <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                  <a href="#" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "><i class="bi bi-heart-fill"></i> &nbsp; @lang('message.je_commande') </a>
                </div>
              @endauth
              @guest
                <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                    <a href="{{route('auth.login')}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "><i class="bi bi-heart-fill"></i> &nbsp; @lang('message.je_commande') </a>
                </div>
              @endguest --}}
  
  
            </div>
  
  
          </div>
  
        </div>
      </section><!-- End Portfolio Details Section -->
  
  </main>
  
  