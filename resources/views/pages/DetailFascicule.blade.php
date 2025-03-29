
<?php
use App\Http\Controllers\Controller;
// use App\Models\Formation;
$controller = new Controller();

?>
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
    
    @include('components.ContentDetailFascicule')

    @include('components.Footer')
    <script>
      function goBack() {
       window.history.back();
      }
  </script>
    @include('components.Foot')
</body>

<style>
    /* Définition des styles personnalisés pour le bouton de fermeture */
    .swal2-close {
      color: rgb(88, 16, 197); /* Remplacez "red" par la couleur de votre choix */
    }
  </style>

<script>
    function info(param){
        // alert(param.slug);

        var route = "../examen_job/"+param.slug;
        Swal.fire({
            // title: "<strong>HTML <u>example</u></strong>",
            // icon: "info",
            html: `
               <p>@lang('message.message_accueil_quiz')</p>
               <br>
                <p style="color:rgb(88, 16, 197); font-weight:700">@lang('message.bonne_chance')</p>

            `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `
                     @lang('message.demarrer_quiz')!
            `,
            confirmButtonAriaLabel: "Thumbs up, great!",
            cancelButtonText: `
                <i class="fa fa-thumbs-down"></i>
            `,
            cancelButtonAriaLabel: "Thumbs down",
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
            }).then((result) => {
                if (result.isConfirmed) {
                    // Action à exécuter lorsque le bouton de confirmation est cliqué
                        window.location.href = route;
                    // Ajoutez votre code ici pour l'action souhaitée
                }
            });
     }
</script>

<script>
    // Écouter les clics sur les boutons
    document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function () {
            // Récupérer l'ID de l'élément
            const elementId = this.getAttribute('data-id');

            
            // Mettre à jour le contenu de la modal
            document.getElementById('booklet_id').value = elementId;
        });
    });
</script>

</html>

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

