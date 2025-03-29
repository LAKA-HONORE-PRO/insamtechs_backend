
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url({{('assets/img/admin/02.jpg')}})">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown"><span>Insam Technologie</span></h2>
              <p class="animate__animated animate__fadeInUp">@lang('message.un_cadre') <span id="typed"></span> @lang('message.pour')</p> 


              <script>
                var typed = new Typed("#typed", {
                    strings: ["propice ", "idéal ", "covenable "],
                    typedSpeed: 100,
                    backSpeed: 50,
                    backDelay: 3000,
                    loop: true
                });
             </script> 

            <p>@lang('message.caroussel_first').</p>

              <a href="{{route('connexion')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">@lang('message.passer_action')</a>
            </div>
          </div>
        </div>

        <!-- //adéquat, convenable -->

        <div class="carousel-item" style="background-image: url({{('assets/img/admin/documentation.jpg')}})">
          <div class="carousel-container">
            <div class="container">
                <h2><span>Insam Technologie</span></h2>
                <p >@lang('message.un_cadre') <span id="typedjs"></span> @lang('message.pour')</p> 


                <script>
                    var typed = new Typed("#typedjs", {
                        strings: ["propice ", "idéal ", "covenable "],
                        typedSpeed: 100,
                        backSpeed: 50,
                        backDelay: 3000,
                        loop: true
                    });
                 </script> 

                 <p>@lang('message.caroussel_second').</p>


                <a href="{{route('connexion')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">@lang('message.passer_action')</a>
            </div>
          </div>
        </div>



      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->
