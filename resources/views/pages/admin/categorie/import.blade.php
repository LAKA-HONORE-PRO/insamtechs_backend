@extends('pages.Dashboard')

@section('content')
    


<div class="pagetitle">
  <h1>Catégories</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Importer</li>
      <li class="breadcrumb-item active">Importer</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

@if ($errors->any())
<ul class="alert alert-success" >
       @foreach ($errors->all() as $error)
        <li style="list-style:none; text-align:center">{{ $error }}</li>
        @endforeach
</ul>

@endif


<div class="col-lg-7">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('import_categorie_create')}}" id="myForm" autocomplete="off" enctype="multipart/form-data">
          @csrf
        

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">file <span style="color: red">*</span></label>
              <input type="file" class="form-control" id="file" name="file" required>
              <br>
            </div>
          </div>

        
          </div>

         <span id="loader" style="display: none; color:blueviolet; text-align:center">Veuillez patienter...</span>

     <br>

        <div class="row justify-content-center align-items-center">
          
         <input type="submit" class="col-4 btn btn-primary" id="submitBtn" name="enregistrer" value="Enregistrer">
        </div>  

        <br>
        <br>

        </form>

      </div>
    </div>


</div>




  
@endsection

