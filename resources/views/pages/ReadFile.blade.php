
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

      


    @include('components.ContentReadFile')

    @include('components.Footer')

     
  

    <script>
      function goBack() {
       window.history.back();
      }
  </script>
   @include('components.Foot')

</body>
</html>