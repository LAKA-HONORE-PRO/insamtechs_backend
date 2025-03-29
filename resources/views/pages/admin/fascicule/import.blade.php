@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('import_save')}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Catégories
  </a>
</div>



<div class="pagetitle">
  <h1>Ajouter Une Catégorie</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Catégorie</li>
      <li class="breadcrumb-item active">Ajouter</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-7">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('import_save')}}" autocomplete="off" id="myForm" enctype="multipart/form-data">
          @csrf
        

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">file <span style="color: red">*</span></label>
              <input type="file" class="form-control" id="file" name="file">
              <br>
            </div>
          </div>

        
          </div>

            

     <br>

        <div class="row justify-content-center align-items-center">
         <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="submitBtn" value="Enregistrer">
        </div>  


        </form>

      </div>
    </div>


</div>




  
@endsection

