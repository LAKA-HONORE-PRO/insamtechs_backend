@php
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
            <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.mes_formations') </span></h2>
            <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.mes_formations')</p> 

            <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
          </div>
        </div>
      </div>



    </div>


  </div>
</section><!-- End Hero -->



<section id="services" class="services">
  <div class="container">



    <div class="row gy-5">



      
    @forelse ($mes_formations as $mes_formation)

      @php
        $formation = Formation::find($mes_formation->formation_id);
      @endphp

    
        <div class="col-xl-4 col-md-6">
          <div class="service-item">
            <div class="img">
              <img src="{{URL::asset('assets/img/admin/categorie_mesformations.png')}}" class="img-fluid" alt="">
            </div>
            <div class="details position-relative">
              <div class="icon">
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <a href="{{route('formation', $formation->slug)}}" class="stretched-link">
                <h3>{{ucfirst($formation->intitule)}}</h3>
              </a>
              <p>{{ucfirst($formation->description)}}</p>
              <div class="d-flex justify-content-center align-items-center" style="margin-top:10px">
                <a href="{{route('formation', $formation->slug)}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center;"> @lang('message.commencer') </a>
              </div>
            </div>
          </div>
        </div>  
          
    @empty

    <div class="col-lg-12 d-flex align-items-center justify-content-center">
      <h4 style="color:rgb(88, 16, 197)"> Vous n'avez aucune formation pour le moment !</h4>
    </div>
      
    @endforelse
<!-- End Service Item -->

      
    </div>

  </div>
</section><!-- End Services Section -->






<section id="teamer" class="teamer section-bg">
  <div class="container">

    
    <div class="section-title" >
      <h2>
            @if (sizeof($paniers) > 0)
                @lang('message.formations_associees')
            @else
                @lang('message.formation_interessante')
            @endif
                
      </h2>
    </div>
    <div class="row">


        @if (sizeof($formations) > 0)

            @forelse ($formations as $formation_interessante)

            @php

              $videos = DB::table('videos')
                ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                ->join('formations', 'formations.id', '=', 'chapitres.formation_id')
                ->where(['formations.id'=> $formation_interessante->id])
                ->select('videos.*')
                ->get();
            @endphp

                @if (sizeof($videos) > 0)

                  <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                      <div class="member-img">
                        <img src="{{URL::asset('assets/img/admin/categorie.jpg')}}" class="img-fluid" alt="">
                      </div>
                      <div class="member-info">
                        <h4>{{ucfirst($formation_interessante->intitule)}}</h4>
                        <span><a href="{{route('formation', $formation_interessante->slug)}}">@lang('message.detail_autres') &nbsp; <i class="bi bi-arrow-right"></i></a></span>
                      </div>
                    </div>
                  </div>

                @endif

            @empty
              
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
              <h4>@lang('message.aucun_element') !</h4>
            </div>
            @endforelse






        @endif


    </div>

  </div>
</section><!-- End teamer Section -->



<div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
  <a href="{{route('videotheque')}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "> @lang('message.trouver_autres_formation') &nbsp; <i class="bi bi-arrow-right"></i></a>
</div>
<br>
<br>