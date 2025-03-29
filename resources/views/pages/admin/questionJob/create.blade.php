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

      
        <form class="row g-3" method="post" action="{{route('store_questionjob')}}" autocomplete="off" id="chapitre_create">
          @csrf

          <input type="hidden" name="fascicule_id" value="{{$fascicule->id}}">

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé du fascicule</label>
              <input type="text" class="form-control" id="intitule-chapitre" value="{{ucfirst($fascicule->intitule)}}" name="intitule-chapitre" readonly required>
              <br>
            </div>

          </div>

          <div class="row">

            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule1" name="intitule1" required>
              <br>
            </div>


            <div class="form-group col-6">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points1" name="points1" required>

              <br>
            </div>
            
          </div>



          <div class="row">

            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule2" name="intitule2" required>
              <br>
            </div>


            <div class="form-group col-6">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points2" name="points2" required>

              <br>
            </div>
            
          </div>



          <div class="row">

            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule3" name="intitule3" required>
              <br>
            </div>


            <div class="form-group col-6">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points3" name="points3" required>

              <br>
            </div>
            
          </div>




          <div class="row">

            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule4" name="intitule4" required>
              <br>
            </div>


            <div class="form-group col-6">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points4" name="points4" required>

              <br>
            </div>
            
          </div>



          <div class="row">

            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule5" name="intitule5" required>
              <br>
            </div>


            <div class="form-group col-6">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points5" name="points5" required>

              <br>
            </div>
            
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

  var intitule1 = document.querySelector("#intitule1").value;
  var points1 = document.querySelector("#points1").value;


  var intitule2 = document.querySelector("#intitule2").value;
  var points2 = document.querySelector("#points2").value;


  var intitule3 = document.querySelector("#intitule3").value;
  var points3 = document.querySelector("#points3").value;


  var intitule4 = document.querySelector("#intitule4").value;
  var points4 = document.querySelector("#points4").value;

  var intitule5 = document.querySelector("#intitule5").value;
  var points5 = document.querySelector("#points5").value;

 if(intitule1 == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé de la question 1!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }

   else if(points1 == '')
   {
     Swal.fire({
                   title: 'Information!',
                    text: "Veuillez renseigner le nombre de points de la question 1!!",
                   icon: 'warning',
                   showCancelButton: false,
                   confirmButtonColor: '#3e53ef',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Ok',
                   })
   }
   elseif(intitule2 == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé de la question 2!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
   }
   else if(points2 == '')
   {
     Swal.fire({
                   title: 'Information!',
                    text: "Veuillez renseigner le nombre de points de la question 2!!",
                   icon: 'warning',
                   showCancelButton: false,
                   confirmButtonColor: '#3e53ef',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Ok',
                   })
   }

   elseif(intitule3 == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé de la question 3!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
   }
   else if(points3 == '')
   {
     Swal.fire({
                   title: 'Information!',
                    text: "Veuillez renseigner le nombre de points de la question 3!!",
                   icon: 'warning',
                   showCancelButton: false,
                   confirmButtonColor: '#3e53ef',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Ok',
                   })
   }
   

   elseif(intitule4 == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé de la question 4!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
   }
   else if(points4 == '')
   {
     Swal.fire({
                   title: 'Information!',
                    text: "Veuillez renseigner le nombre de points de la question 4!!",
                   icon: 'warning',
                   showCancelButton: false,
                   confirmButtonColor: '#3e53ef',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Ok',
                   })
   }
   

   elseif(intitule5 == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé de la question 5!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
   }
   else if(points5 == '')
   {
     Swal.fire({
                   title: 'Information!',
                    text: "Veuillez renseigner le nombre de points de la question 5!!",
                   icon: 'warning',
                   showCancelButton: false,
                   confirmButtonColor: '#3e53ef',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Ok',
                   })
   }
   

  else{
      document.querySelector('#chapitre_create').submit();
      $('#enregistrer').prop('disabled', true); // Désactiver l'input
      $('#loader').show(); // Afficher le loader
  }

  }

  </script>
  
@endsection

