@php
use Illuminate\Support\Facades\DB;
use App\Models\Formation;
@endphp

<section id="portfolio" class="section-bg">
    <div class="container">



      <div class="section-title" >
        <h2>@lang('message.nos_categories_de_cours')</h2>
      </div>


    <div class="row portfolio-container animate__animated animate__fadeInUp">


      @forelse ($categoriesvideos as $categorie)


      @php
        $count = Formation::where('categorie_id', $categorie->id)->count();
      @endphp
      {{-- @php
      $cats = DB::table('formations')
              ->join('categories', 'categories.id', '=', 'formations.categorie_id')
              ->where(['categories.id'=> $categorie->id])
              ->select('categories.*')
              ->first();
      @endphp
      
      @if ($cats != null) --}}
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
      {{-- @endif --}}



        
      @empty
        
      <div class="col-lg-12 d-flex align-items-center justify-content-center">
        <h4>@lang('message.aucun_element') !</h4>
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
          <p>@lang('message.entrez_communaute')<span id="catfast"></span></p>
        </div>


        <script>
          var typed = new Typed("#catfast", {
              strings: ["Insam Technologie."],
              typedSpeed: 500,
              backSpeed: 80,
              backDelay: 5000,
              loop: true
          });
       </script> 
        
        <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="{{route('videotheque', ['lang' => 'fr'])}}">@lang('message.toutes_les_categorie')</a>
        </div>
    </div>

    </div>
  </section><!-- End Cta Section -->

