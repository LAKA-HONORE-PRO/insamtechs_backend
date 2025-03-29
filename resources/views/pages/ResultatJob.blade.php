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
{{--     
      
      @if (LaravelLocalization::getCurrentLocale() == 'en')
        @php
          $localcode = 'fr';
        @endphp
      @else
        @php
            $localcode = 'en';
        @endphp
      @endif --}}
   
   {{-- @include('components.Topbar') --}}


      @auth
       @include('components.NavBarClient')
      @endauth
      @guest
      @include('components.Navbar')
      @endguest


      @include('components.ContentResultatJob')
 
 

    @include('components.Footer')

     
  

    <script>
      function goBack() {
       window.history.back();
      }
  </script>
   @include('components.Foot')

</body>


<script>
  var btn = document.getElementById("suivant");
  var footer = document.getElementById("footer");
  var hero_other = document.getElementById("hero_other");
  var navbar = document.getElementById("navbar");
  var tit = document.getElementById("tit");
  

  btn.addEventListener('click', function() {
    
    btn.style.display = 'none';
    footer.style.display = 'none';
    hero_other.style.display = 'none';
    navbar.style.display = 'none';
    tit.style.color = 'red';
    tit.style.fontSize = '24px';

    window.print();


    btn.style.display = '';
    footer.style.display = '';
    hero_other.style.display = '';
    navbar.style.display = '';
    tit.style.color = '';
    tit.style.fontSize = '';

  });
</script>

</html>