
<header id="header" class="d-flex align-items-center">
       
    <h1 class="logo me-auto">
        <a href="{{route('accueil')}}"> 
          <img src="{{URL::asset('assets/img/admin/logo_insam.png')}}" alt="">
          Insam Technologie
        </a>
    </h1>
  
  
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{route('accueil')}}">{{ __('message.home') }}</a></li>
          <li class="dropdown"><a href="#"><span>{{ __('message.videotheque') }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('videotheque', ['lang' => 'fr'])}}">{{ __('message.french') }}</a></li>
              <li><a href="{{route('videotheque', ['lang' => 'en'])}}">{{ __('message.english') }}</a></li>
             
            </ul>
          </li>
  
          <li class="dropdown"><a href="#"><span>{{ __('message.bibliotheque') }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('bibliotheque', ['lang' => 'fr'])}}">{{ __('message.french') }}</a></li>
              <li><a href="{{route('bibliotheque', ['lang' => 'en'])}}">{{ __('message.english') }}</a></li>
             
            </ul>
          </li>
  
          <li><a class="nav-link scrollto" href="{{route('filieres')}}">{{ __('message.fascicule') }}</a></li>
  
          <li><a class="nav-link scrollto" href="{{ route('jobs') }}">{{ __('message.job_description') }}</a></li>
         
          <li><a class="nav-link scrollto" href="{{route('contact')}}">{{ __('message.contact') }}</a></li>
  
          <li><a class="getstarted scrollto" href="{{route('connexion')}}">{{ __('message.espaceclient') }}</a></li>
       
  
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
  
    </div>
  </header>
  
  
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h5 class="modal-title" id="staticBackdropLabel"></h5> --}}
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Malheureusement, le contenu en anglais n'est pas encore disponible à l'heure actuelle. Nous vous prions de bien vouloir patienter encore un peu.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('message.fermer_modal')</button>
        </div>
      </div>
    </div>
  </div>
  
  
  
  
  