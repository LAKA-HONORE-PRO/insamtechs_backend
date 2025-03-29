<section id="hero_other">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>

    <div class="carousel-inner_other" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item_other active">
        <div class="carousel-container_other">
          <div class="container_other">
            <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.examen_intitule') </span></h2>
            <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.examen_intitule')</p> 

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
<br>

<section id="horizontal-pricing" class="horizontal-pricing pt-0">
  <div class="container" id="content_title" style="transition: all 0.5s">

    <div class="col-lg-12 d-flex align-items-center justify-content-center">
      <h4 style="font-weight: 700; color:#f39200"> Temps restant : <span style="font-weight: 700; font-size:25px; color: #f39200" id="countdown"></span></h4>
    </div>

  <button id="reloadButton"  class="col-sm-10 col-xs-10 col-md-12 justify-content-center align-items-center" id="suivant" style="display: none; background-color: #f39200; text-decoration:none; padding:15px; color:white; text-align:center; border:none">Une erreur est survenue lors du chargement de cette page. cliquez ici pour la recharger!</button>

    <div class="col-lg-12 d-flex align-items-center justify-content-center">
      <h4 style="font-weight: 700" > {{ucfirst($fascicule->intitule)}}</h4>
    </div>

    <br><br>

    <div class="row gy-4 pricing-item" style="background-color: #0f70b6" >
    
      <div class="col-lg-12 d-flex align-items-center justify-content-center">
        <h4 style="color: white" id="int_question"></h4>
      </div>

    </div>
    
  </div>


</section>


<style>
.response{
  padding: 12px 8px;  
  border:1px solid #0f70b6;
   border-radius:5px;
   color:#0f70b6; 
   font-size:25px; 
   text-align:center;
  font-weight: 700;
  transition: all 0.5s;
  margin-bottom: 30px;
}

.response:hover{
  color: white;
  background-color: #0f70b6;
  cursor: pointer;
}

#suivant{
  margin-right: 10px;
}
</style>

<section id="note_section" class="horizontal-pricing pt-0" >
  <div class="container" id="content_title" style="transition: all 0.5s">

    <div class="row gy-4 pricing-item" style="background-color: #f39200"" >
    
      <div class="col-lg-12 d-flex align-items-center justify-content-center" id="note">
        {{-- <h4 style="color: white" ></h4> --}}
      </div>

    </div>
    
  </div>


</section>

<br>
<br>

<div class="container" id="all" style="transition: all 0.5s">
  <div class="section-title" >
    <h2 style="transition: all 0.5s">
          @lang('message.selectionnez_bonne_reponse')
    </h2>
  </div>
  <div class="row d-flex align-items-center justify-content-center" id="content_form">
      
    <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 my-6 d-flex align-items-center justify-content-center">


      <span class="col-12 response " id="q1" data-answer="" data-span-id="1" style="transition: all 0.5s">

      </span>

    </div>

    <br>


    <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
      <span class="col-12 response" id="q2" data-answer="" data-span-id="2" style="transition: all 0.5s">
 
      </span>
    </div>

    <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
      <span class="col-12 response" id="q3" data-answer="" data-span-id="3" style="transition: all 0.5s">
    
      </span>
    </div>

    <br>
    
      <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
      <span class="col-12 response" id="q4" data-answer="" data-span-id="4" style="transition: all 0.5s">

      </span>
    </div>
  </div>
        


  <form action="#" id="myForm" method="POST">

         @csrf
    <input type="hidden" name="fascicule_id" value="{{$fascicule->id}}" id="fascicule_id">
    <input type="hidden" name="reponse_choisie" value="" id="reponse_choisie">
    <input type="hidden" name="reponse_bonne" value="" id="reponse_bonne">

    <br>

    <div class="row d-flex justify-content-end align-items-end" style="margin-top:20px" id="me">
      {{-- <input type="submit" class="col-sm-10 col-xs-10 col-md-4" value="Suivant" id="suivant" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; border:none"> --}}
 
      <button class="col-sm-10 col-xs-10 col-md-4" id="suivant" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; border:none">@lang('message.suivant_btn_quiz')</button>
    </div>
    
  </form>

</div>

<br>
<br>
<br>


