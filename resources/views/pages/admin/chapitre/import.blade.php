@extends('pages.Dashboard')

@section('content')
    



<div class="pagetitle">
  <h1>Chapitres</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Importer</li>
      <li class="breadcrumb-item active">Importer</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-7">

@if ($errors->any())
<ul class="alert alert-success" >
       @foreach ($errors->all() as $error)
        <li style="list-style:none; text-align:center">{{ $error }}</li>
        @endforeach
</ul>

@endif

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('import_chapitre_create')}}" autocomplete="off" id="myForm" enctype="multipart/form-data">
          @csrf
        

          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">file <span style="color: red">*</span></label>
              <input type="file" class="form-control" id="file" name="file">
              <br>
            </div>
          </div>

                  
              <br>
              <br>
              <br>


            


        <div class="row justify-content-center align-items-center">
         <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="submitBtn" value="Enregistrer">
        </div>  


        </form>

      </div>
    </div>


</div>




  
@endsection

