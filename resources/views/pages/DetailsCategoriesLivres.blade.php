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
    
    @include('components.DetailsCategoriesLivres')

    @include('components.Footer')
    <script>
        function goBack() {
         window.history.back();
        }
    </script>
    @include('components.Foot')
</body>
</html>