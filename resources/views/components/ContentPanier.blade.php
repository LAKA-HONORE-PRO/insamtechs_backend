@php
  use App\Models\Formation;
  use App\Models\Video;
  use Illuminate\Support\Facades\DB;
@endphp


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @lang('message.message_desagrement')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('message.fermer_modal')</button>
      </div>
    </div>
  </div>
</div>


<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.mon_panier') </span></h2>
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.mon_panier')</p> 
  
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
            </div>
          </div>
        </div>
  
  
  
      </div>
  
  
    </div>
</section>
  
  
<br>
<br>
<br>




<section id="horizontal-pricing" class="horizontal-pricing pt-0">
    <div class="container">


    @if (sizeof($paniers))

    @php
     $prix_ttc = 0;
    @endphp
          
      @forelse ($paniers as $panier)

        @php
          $formation = Formation::find($panier->formation_id);
          $prix_ttc = $prix_ttc + (int)$formation->prix;
        @endphp

      <div class="row gy-4 pricing-item">
        <div class="col-lg-3 d-flex align-items-center justify-content-center">
            <div class="text-center">
              {{-- <a href="#" class="buy-btn">Buy Now</a> --}}
              <img src="@if(Formation::find($panier->formation_id)->type_formation_id === 2) {{URL::asset('assets/img/admin/book2.jpg')}} @else {{URL::asset('assets/img/admin/categorie.jpg')}} @endif" alt="" width="60%" height="auto">
          </div>
          </div>
        <div class="col-lg-3 d-flex align-items-center justify-content-center">
          <h3>{{ucfirst(Formation::find($panier->formation_id)->intitule)}}</h3>
        </div>
        <div class="col-lg-3 d-flex align-items-center justify-content-center">
          <h4>{{Formation::find($panier->formation_id)->prix}}<sup>Fcfa</sup></h4>
        </div>
        <div class="col-lg-3 d-flex align-items-center justify-content-center">
          <ul>
            <li>
                <a href="{{route('delete_commande', $panier->slug)}}">
                  @lang('message.supprimer_du_panier')   <i class="bi bi-x"></i>
                </a>
            </li>
          </ul>
        </div>

      </div>
      <br>
      <br>
      <br>
      @empty

      @endforelse


      <div class="container">
        <div class="row gy-4 pricing-item featured mt-4">

            <div class="col-lg-3 d-flex align-items-center justify-content-center">
              <h3>Total TTC</h3>
            </div>
    
            <div class="col-lg-3 d-flex align-items-center justify-content-center">
              <h4>{{$prix_ttc}}<sup>Fcfa</sup></h4>
            </div>
            
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
              <div class="text-center"><a href="#" class="buy-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-cash"></i> &nbsp; @lang('message.passer_la_commande')</a></div>
            </div>
        </div><!-- End Pricing Item -->
    
    </div>

      @else
          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <h4>@lang('message.panier_vide') !</h4>
          </div>
    
      @endif


      
    </div>

  
  </section>




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
    <a href="{{route('videotheque', ['lang' => 'fr'])}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "> @lang('message.trouver_autres_formation') &nbsp; <i class="bi bi-arrow-right"></i></a>
  </div>
  <br>
  <br>