@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('bibliotheques.index')}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Livres
  </a>
</div>


<div class="pagetitle">
  <h1>Ajouter Un Livre</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Livres</li>
      <li class="breadcrumb-item active">Ajouter</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-12 d-flex flex-column align-items-center justify-content-center py-4">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('bibliotheques.store')}}" enctype="multipart/form-data" autocomplete="off" id="formation_create" >
          @csrf
        

          <div class="row">
            <div class="form-group col-6">
              <label for="categorie" class="form-label">Sélectionnez Catégorie <span style="color: red">*</span></label>
              
              <br>

              <select name="categorie" id="categorie" class="chosen-select form-control custom-select">

                <option value="#" selected disabled>
                  --Sélectionnez une catégorie--
                </option>


                @forelse ($categories as $categorie)
                    <option value="{{$categorie->id}}">
                        {{ucfirst($categorie->intitule)}}
                    </option>
                @empty
                    <option value="#" disabled>
                      Aucune catégorie enregistrée pour le moment !
                    </option>
                @endforelse

              </select>

    
              <br>
            </div>


            <div class="form-group col-6">
              <label for="intitule" class="form-label">Intitulé <span style="color: red">*</span></label>
              <input type="text" class="form-control" id="intitule" name="intitule">
              <br>
            </div>
          </div>

          <div class="row">

            <div class="form-group col-6">
              <label for="prix" class="form-label">Prix Unitaire <span style="color: red">*</span></label>
              <input type="number" class="form-control" value="0" id="prix" name="prix">
              <br>
            </div>

      

            <div class="form-group col-6">
              <label for="nombre_de_points" class="form-label">Langue du Livre <span style="color: red">*</span></label>
              <select name="langue" id="langue" class="form-select">

                <option value="#" disabled>--Sélectionnez une langue--</option>
                
                <option value="français" selected>Français</option>
                <option value="anglais">Anglais</option>

              </select>
              <br>
            </div>

          </div>


          <div class="row">
              <div class="form-group col-6">
                <label for="duree" class="form-label">Lien du livre <span style="color: red">*</span></label>
                <input type="text" class="form-control" id="fichier" name="fichier" required>
                <br>
              </div>

              <div class="form-group col-6">
                <label for="duree" class="form-label">Accessibilité du document <span style="color: red">*</span></label>
                <select name="acces" id="acces" class="form-select">
                  <option value="#"  disabled>--Séléctionnez--</option>
                  <option value="0" selected>Téléchargeable</option>
                  <option value="1">Non Téléchargeable</option>
                </select>
                <br>
              </div>
          </div>

          
          <div class="row">
    
            <div class="form-group col-12">
              <label for="description" class="form-label">Description de la formation</label>
              <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
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

  var intitule = document.querySelector("#intitule").value;
  var categorie = document.querySelector("#categorie").value;
  var prix = document.querySelector("#prix").value;
  var description = document.querySelector("#description").value;
  var langue = document.querySelector("#langue").value;
  var acces = document.querySelector("#acces").value;

  

  if(categorie == '#'){
    Swal.fire({
                  title: 'Information!',
                   text: "Sélectionnez la catégorie!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }
 else if(intitule == ''){
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
  else if(prix == '')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir le prix unitaire!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }

  
  else if(langue == '#')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez sélectionner la langue de la formation!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }

  else if(acces == '#')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez sélectionner l'accessibilité du document'!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }
//   else if(description == '')
//   {
//     Swal.fire({
//                   title: 'Information!',
//                   text: "Veuillez renseigner la description du livre!!",
//                   icon: 'warning',
//                   showCancelButton: false,
//                   confirmButtonColor: '#3e53ef',
//                   cancelButtonColor: '#d33',
//                   confirmButtonText: 'Ok',
//                   })
//   }

  else{
      document.querySelector('#formation_create').submit();
      $('#enregistrer').prop('disabled', true); // Désactiver l'input
      $('#loader').show(); // Afficher le loader
  }

  }

  </script>
  
@endsection

