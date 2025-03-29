<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
      <img src="{{ URL::asset('assets/img/admin/logo-estuaire.png') }}" alt="">
      <span class="d-none d-lg-block">Tableau de baord</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>


  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>


      <div class="contact-info d-flex align-items-left" style="margin-top: 5px">
      

        @if (LaravelLocalization::getCurrentLocale() == 'en')
          @php
            $localcode = 'fr';
          @endphp
        @else
          @php
              $localcode = 'en';
          @endphp
        @endif

        <a rel="alternate" hreflang="{{$localcode}}" href="{{ LaravelLocalization::getLocalizedURL($localcode, null, [], true) }}">
          {{$localcode}}
          <i class="bi bi-globe2"></i>

       </a>


    </div>

    &nbsp;
    &nbsp;

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{URL::asset('public/dashboard/assets/img/profil.png') }}" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">@auth {{Auth::user()->email}} @endauth</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{Auth::user()->email}}</h6>
            <span>

                @if (Auth::user()->role == 'user')
                    Utilisateur
                @else
                    Administrateur
                @endif

            </span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <!-- <li>
            <a class="dropdown-item d-flex align-items-center" href="">
              <i class="bi bi-person"></i>
              <span>Profil</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
        -->

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#" onclick="deconnect()">
              <i class="bi bi-box-arrow-right"></i>
              <span>Déconnexion</span>
            </a>
          </li>

        </ul>
      </li>
    </ul>
  </nav>

</header>


<script>
  function deconnect() {
      Swal.fire({
          title: 'Attention !',
          showClass: {
              popup: 'animate__animated animate__fadeIn'
          },
          hideClass: {
              popup: 'animate__animated animate__fadeOut'
          },
          text: "Voulez-vous vraiment vous déconnecter ?",
          icon: 'question',
          confirmButtonColor: '#4154f1',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Oui',
          showCancelButton: true,
          cancelButtonText: 'Annuler'
      }).then((result) => {
          if (result.isConfirmed) {
              let timerInterval
              Swal.fire({
                  title: 'Attention!',
                  html: 'Déconnexion en cours...',
                  timer: 3000,
                  icon: 'info',
                  timerProgressBar: true,
                  showConfirmButton: false,
                  didOpen: () => {
                      Swal.showLoading()
                      const b = Swal.getHtmlContainer().querySelector('.azerty')
                      timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft()
                      }, 100)
                  },
                  willClose: () => {
                      clearInterval(timerInterval)
                  }
              }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                      window.location.href = "{{route('auth.logout')}}";
                      // console.log('I was closed by the timer')
                  }
              })
          }
      })

  }
</script>