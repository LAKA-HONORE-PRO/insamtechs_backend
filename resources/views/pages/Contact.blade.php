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


      @auth
       @include('components.NavBarClient')
      @endauth
  
      @guest
        @include('components.Navbar') 
      @endguest
  

    {{-- @include('components.OtherCaroussel') --}}


    @include('components.ContentContact')


    @include('components.Footer')

     
  


   @include('components.Foot')

</body>
</html>