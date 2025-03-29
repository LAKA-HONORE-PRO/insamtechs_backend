@php
use Illuminate\Support\Facades\DB;
use App\Models\Formation;
@endphp


<section id="hero_other">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>

    <div class="carousel-inner_other" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item_other active">
        <div class="carousel-container_other">
          <div class="container_other">
            <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.videotheque') </span></h2>
            <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.videotheque')</p> 

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
                    <h2>@lang('message.videotheque')</h2>
                  </div>
          


                  <form action="{{ route('categorie_videotheque_search', ['lang'=>$lang]) }}" method="GET" autocomplete="off">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Rechercher..." value="<?php if(!empty($search)){echo $search;}?>">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
          
                 <br>
                 <br>


                <div class="row portfolio-container">

                  @forelse ($categories as $categorie)

                  
            @php
              $count = Formation::where('categorie_id', $categorie->id)->count();
            @endphp

                  <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                      <figure class="skeleton-loader" data-loaded="false">
                        <div class="skeleton-item"></div>
                        <img src="{{URL::asset('storage/'.$categorie->img)}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
                      </figure>
                      
                      <div class="portfolio-info">
                        <h4 style="color: #0f6db2" class="p-3"> {{ $count }} @lang('message.formations')</h4>
                        <h4><a href="{{route('details', ['slug'=>$categorie->slug, 'lang'=>'fr'])}}" class="btn btn-primary voir-plus" style="width: 200px"> @lang('message.afficher_les_formations') </a></h4>
                      </div>
                    </div>
                  </div>
                  @empty

                  <div class="col-lg-12 d-flex align-items-center justify-content-center">
                    <h4 style="color: rgb(88, 16, 197); font-size:14px">@lang('message.aucun_element') !</h4>
                  </div>

                  @endforelse
                    

        
    
                  
          
        
                </div>
          
                {{$categories->links('pagination::bootstrap-4')}}
      
        
                </div>
              </section><!-- End Portfolio Section -->
        

            
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Catégories récentes</h3>
              <ul>

                  @forelse ($cats as $categorie)
                  <li><strong><a href="{{route('details', ['slug'=>$categorie->slug, 'lang'=>$lang])}}">{{strtoupper($categorie->intitule)}}</a></strong>
                    
                  @empty
                  <div class="col-lg-12 d-flex align-items-center justify-content-center">
                    <h4 style="color: rgb(88, 16, 197); font-size:14px">@lang('message.aucun_element') !</h4>
                  </div>
                  @endforelse
         
              </ul>
            </div>
            

            <div class="portfolio-info">
              <h3>Dernières formations</h3>
              <ul>
                  
                  @forelse ($formations as $formation)
                    

                  
                  @php
                      $forms = DB::table('videos')
                              ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                              ->join('formations', 'formations.id', '=', 'chapitres.formation_id')
                              ->where(['formations.id'=> $formation->id])
                              ->select('videos.*')
                              ->first();
                  @endphp

                    @if ($forms != null)


                     <li><strong><a href="{{route('formation', $formation->slug)}}">{{strtoupper($formation->intitule)}}</a></strong>


                      @endif
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
