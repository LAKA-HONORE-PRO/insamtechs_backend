@php
use App\Models\Categorie;
  
@endphp

@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('formation.index')}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Formations
  </a>

  &nbsp;
  &nbsp;


  <a href="{{route('create_chapitre', $formation->slug)}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
    <i class=""></i>
    &nbsp;
    Nouveau Chapitre
  </a>
</div>



<div class="pagetitle">
  <h1>Modifier Une Formation</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Formation</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-12 d-flex flex-column align-items-center justify-content-center py-4">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('formation.update', $formation->id)}}" enctype="multipart/form-data" autocomplete="off" id="categorie_update">
          @csrf
          {{ method_field('PUT') }}


          
          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Sélectionnez Catégorie</label>
              <select name="categorie" id="categorie" class="chosen-select form-control custom-select">

                <option value="{{$formation->categorie_id}}">
                    {{ucfirst(Categorie::find($formation->categorie_id)->intitule)}}
                </option>

                <option value="#" disabled>
                  --Sélectionnez une autre catégorie--
                </option>


                @forelse ($categories as $categorie)
                    <option value="{{$categorie->id}}">
                        {{ucfirst($categorie->intitule)}}
                    </option>
                @empty
                    <option value="#">
                      Aucune catégorie enregistrés!
                    </option>
                @endforelse

              </select>
              <br>
              
            </div>
          </div>



          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Intitulé</label>
              <input type="text" class="form-control" value="{{ucfirst($formation->intitule)}}" id="intitule" name="intitule">
              <br>
            </div>
          </div>



          <div class="row">

            <div class="form-group col-4">
              <label for="prix" class="form-label">Prix Unitaire</label>
              <input type="number" class="form-control" value="{{$formation->prix}}" id="prix" name="prix">
              <br>
            </div>

            <div class="form-group col-4">
              <label for="nombre_de_points" class="form-label">Nombre de points</label>
              <input type="number" class="form-control" id="nombre_de_points" value="{{$formation->nombre_de_points}}" name="nombre_de_points">
              <br>
            </div>

            
            <div class="form-group col-4">
              <label for="duree" class="form-label">Durée de la formation</label>
              <input type="time" class="form-control" value="{{$formation->duree}}" id="duree" name="duree">
              <br>
            </div>

          </div>


          <div class="row">

            <div class="form-group col-3">
              <label for="nombre_de_points" class="form-label">Langue de la formation</label>
              <select name="langue" id="langue" class="form-select">
                <option value="{{$formation->langue_formation}}">{{ucfirst($formation->langue_formation)}}</option>

                <option value="#" disabled>--Sélectionnez une autre langue--</option>
                
                <option value="français">Français</option>
                <option value="anglais">Anglais</option>

              </select>
              <br>
            </div>

            
            <div class="form-group col-3">
              <label for="duree" class="form-label">Durée de la composition</label>
              <input type="time" class="form-control" id="duree_composition" value="{{$formation->duree_composition}}" name="duree_composition">
              <br>
            </div>



            
            <div class="form-group col-6">
              <label for="duree" class="form-label"> Image illustrative <span style="color: red">*</span></label>
              <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf,.jpg,.png" required>
              <br>
            </div>

          </div>


          <div class="row">
    
            <div class="form-group col-12">
              <label for="description" class="form-label">Description de la formation</label>
              <textarea name="description" id="description" cols="30" rows="4" class="form-control">{{ucfirst($formation->description)}}</textarea>
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
  var categorie = document.querySelector("#categorie").value;
  var prix = document.querySelector("#prix").value;
  var nbre_points = document.querySelector("#nombre_de_points").value;
  var duree = document.querySelector("#duree").value;
  var description = document.querySelector("#description").value;
  var langue = document.querySelector("#langue").value;
  var duree_composition = document.querySelector("#duree_composition").value;

  

  if(categorie == '#'){
    Swal.fire({
                  title: 'Information!',
                   text: "Sélectionnez la catégorie!!",
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
  }
  else if(nbre_points == 0 || nbre_points == '')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir le nombre de points en cas d'évaluation!!",
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
  }
  else if(duree == '')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez renseigner la durée de la formation!!",
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
  }
  else if(duree_composition == '')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez renseigner la durée de la composition en cas d'évaluation!!",
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
  }
  else if(description == '')
  {
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez renseigner la description!!",
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

