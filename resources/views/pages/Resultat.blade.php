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


      @include('components.ContentResultat')
 
 

    @include('components.Footer')

     
  
    <script>
      function goBack() {
       window.history.back();
      }
  </script>

   @include('components.Foot')

</body>

</html>