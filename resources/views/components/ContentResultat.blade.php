<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> Correction </span></h2>
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / Correction</p> 
  
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
            </div>
          </div>
        </div>
  
  
  
      </div>
  
  
    </div>
  </section>
  
  
  <br>
  <br>
  
  {{-- <section id="horizontal-pricing" class="horizontal-pricing pt-0">
    <div class="container" id="content_title" style="transition: all 0.5s">
 
    <button id="reloadButton"  class="col-sm-10 col-xs-10 col-md-12 justify-content-center align-items-center" id="suivant" style="display: none; background-color: #f39200; text-decoration:none; padding:15px; color:white; text-align:center; border:none">Une erreur est survenue lors du chargement de cette page. cliquez ici pour la recharger!</button>
  
      <div class="col-lg-12 d-flex align-items-center justify-content-center">
        <h4 style="font-weight: 700" > Correction de {{ucfirst($fascicule->intitule)}}</h4>
      </div>
  
    </div>
  
  
  </section> --}}
  
  @php
  $item = 0;
//   $points = 0;
  $i = 0;
@endphp
  <div class="container" id="all" style="transition: all 0.5s">
    <h2 style="color: rgb(88, 16, 197); font-weight:700;">{{ucfirst($fascicule->intitule)}}</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            {{-- <tr>
                <td colspan="4" style="text-align: center">{{$fascicule->intitule}}</td>
            </tr> --}}
          <thead>
            <tr>
              <th>#</th>
              <th>Question</th>
              <th>Réponse Choisie</th>
              <th>Bonne réponse</th>
            </tr>
          </thead>
          <tbody>
@foreach ($questions as $question)

@php
    $i = $i +1;
@endphp
        <tr>
            <th>{{$i}}</th>
            <td>{{ucfirst($question->intitule)}}</td>
            <td style="@if($question->bonne_reponse === $reponses[$item]->reponse) color:green @else color:red @endif">{{ucfirst($reponses[$item]->reponse)}}</td>   
            <td> {{ucfirst($question->bonne_reponse)}}</td>
        </tr>
  
              
   @php
      $item = $item+1;
   @endphp
@endforeach

          </tbody>
          <tfoot>
            <tr>
                <td colspan="4" style="text-align: center; font-weight:700">
                      Note :  {{$points. ' / ' .$fascicule->nombre_de_points}}
                </td>
            </tr>
          </tfoot>
        </table>
      </div>


      <br>
  

      <div class="row d-flex justify-content-end align-items-end" style="margin-top:20px" id="me">
        {{-- <input type="submit" class="col-sm-10 col-xs-10 col-md-4" value="Suivant" id="suivant" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; border:none"> --}}
   
        <button class="col-sm-10 col-xs-10 col-md-4" id="suivant" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; border:none">@lang('message.suivant_btn_quiz')</button>
      </div>
      

  </div>
  
  <br>
  <br>
  <br>
  
  
  