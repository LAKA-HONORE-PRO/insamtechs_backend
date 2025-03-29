@php
use App\Http\Controllers\Controller;
@endphp

<!DOCTYPE html>
<html lang="fr">

    @include('components.Head')

<body>

    <!-- <div class="loader-bg">
        <div class="loader">
    
        </div>
    
      </div> -->
    
   
    @include('components.Topbar')


    @include('components.Navbar')


    @include('components.ContentConnexion')


    @include('components.Footer')

     
  


   @include('components.Foot')





   <script>
    var reg = document.querySelector("#form-register");
    var log = document.querySelector("#login-form");

    var btn_register = document.querySelector("#btn-register");
    var login_btn = document.querySelector("#login-btn");

    reg.style.display = 'none';
    
    btn_register.addEventListener("click", function() {
        log.style.display = 'none';
        reg.style.display = '';
    });

    login_btn.addEventListener("click", function() {
    
        log.style.display = '';
        reg.style.display = 'none';

    });
  </script>

</body>
</html>