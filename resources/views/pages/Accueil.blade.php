<?php
use App\Http\Controllers\Controller;
$controller = new Controller();

?>

<!DOCTYPE html>
<html lang="fr">

    @include('components.Head')

<body>
    




            @include('components.Topbar')

            @auth
              @include('components.NavBarClient')
            @endauth
            
            @guest
              @include('components.Navbar') 
            @endguest
      
   

    @include('components.CarousselAccueil')

    @include('components.CategorieCoursAccueil')

    @include('components.CategorieFormationAccueil')

    @include('components.FasciculeComponent')

    @include('components.CounterAccueil')

    @include('components.FaqComponent')

    @include('components.Footer')

    @include('components.Foot')



</body>




<?php

if(isset($_SESSION['bienvenue']) == true) {
    $error= $_SESSION['bienvenue'];
?>

        <script type="text/javascript">
      const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        Toast.fire({
            icon: '<?= $error['icon'] ?>',
            title: '<?= $error['message'] ?>',
            showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
        })

        </script>

<?php
unset($_SESSION['bienvenue']);
}

?>

