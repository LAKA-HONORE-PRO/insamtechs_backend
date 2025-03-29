@php
use App\Models\Video;
use App\Models\Commander;
use App\Models\Formation;
@endphp

<section id="portfolio" class="section-bg ">
    <div class="container">

      <div class="section-title" >
        <h2>@lang('message.notre_bibliotheque')</h2>
      </div>




      <div class="row portfolio-container">


      @forelse ($livres as $cat)

      
      @php
        $count = Formation::where('categorie_id', $cat->id)->count();
      @endphp

          <div class="col-lg-4 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp">
            <div class="portfolio-wrap">
              <figure class="skeleton-loader" data-loaded="false">
                <div class="skeleton-item"></div>
                <img src="{{URL::asset('assets/img/admin/book2.jpg')}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
              </figure>

              <div class="portfolio-info">
               {{-- <h4 style="color: #0f6db2" class="p-3"> {{ $count }} @lang('message.livres')</h4> --}} 

                    <h4>
                      <a href="{{route('detailscategorieslivres', ['slug'=>$cat->slug, 'lang'=>'fr'])}}" class="btn btn-primary voir-plus">@lang('message.parcourir_categorie')</a>
                    </h4>
                <p>{{ ucfirst($cat->intitule) }} ({{ $count }} @lang('message.livres'))</p>
              </div>
            </div>
          </div>
        
      @empty
      <div class="col-lg-12 d-flex align-items-center justify-content-center">
        <h4 style="color: rgb(88, 16, 197);">@lang('message.aucun_element') !</h4>
      </div>
      @endforelse
          


 

      </div>


    </div>
  </section>





    
  <section id="cta" class="cta">
    <div class="container">

      <div class="row">
        <div class="col-lg-9 text-center text-lg-start">
          <h3>@lang('message.passer_action') !</h3>
          <p>@lang('message.categorieformationtext').</p>
        </div>

      

        <div class="col-lg-3 cta-btn-container text-center">
          <a class="cta-btn align-middle" href="{{route('bibliotheque', ['lang' => 'fr'])}}">@lang('message.toute_la_bibliotheque')</a>
        </div>
      </div>

    </div>
  </section>
