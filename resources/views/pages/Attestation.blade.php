
<?php
use App\Http\Controllers\Controller;
$controller = new Controller();

?>

<!DOCTYPE html>
<html lang="fr">

    @include('components.Head')

<body style="background-color: #f1f1f1" id="body">

    <style>
        @page {
            size: A4 landscape; /* ou portrait selon vos besoins */
            margin: 0;         /* Aucune marge */
        }
    
        @media print {
            html {
                zoom: 80%; /* Ajustement si nécessaire */
            }
            
            body {
                margin: 0; /* Assurez-vous que le corps n'a pas de marge */
                padding: 0; /* Assurez-vous que le corps n'a pas de remplissage */
            }
        }
    </style>


    @include('components.ContentAttestation')

  

     
  
    <script>
      function goBack() {
       window.history.back();
      }
  </script>

   @include('components.Foot')

</body>

<script>
    var printButton = document.querySelector('#print');
    var cardPrint = document.querySelector('#all');

    printButton.addEventListener('click', function(e) {
        e.preventDefault();

        printButton.style.display = 'none';

        window.print();

        printButton.style.display = '';


    });
</script>


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
</html>

