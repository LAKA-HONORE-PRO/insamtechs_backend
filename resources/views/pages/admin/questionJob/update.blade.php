@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('question_index', $fascicule->slug)}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Questions
  </a>
</div>



<div class="pagetitle">
  <h1>Modifier Une Question</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Questions</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-12 d-flex flex-column align-items-center justify-content-center py-4">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('questionjob_update')}}" autocomplete="off" id="categorie_update">
          @csrf
          {{-- {{ method_field('PUT') }} --}}

          <input type="hidden" name="fascicule_id" value="{{$fascicule->id}}">
          <input type="hidden" name="question_id" value="{{$question->id}}">

          <div class="row">
            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé du fascicule</label>
              <input type="text" class="form-control" id="intitule-chapitre" value="{{ucfirst($fascicule->intitule)}}" name="intitule-chapitre" readonly required>
              <br>
            </div>

            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé de la question</label>
              <input type="text" class="form-control" id="intitule" name="intitule" value="{{ucfirst($question->intitule)}}" required>
              <br>
            </div>
          </div>

          <div class="row">

            <div class="form-group col-12">
              <label for="points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="points" name="points" value="{{ucfirst($question->nombre_de_points)}}" required>

              <br>
            </div>

    
            <div class="form-group col-6">
              {{-- <label for="bonne_reponse" class="form-label">Bonne réponse</label> --}}
              <input type="hidden" class="form-control" id="bonne_reponse" name="bonne_reponse" value="{{ucfirst($question->bonne_reponse)}}" required>

              <br>
            </div>
            
          </div>
           
     <br>

          <div class="row justify-content-center align-items-center">
          <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer" value="Enregistrer">
          </div>  


        </form>

      </div>
    </div>


</div>



<script type="text/javascript">

  document.querySelector("#enregistrer").onclick = function(e){
  e.preventDefault();

  var intitule = document.querySelector("#intitule").value;
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

  else{
      document.querySelector('#categorie_update').submit();
  }

  }

  </script>
  

@endsection

