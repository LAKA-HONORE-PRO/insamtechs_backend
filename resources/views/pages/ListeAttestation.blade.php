
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
            size: A4 portrait; /* ou portrait selon vos besoins */
            margin: 0;         /* Aucune marge */
        }
    
        @media print {
            html {
                zoom: 100%; /* Ajustement si nécessaire */
            }
            
            body {
                margin: 0; /* Assurez-vous que le corps n'a pas de marge */
                padding: 0; /* Assurez-vous que le corps n'a pas de remplissage */
            }
        }
    </style>


    @include('components.ContentListeAttestation')
  
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

</html>

