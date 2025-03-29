
<section id="topbar" class="d-flex align-items-left">
  <div class="container-fluid d-flex justify-content-between justify-content-md-between" style="margin-top: 5px">
    <div class="contact-info d-flex align-items-left justify-content-space-between" style="margin-top: 5px">
      {{-- <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com" style="margin-top: 8px">serviceestuaires@gmail.com</a>
      &nbsp;
      &nbsp;
      &nbsp; --}}
      <i class="bi bi-phone-fill phone-icon" style="font-size:15px"></i>
          <a href="tel:698 550 451" style="margin-top: 8px;font-size:10px">698 550 451</a>
          &nbsp;
          &nbsp;
          <a href="tel:680 244 692"  style="margin-top: 8px;font-size:10px">680 244 692</a>
          &nbsp;
          &nbsp;
          <a href="tel:696 523 672"  style="margin-top: 8px;font-size:10px">696 523 672</a>

    </div>

      <div class="contact-info d-flex align-items-left" style="margin-top: 5px">
      

            @if (LaravelLocalization::getCurrentLocale() == 'en')
              @php
                $localcode = 'fr';
                $localname = 'Français';
              @endphp
            @else
              @php
                  $localcode = 'en';
                $localname = 'Anglais';

              @endphp
            @endif

            <a rel="alternate" hreflang="{{$localcode}}" href="{{ LaravelLocalization::getLocalizedURL($localcode, null, [], true) }}" style="font-size:10px">
              {{$localname}}
              <i class="bi bi-globe2"></i>

           </a>
  

      </div>


      


  </div>
</section>
