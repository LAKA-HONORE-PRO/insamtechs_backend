@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('categorie.index')}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Catégories
  </a>
</div>



<div class="pagetitle">
  <h1>Modifier Une Catégories</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Catégories</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-7">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('chapitre_update')}}" autocomplete="off" id="categorie_update">
          @csrf
          {{-- {{ method_field('PUT') }} --}}

          <input type="hidden" name="chapitre_id" value="{{$chapitre->id}}">
          <input type="hidden" name="formation_id" value="{{$formation->id}}">

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé du formation</label>
              <input type="text" class="form-control" id="intitule-chapitre" value="{{ucfirst($formation->intitule)}}" name="intitule-chapitre" readonly required>
              <br>
            </div>
          </div>
        

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé</label>
              <input type="text" class="form-control" id="intitule" value="{{ucfirst($chapitre->intitule)}}" name="intitule"  required>
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




 if(intitule == '')
  {
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
  else{
      document.querySelector('#categorie_update').submit();
  }

  }

  </script>
  

@endsection

