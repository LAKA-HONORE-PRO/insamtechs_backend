@php
use App\Models\Categorie;
  
@endphp

@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('job.index')}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Job Descriptions
  </a>

  &nbsp;
  &nbsp;


  <a href="{{route('create_questionjob', $job->slug)}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
    <i class=""></i>
    &nbsp;
    Ajouter Une Question
  </a>
</div>



<div class="pagetitle">
  <h1>Modifier Un Job Description</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Job Description</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-12 d-flex flex-column align-items-center justify-content-center py-4">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('job.update', $job->id)}}" enctype="multipart/form-data" autocomplete="off" id="categorie_update">
          @csrf
          {{ method_field('PUT') }}


          
          <div class="row">
            <div class="form-group col-6">
              <label for="intitule" class="form-label">Sélectionnez Catégorie</label>
              <select name="categorie" id="categorie" class="form-select">

                <option value="{{$job->categorie_id}}">
                    {{ucfirst(Categorie::find($job->categorie_id)->intitule)}}
                </option>

                <option value="#" readOnly>
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
      



          <div class="form-group col-6">
            <label for="intitule" class="form-label">Intitulé</label>
            <input type="text" class="form-control" id="intitule" name="intitule" value="{{$job->intitule}}">
            <br>
          </div>
        </div>

        <div class="row">

          <div class="form-group col-6">
            <label for="prix" class="form-label">Prix Unitaire</label>
            <input type="number" class="form-control" id="prix" name="prix" value="{{$job->prix}}" readOnly>
            <br>
          </div>

          <div class="form-group col-6">
            <label for="nombre_de_points" class="form-label">Nombre de points</label>
            <input type="number" class="form-control" id="nombre_de_points" name="nombre_de_points" value="{{$job->nombre_de_points}}">
            <br>
          </div>

        </div>



        <div class="row">


          <div class="form-group col-6">
            <label for="nombre_de_points" class="form-label">Langue de la formation</label>
            <select name="langue" id="langue" class="form-select" readOnly>
              <option value="{{$job->langue_formation}}">{{ucfirst($job->langue_formation)}}</option>

              <option value="#" readOnly>--Sélectionnez une autre langue--</option>
              
              <option value="français">Français</option>
              <option value="anglais">Anglais</option>

            </select>
            <br>
          </div>

          
          <div class="form-group col-6">
            <label for="duree" class="form-label">Durée de la composition</label>
            <input type="text" class="form-control" id="duree_composition" value="{{$job->duree_composition}}" name="duree_composition" readOnly>
            <br>
          </div>

        </div>


        <div class="row">
            <div class="form-group col-6">
              <label for="duree" class="form-label">Téléverser un fichier</label>
              <input type="text" class="form-control" id="fichier" name="fichier" value="{{ $job->lien }}" required readOnly>
              {{-- <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf,.jpg,.png" required readOnly> --}}
              <br>
            </div>
            
            {{-- <div class="form-group col-6">
                <label for="duree" class="form-label">Lien du livre <span style="color: red">*</span></label>
                <input type="text" class="form-control" id="fichier" name="fichier" value="{{$job->lien}}" required>
                <br>
              </div>--}}


            {{-- <div class="form-group col-6">
              <label for="duree" class="form-label">Accessibilité du document <span style="color: red">*</span></label>
              <select name="acces" id="acces" class="form-select" readOnly>
                <option value="{{$job->telechargeable}}" selected>
                  @if ($job->telechargeable === 0)
                    Téléchargeable
                  @else
                    Non Téléchargeable
                  @endif
                </option>
                
                <option value="#"  readOnly>--Séléctionnez--</option>
                <option value="0">Téléchargeable</option>
                <option value="1">Non Téléchargeable</option>
              </select>
              <br>
           </div> --}}
        </div>
      
          


     <br>

          <div class="row justify-content-center align-items-center">
          <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer" value="Enregistrer">
          </div>  


        </form>

      </div>
    </div>


</div>





@endsection

