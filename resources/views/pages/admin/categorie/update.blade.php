@extends('pages.Dashboard')

@section('content')


<script>
  $(function() {
      $("#type").on('change', function(){
        let valeur = $("#type").val();
        // alert(valeur);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': '<?= csrf_token() ?>'
          },
          type: 'POST',
          url: '{{route('fichier_input')}}',
          data: 'val=' + valeur,
          success: function(param){
            $('#file').html(param)
          },
          error: function(param){
            alert('Une erreur est survenue!')
          }
        });
      });
  });
</script>
    

    

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

      
        <form class="row g-3" method="post" action="{{route('categorie.update', $categorie->id)}}" enctype="multipart/form-data" autocomplete="off" id="categorie_update">
          @csrf
          {{ method_field('PUT') }}

        
          <div class="row">
            <div class="form-group col-12">
              <label for="domaine" class="form-label">Sélectionnez la série (s'il s'agit d'un fascicule) <span style="color: red">*</span></label>
              <select name="domaine" id="domaine" class="chosen-select form-select custom-select">
                @if($domaine_act != null)

                <option value="{{ $domaine_act->id }}">{{ ucfirst($domaine_act->intitule) }}</option>

                <option value="#" disabled>-Autres séries--</option>
                @forelse ($domaines as $domaine)
                  <option value="{{ $domaine->id }}">{{ ucfirst($domaine->intitule) }}</option>
                @empty
                  <option value="#" disabled>Aucun domaine disponible</option>
                @endforelse

                @else

                <option value="#" selected disabled>-Sélectionnez une option--</option>

                  @forelse ($domaines as $domaine)
                    <option value="{{ $domaine->id }}">{{ ucfirst($domaine->intitule) }}</option>
                  @empty
                  <option value="#" disabled>Aucun domaine disponible</option>
                @endforelse

                @endif
              </select>
              <br>
              <br>

            </div>
          </div>

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé</label>
              <input type="text" class="form-control" value="{{ucfirst($categorie->intitule)}}" id="intitule" name="intitule">
              <br>
            </div>
          </div>


          <div class="row">
            <div class="form-group col-12">
              <label for="type" class="form-label">Type de catégorie <span style="color: red">*</span></label>
              <select name="type" id="type" class="chosen-select form-control custom-select">
                <option value="{{$categorie->type}}" selected>
                    @if ($categorie->type === 1)
                      Vidéothèque
                    @elseif($categorie->type === 2)
                      Bibliothèque
                    @elseif($categorie->type === 3)
                      Fascicule
                    @elseif($categorie->type === 4)
                      Job Description
                    @endif
                </option>

                <option value="#" disabled>-Sélectionner une option--</option>
                <option value="1">Vidéothèque</option>
                <option value="2">Bibliothèque</option>
                <option value="3">Fascicule</option>
                <option value="4">Job Description</option>
              </select>
              <br>
              <br>

            </div>
          </div>

          <div class="form-group col-12" id="file">
  
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
  var type = document.querySelector("#type").value;
  var domaine = document.querySelector("#domaine").value;



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
  else if(type == '#'){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez sélectionner le type de la catégorie!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }
  else if(type == 3 && domaine == '#'){
                    Swal.fire({
                        title: 'Information!',
                        text: "Pour ajouter une catégorie de type fascicule, vous devez sélectionner la série de celle-ci!!",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3e53ef',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                  });
}
else if(type != 3 && domaine != '#'){
                    Swal.fire({
                        title: 'Information!',
                        text: "Ce type de catégorie ne peut pas appartenir à une série. Veuillez recharger cette page pour reprendre le processus!!",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3e53ef',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                  });

               
}
else if(type == 1){
              var lien = document.querySelector("#fichier").value;

              if(lien == ''){
                  Swal.fire({ 
                                title: 'Information!',
                                text: "Veuillez renseigner l'image pour la catégorie!!",
                                icon: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#3e53ef',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok',
                                })
              }
              else{
                document.querySelector('#categorie_update').submit();
                $('#enregistrer').prop('disabled', true); // Désactiver l'input
                $('#loader').show(); // Afficher le loader
              }
}
  else{
      document.querySelector('#categorie_update').submit();
      $('#enregistrer').prop('disabled', true); // Désactiver l'input
      $('#loader').show(); // Afficher le loader
  }

  }

  </script>
  

@endsection

