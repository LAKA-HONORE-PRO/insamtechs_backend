<section id="hero_other">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>

    <div class="carousel-inner_other" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item_other active">
        <div class="carousel-container_other">
          <div class="container_other">
            <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.contact') </span></h2>
            <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.contact') </p> 

            <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
          </div>
        </div>
      </div>



    </div>


  </div>
</section><!-- End Hero -->



<section id="contact" class="contact">
  
  
    <div class="container">

      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Localisation:</h4>
              <p>Bafoussam, Douala</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>estuaire@example.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+237 656587406</p>
            </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">
      
          <form method="post" action="{{route('newsletter.store')}}" autocomplete="off">
            @csrf
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="nom" placeholder="Nom" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="objet" id="subject" placeholder="Objet" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>

            @if ($errors->any())
            <br>
            <br>
                 <div > 
                    <ul class="alert alert-success" style="margin-top: -15px">
                      <!-- <li style="list-style: none; text-align:center">Email ou mot de passe incorrect!</li> -->
                        @foreach ($errors->all() as $error)
                            <li style="text-align : center; list-style:none">{{ $error }}</li>
                        @endforeach 
                    </ul>
                 </div>
            @endif
          
            <br>
           
              <div class="row justify-content-center align-items-center">
                 <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer" value="Envoyer">
              </div>  
          </form>

        </div>

      </div>

    </div>

    <!--
    <br>
    <div >

        
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.6477899657475!2d10.414520378328477!3d5.470283480352153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x105f915fb132d903%3A0x3885468c8238cbf8!2sEstuaire%20emploi!5e0!3m2!1sfr!2scm!4v1702462296966!5m2!1sfr!2scm" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  -->
</section>
