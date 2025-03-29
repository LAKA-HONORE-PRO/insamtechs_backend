@php
  use App\Models\Formation;
@endphp
<section id="portfolio" class="section-bg ">
  <div class="container">

    <div class="section-title" >
      <h2>@lang('message.nos_meilleures_epreuves')</h2>
    </div>


    <div class="row portfolio-container">
        


      @if (sizeof($fascicules) > 0)
          @forelse ($fascicules as $fascicule)
            
              <div class="col-lg-3 col-md-6 portfolio-item filter-app animate__animated animate__fadeInUp">
                <div class="portfolio-wrap">
                  <figure class="skeleton-loader" data-loaded="false">
                    <div class="skeleton-item"></div>
                    <img src="{{URL::asset('assets/img/admin/dossier1.jpg')}}" class="img-fluid" alt="" onload="hideSkeletonLoader(this)">
                  </figure>

                  <div class="portfolio-info">
                    <p>{{ucfirst($fascicule->intitule)}}</p>
                    
        
 <br>
                    <h4><a href="{{route('filieres')}}" class="btn btn-primary voir-plus">@lang('message.voir_tous_les_fascicules')</a></h4>
                    {{-- <h4><a href="" target='_blank' class="btn btn-primary voir-plus"> @lang('message.passer_le_test_en_ligne')</a></h4> --}}
                  </div>

                </div>
              </div>

          @empty

          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <h4 style="color: rgb(88, 16, 197);">@lang('message.aucun_element') !</h4>
          </div>

          @endforelse

      @endif


      

    </div>


  </div>
</section>





  
<section id="cta" class="cta">
  <div class="container">

    <div class="row">
      <div class="col-lg-9 text-center text-lg-start">
        <h3>@lang('message.passer_action') !</h3>
        <p>@lang('message.fasciculeaccueiltext') .</p>
      </div>

    

      <div class="col-lg-3 cta-btn-container text-center">
        <a class="cta-btn align-middle" href="{{route('filieres')}}">@lang('message.toutes_les_epreuves')</a>
      </div>
    </div>

  </div>
</section>