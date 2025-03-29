
<footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-contact">
            <h3>Insam Technologie</h3>
            <p>
              Tamdja <br>
              Bafoussam, Derrière Camtel<br>
              Douala, Entrée IUT<br><br>
              <strong>Phone:</strong>698 550 451 / 680 244 692 / 696 523 672<br>
              <strong>Email:</strong> serviceestuaires@gmail.com <br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>@lang('message.liens_utiles')</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('accueil')}}">@lang('message.home')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('videotheque', ['lang' => 'fr'])}}">@lang('message.videotheque')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('bibliotheque', ['lang' => 'fr'])}}">@lang('message.bibliotheque')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('filieres')}}">@lang('message.fascicule')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('jobs') }}">@lang('message.job_description')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('contact')}}">@lang('message.contact')</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>@lang('message.nos_produits')</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('videotheque', ['lang' => 'fr'])}}">@lang('message.cours_videos')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('filieres')}}">@lang('message.cours_pdf')</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('filieres')}}">@lang('message.Epreuves')</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>@lang('message.rejoindre_newsletter')</h4>
            <p>@lang('message.message_newsletter')</p>
            <form method="post" action="{{route('newsletter_form')}}" autocomplete="off">
              @csrf
              <input type="email" name="email" required><input type="submit" value="@lang('message.souscrire_btn')">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">

      <div class="copyright-wrap d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
          <div class="copyright">
            &copy; Copyright <strong><span>Insam Technologie</span></strong>. Tous droits réservés
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/techie-free-skin-bootstrap-3/ -->
            Designed by <a href="">Estuaire Service</a>
          </div>
        </div>
        {{-- <div class="social-links text-center text-md-right pt-3 pt-md-0">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div> --}}
      </div>



      

    </div>
    
  </footer><!-- End Footer -->


  <script>
    function hideSkeletonLoader(img) {
      img.parentElement.setAttribute('data-loaded', 'true');
    }
  </script> 