@php
  use App\Models\Formation;
  use App\Models\Categorie;
  use App\Models\Commander;
@endphp


<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              {{-- <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.mon_panier') </span></h2> --}}
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / {{ ucfirst($livre->intitule) }}</p> 
  
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




<main id="main">

    <!-- ======= Portfolio Details Section ======= -->
    <section id="details-livres" class="details-livres">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="details-livres-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="{{URL::asset('assets/img/admin/book2.jpg')}}" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="details-livres-info">
              <h3>Détails du livre</h3>
              <ul>
                <li><strong style="color: rgb(88, 16, 197)">Catégorie</strong>: {{ucfirst(Categorie::find($livre->categorie_id)->intitule)}}</li>
                <li><strong style="color: rgb(88, 16, 197)">Prix</strong>: @if ($livre->prix > 0) {{ $livre->prix }} <sup>Fcfa</sup> @else Gratuit @endif</li>
                <li><strong style="color: rgb(88, 16, 197)">Enregistré le</strong>: {{$livre->date}}</li>
                <li><strong style="color: rgb(88, 16, 197)">Langue</strong>: {{ $livre->langue_formation }}</li>
              </ul>
            </div>
           {{-- <div class="details-livres-description">
              <h2>Description</h2>
              <p>
                {{ucfirst($livre->description)}}
              </p>
            </div>--}}

            @auth

            @php
              $commander = Commander::where(['user_id'=>Auth::user()->id, 'formation_id'=>$livre->id])->first();  
            @endphp

              <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                <a href="{{$livre->lien}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center;" id="take" target="_blank"> &nbsp;  Lire le livre &nbsp; <i class="bi bi-book"></i></a>
              </div>
          @endauth
          @guest
              <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
               <a href="{{$livre->lien}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center;" id="take2" target="_blank"> &nbsp; Livre le livre &nbsp; <i class="bi bi-book"></i></a>

              </div>
          @endguest

          </div>
          
          
          <script>
            //   function downloadFile(event) {
            //     var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            
            //     // Vérifiez si l'utilisateur utilise un navigateur mobile
            //     if (/iPad|iPhone|iPod|Android/.test(userAgent) && !window.MSStream) {
            //       // Utilisez la méthode de contournement pour les navigateurs mobiles
            //       event.preventDefault();
            //       window.location.href = event.target.href;
            //     } else {
            //       // Laissez le comportement par défaut pour les autres navigateurs
            //       event.target.setAttribute("download", "");
            //     }
            //   }
            </script>

      
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->
</main>

