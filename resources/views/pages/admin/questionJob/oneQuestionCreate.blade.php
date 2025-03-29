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

      
        <form class="row g-3" method="post" action="{{route('storeone_questionjob')}}" autocomplete="off" id="chapitre_create">
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

            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule1" name="intitule1" required>
              <br>
            </div>

            
          </div>



          <div class="row">

            <div class="form-group col-12">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points1" name="points1" required>

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

 if(intitule1 == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'intitulé de la question!!",
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
                    text: "Veuillez renseigner le nombre de points de la question!!",
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

