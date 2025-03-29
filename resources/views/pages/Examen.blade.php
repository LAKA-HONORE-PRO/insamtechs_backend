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


    @include('components.ContentExamen')



 

    @include('components.Footer')

     
  


   @include('components.Foot')

</body>



<style>
  .btn-appear {
  opacity: 0;
  transition: opacity 0.5s;
}

.btn-appear.show {
  opacity: 1;
}


</style>



<script>
  // Fonction pour formater le temps restant en heures, minutes et secondes
  function formatTime(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds % 3600) / 60);
    var remainingSeconds = seconds % 60;
    
    return hours.toString().padStart(2, '0') + ':' +
           minutes.toString().padStart(2, '0') + ':' +
           remainingSeconds.toString().padStart(2, '0');
  }

  // Définir la durée prévue en secondes (1 heure = 3600 secondes)
  var dureePrevue = 3600;

  // Démarrer le décompte
  var countdownElement = $('#countdown');
  var countdownInterval = setInterval(function() {
    if (dureePrevue <= 0) {
      clearInterval(countdownInterval);
      $('#all').empty();
      $('#all').html('<div style="color:red; text-decoration:none; padding:15px; font-size:25px; text-align:center; border:none">'+ "Votre temps s'est écroulé !" +'</div>');
      // console.log("Opération à exécuter à 40 minutes et 00 secondes");
    }
    
    countdownElement.text(formatTime(dureePrevue));


    // if (dureePrevue === 3590) { // Condition lorsque le décompte atteint 40 minutes et 00 secondes
    //   // Effectuez votre opération précise ici

    // }


    dureePrevue--;
  }, 1000);
</script>


<script>

$(document).ready(function() {

$('#note_section').hide();


  var title = $('.response').text();

  

  var currentQuestionIndex = 0;
  var questions = []; // Contiendra les questions récupérées en JSON

  // Fonction pour afficher une question
  function displayQuestion(index, locale) {
    var question = questions[index];
    
// console.log(locale);

        $('.response').text('').attr('data-answer', '');
        $('input[name="reponse_choisie"]').val('');
        $('.response').css('background-color', 'white');
        $('.response').css('color', '#0f70b6');

    if(locale === "fr"){
      $('#int_question').text(question.intitule['fr'].toUpperCase());
            $('#int_question').css('animation', 'fadeInUp 2s');
            // $('#reponse_bonne').attr('value', question.bonne_reponse['fr']);

            
            var valeurs = [question.question_une['fr'], question.question_deux['fr'], question.question_trois['fr'], question.question_quatre['fr']];
        }
        else{
          $('#int_question').text(question.intitule['en'].toUpperCase());
          $('#int_question').css('animation', 'fadeInUp 2s');
          // $('#reponse_bonne').attr('value', question.bonne_reponse['en']);

        
          var valeurs = [question.question_une['en'], question.question_deux['en'], question.question_trois['en'], question.question_quatre['en']];
        }

        var elementSpan = $('.response').toArray();

        elementSpan.forEach(function(element, index) {
             $(element).css('animation', 'lightSpeedInRight 2s');
            $(element).text(valeurs[index].toUpperCase());
            $(element).attr('data-answer', valeurs[index]);
          });
    
  }



  function getNote() {
  
    $.ajax({
      url: '{{route('note', $fascicule->id )}}',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        // loadingIndicator.hide();

        note = response.note;
        total = response.total;
        
        $('#note_section').show();
        $('#note_section').css('animation', 'lightSpeedInRight 2s');

        $('#note').html('<h4 style="color: white" >'+ 'Votre score est de : '+ note+' / '+ total +'</h4>' );
        // alert(note + ' / ' +total);

      },
      error: function(xhr, status, error) {
        console.log('notes non récupérées');
      }
    });

  }






function getQuestions() {
  
  var loadingIndicator = $('#loadingIndicator');
  var reloadButton = $('#reloadButton');

    $.ajax({
      url: '{{route('take', $fascicule->id )}}',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        loadingIndicator.hide();

        questions = response.questions;
        locale = response.locale;
        var tempsPrevu = response.temps_prevu;
        // console.log(locale);
        displayQuestion(currentQuestionIndex, locale);

      },
      error: function(xhr, status, error) {
        // console.error(error);
        reloadButton.show();
      }
    });

     // Gérer le clic sur le bouton de rechargement
  reloadButton.on('click', function() {
    // Recharger la page
    location.reload();
  });
  }


  function submitAnswer() {


    var formData = $('#myForm').serialize();

    var btn = $('#suivant');
    
    btn.addClass('btn-appear');
    $('.response').addClass('btn-appear');

    $('#suivant').hide();
    $('.response').hide();
    $('#int_question').hide();

    // $('#int_question').hide();

    $.ajax({

      url: '{{route('store_examen')}}',
      type: 'POST',
      dataType: 'json',
      data: formData,
      // {
      //   answer: answer
      // },
      success: function(response) {

            var resultat = response.success;

          btn.removeClass('btn-appear');
          $('.response').removeClass('btn-appear');

        $('#suivant').show();
        $('.response').show();
        $('#int_question').show();

        // Passer à la question suivante
        currentQuestionIndex++;

        if (currentQuestionIndex < questions.length && resultat === true) {
          // Afficher la question suivante
          displayQuestion(currentQuestionIndex, locale);
        }
        else if(currentQuestionIndex >= questions.length && resultat === false)
         {
              Swal.fire({
                    title: 'Information!',
                     text: "Vous devez patientez 72h pour pouvoir repasser cet examen !",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                    })

                    return;
  
        }
        else{
              // Toutes les questions ont été affichées
              // alert('Quiz terminé !');
              getNote();
          $('#content_title').empty();
          $('#all').empty();
          $('#all').html('<div class="col-lg-12 d-flex align-items-center justify-content-center">'+
                         '<a href="{{route('resultat', $fascicule->slug)}}" class="col-sm-10 col-xs-10 col-md-4 justify-content-center align-items-center" id="suivant" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; border:none">'+'Cliquez ici pour voir la correction'+'</a>'+'</div>'
                                );

        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        $('#suivant').show();
      }
    });
  }



  $('.response').click(function() {
    var selectedValue = $(this).attr('data-answer');
   var choix =  $('input[name="reponse_choisie"]').val(selectedValue);
    
   $('.response').each(function() {
      if($(this).attr('data-answer') != $('#reponse_choisie').val()){
        $(this).css('background-color', 'white');
        $(this).css('color', '#0f70b6');
      }
      else{
        $(this).css('background-color', '#0f70b6');
        $(this).css('color', 'white');
      }
  });

  });

  // Gestionnaire d'événement pour le bouton de soumission
  $('#suivant').click(function(e) {
      e.preventDefault();

    if( $('#reponse_choisie').val() === '')
    {
      Swal.fire({
                    title: 'Information!',
                     text: "Veuillez sélectionner une réponse avant de soumettre le formulaire !",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
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
      return; // Arrêter la soumission du formulaire
    
    }else{
      submitAnswer();

    }
  });


  getQuestions();

});



</script>