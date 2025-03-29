@extends('pages.Dashboard')

@section('content')
    


<div class="pagetitle">
  <h1>Ajouter Une Question</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">{{ucfirst($fascicule->intitule)}}</li>
      <li class="breadcrumb-item active">Ajouter</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-12 d-flex flex-column align-items-center justify-content-center py-4">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('store_question')}}" autocomplete="off" id="chapitre_create">
          @csrf

          <input type="hidden" name="fascicule_id" value="{{$fascicule->id}}">

          <div class="row">
            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé du fascicule</label>
              <input type="text" class="form-control" id="intitule-chapitre" value="{{ucfirst($fascicule->intitule)}}" name="intitule-chapitre" readonly required>
              <br>
            </div>


            <div class="form-group col-6">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points" name="points" required>

              <br>
            </div>
          </div>

<!--
          <div class="row">
    
            <div class="form-group col-6">
              <label for="question_une" class="form-label">Première option</label>
              <input type="text" class="form-control" id="question_une" name="question_une" required>

              <br>
            </div>


            <div class="form-group col-6">
              <label for="question_deux" class="form-label">Deuxième option</label>
              <input type="text" class="form-control" id="question_deux" name="question_deux" required>

              <br>
            </div>

            
          </div>
          
          <div class="row">
    
            <div class="form-group col-6">
              <label for="question_trois" class="form-label">Troisième option</label>
              <input type="text" class="form-control" id="question_trois" name="question_trois" required>

              <br>
            </div>


            <div class="form-group col-6">
              <label for="question_quatre" class="form-label">Quatrième option</label>
              <input type="text" class="form-control" id="question_quatre" name="question_quatre" required>

              <br>
            </div>

            
          </div>
-->
          <div class="row">

            

            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule" name="intitule" required>
              <br>
            </div>
        <!--
            <div class="form-group col-6">
              <label for="bonne_reponse" class="form-label">Bonne réponse</label>
              <input type="text" class="form-control" id="bonne_reponse" name="bonne_reponse" required>

              <br>
            </div>
          -->
          </div>
           


            

     <br>

        <div class="row justify-content-center align-items-center">
         <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer" value="Enregistrer">
         <span id="loader" style="display: none; text-align:center; color:green; font-weight:700">Veuillez patienter...</span>

        </div>  


        </form>

      </div>
    </div>


</div>



<script type="text/javascript">

  document.querySelector("#enregistrer").onclick = function(e){
  e.preventDefault();

  var intitule = document.querySelector("#intitule").value;
  // var question_une = document.querySelector("#question_une").value;
  // var question_deux = document.querySelector("#question_deux").value;
  // var question_trois = document.querySelector("#question_trois").value;
  // var question_quatre = document.querySelector("#question_quatre").value;
  // var bonne_reponse = document.querySelector("#bonne_reponse").value;
  var points = document.querySelector("#points").value;



 if(intitule == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }
  // else if(question_une == '')
  // {
  //   Swal.fire({
  //                 title: 'Information!',
  //                  text: "Veuillez renseigner la première option de réponse!!",
  //                 icon: 'warning',
  //                 showCancelButton: false,
  //                 confirmButtonColor: '#3e53ef',
  //                 cancelButtonColor: '#d33',
  //                 confirmButtonText: 'Ok',
  //                 })
  // }

    
  // else if(question_deux == '')
  // {
  //   Swal.fire({
  //                 title: 'Information!',
  //                  text: "Veuillez renseigner la deuxème option de réponse!!",
  //                 icon: 'warning',
  //                 showCancelButton: false,
  //                 confirmButtonColor: '#3e53ef',
  //                 cancelButtonColor: '#d33',
  //                 confirmButtonText: 'Ok',
  //                 })
  // }

  // else if(question_trois == '')
  // {
  //   Swal.fire({
  //                 title: 'Information!',
  //                  text: "Veuillez renseigner la troisième option de réponse!!",
  //                 icon: 'warning',
  //                 showCancelButton: false,
  //                 confirmButtonColor: '#3e53ef',
  //                 cancelButtonColor: '#d33',
  //                 confirmButtonText: 'Ok',
  //                 })
  // }
  // else if(question_quatre == '')
  // {
  //   Swal.fire({
  //                 title: 'Information!',
  //                  text: "Veuillez renseigner la quatrième option de réponse!!",
  //                 icon: 'warning',
  //                 showCancelButton: false,
  //                 confirmButtonColor: '#3e53ef',
  //                 cancelButtonColor: '#d33',
  //                 confirmButtonText: 'Ok',
  //                 })
  // }
  else if(points == '')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez renseigner le nombre de points de la question!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }

  // else if(bonne_reponse == '')
  // {
  //   Swal.fire({

  //                 title: 'Information!',
  //                  text: "Veuillez renseigner la bonne réponse!!",
  //                 icon: 'warning',
  //                 showCancelButton: false,
  //                 confirmButtonColor: '#3e53ef',
  //                 cancelButtonColor: '#d33',
  //                 confirmButtonText: 'Ok',
  //                 })
  // }


  // else if(bonne_reponse != question_une && bonne_reponse != question_deux && bonne_reponse != question_trois && bonne_reponse != question_quatre)
  // {
  //   Swal.fire({

  //                 title: 'Information!',
  //                  text: "La bonne réponse doit correspondre à l'une des quatre questions!!",
  //                 icon: 'warning',
  //                 showCancelButton: false,
  //                 confirmButtonColor: '#3e53ef',
  //                 cancelButtonColor: '#d33',
  //                 confirmButtonText: 'Ok',
  //                 })
  // }

  else{
      document.querySelector('#chapitre_create').submit();
      $('#enregistrer').prop('disabled', true); // Désactiver l'input
      $('#loader').show(); // Afficher le loader
  }

  }

  </script>
  
@endsection

