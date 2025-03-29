@php
use App\Http\Controllers\Controller;
@endphp

<!DOCTYPE html>
<html lang="en">
    @include('components.Head')
<body>


    @include('components.Topbar')


    @auth
        @include('components.NavBarClient')
    @endauth

    @guest
        @include('components.Navbar') 
    @endguest



    {{-- @include('components.OtherCaroussel') --}}
    
    @include('components.DetailsLivreComponent')

    @include('components.Footer')

    @include('components.Foot')
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
      $('#take').click(function(e) {
        //e.preventDefault(); // Empêche le comportement par défaut du lien
  
        $(this).addClass('disabled');
        $(this).css('cursor', 'not-allowed');
        $('#loader').show();
  
        let timerInterval
              Swal.fire({
                  title: 'Veuillez patienter!',
                  html: 'Votre téléchargement va commencer dans quelques instants...',
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
                      //window.location.href = "";
                      // console.log('I was closed by the timer')
                      Swal.close();
                  }
              })
  
  
      });
    });



    $(document).ready(function() {
      $('#take2').click(function(e) {
        //e.preventDefault(); // Empêche le comportement par défaut du lien
  
        $(this).addClass('disabled');
        $(this).css('cursor', 'not-allowed');
        $('#loader').show();
  
        let timerInterval
              Swal.fire({
                  title: 'Veuillez patienter!',
                  html: 'Votre téléchargement va commencer dans quelques instants...',
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
                      //window.location.href = "";
                      // console.log('I was closed by the timer')
                      Swal.close();
                  }
              })
  
      });
    });
  </script>