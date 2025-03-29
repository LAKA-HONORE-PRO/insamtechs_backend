@php
  use App\Models\Chapitre;
  use App\Models\Video;
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
            {{-- <h2 class="animate__animated animate__fadeInDown"><span> {{ucfirst($categorie->intitule)}} </span></h2> --}}
            <p class="animate__animated animate__fadeInDown">@lang('message.home') / {{ucfirst($categorie->intitule)}}</p> 

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

            @if (sizeof($formations) > 0)

            <section id="portfolio" class="section-bg ">
                <div class="container">


                  <div class="section-title" >
                    <h2>@lang('message.toutes_les_formations')</h2>
                  </div>

                  <form action="{{ route('details_categorie_videotheque_search', ['slug'=>$categorie->slug]) }}" method="GET" autocomplete="off">
          
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Rechercher..." value="<?php if(!empty($search)){echo $search;}?>">
                        <input type="hidden" value="{{ $lang }}" name="lang">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
          
                 <br>
                 <br>
            
          
          
                <div class="row portfolio-container  element">
                        
                            @forelse ($formations as $formation)
                              

                              
                              @php
                                    $chapitre = Chapitre::where('formation_id', $formation->id)->first();
                                    

                                    $count = DB::table('videos')
                                          ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                                          ->where(['chapitres.formation_id'=> $formation->id])
                                          ->count();
                                  
                              @endphp

                              <div class="col-lg-4 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp ">
                                <div class="portfolio-wrap">
                                  <figure class="skeleton-loader" data-loaded="false">
                                    <div class="skeleton-item"></div>
                                    <img src="{{URL::asset('storage/'.$formation->img)}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
                                  </figure>

                                @if($chapitre)

                                    @php

                                      $video = video::where('chapitre_id', $chapitre->id)->first();

                                    @endphp

                                @if($video)
                                    <div class="portfolio-info" >
                                      <h4 style="color: #0f6db2" class="p-3"> {{ $count }} @lang('videos')</h4>
                                      <h4><a href="{{route('formation', $formation->slug)}}" class="btn btn-primary voir-plus"> @lang('message.commencer') </a></h4>
                                    <!-- <p class="data">{{ucfirst($formation->intitule)}}</p> -->
                                    </div>
                                @else
                                    <div class="portfolio-info" >
                                      <h4 style="color: #0f6db2" class="p-3"> {{ $count }} @lang('videos')</h4>
                                      <h4><a href="#" class="btn btn-primary voir-plus"> @lang('message.aucun_element') </a></h4>
                                    <!-- <p class="data">{{ucfirst($formation->intitule)}}</p> -->
                                    </div>
                                @endif


                                @else
                                    
                                <div class="portfolio-info" >
                                  <h4 style="color: #0f6db2" class="p-3"> {{ $count }} @lang('videos')</h4>
                                  <h4><a href="{{route('formation', $formation->slug)}}" class="btn btn-primary voir-plus"> Aucun chapitre pour le moment </a></h4>
                                <!-- <p class="data">{{ucfirst($formation->intitule)}}</p> -->
                                </div>

                                @endif
                                
                                </div>
                              </div>  
                             @empty 


                                <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                  <h4 style="color: rgb(88, 16, 197);">@lang('message.aucun_element') !</h4>
                                </div>
                  
                            @endforelse


                </div>
                
          
                    <ul class="pagination">
                      {{$formations->links('pagination::bootstrap-4')}}
                    </ul>
  
          

              </section>

              
              <!-- End Portfolio Section -->
        
              @else

              <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <h4 style="color: rgb(88, 16, 197);">@lang('message.aucun_element') !</h4>
              </div>
                

              @endif
            
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>@lang('message.autres_categories')</h3>
              <ul>
                @foreach ($cats as $cat)
                  <li><strong><a href="{{route('details', ['slug'=>$cat->slug, 'lang'=>$lang])}}">{{ strtoupper($cat->intitule) }}</a></strong>
                @endforeach
              </ul>
            </div>
            

            <div class="portfolio-info">
              <h3>@lang('message.dernieres_formations')</h3>
              <ul>
                  @if (sizeof($formats) > 0)
                  
                            @foreach ($formats as $form)

                              
                            @php
                            $forms = DB::table('videos')
                                    ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
                                    ->join('formations', 'formations.id', '=', 'chapitres.formation_id')
                                    ->where(['formations.id'=> $form->id])
                                    ->select('videos.*')
                                    ->first();
                          @endphp

                              @if ($forms != null)

                                  <li><strong><a href="{{route('formation', $form->slug)}}">{{strtoupper($form->intitule)}}</a></strong>

                              @endif
                            @endforeach
                    @endif  
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

</main>
