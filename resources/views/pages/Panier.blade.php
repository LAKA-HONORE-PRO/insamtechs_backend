<?php
use App\Http\Controllers\Controller;
// use App\Models\Formation;
$controller = new Controller();

?>
<!DOCTYPE html>
<html lang="fr">

    @include('components.Head')

<body>
    <!-- <div class="loader-bg">
        <div class="loader">
    
        </div>
    
      </div> -->
   
        @include('components.Topbar')


        @include('components.NavBarClient')



        @include('components.ContentPanier')


        @include('components.Footer')

     


   @include('components.Foot')

</body>
</html>

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



<?php

        if(isset($_SESSION['message']) == true) {
            $error= $_SESSION['message'];
        ?>

                <script type="text/javascript">
                    Swal.fire({
                        icon: '<?php echo $error['type']; ?>',
                        text: '<?php echo $error['message']; ?>',
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
        unset($_SESSION['message']);
        }

?>


