@extends('pages.Dashboard')

@section('content')
<div class="pagetitle">
    <h1>Liste des jobs par catégorie </h1>
    {{-- <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Etats</li>
        <li class="breadcrumb-item active">Etat Frais Divers Par Ecole</li>
      </ol>
    </nav> --}}
  </div><!-- End Page Title -->
  
  
  <br>
      <!-- Recent Sales -->
      <div class="col-12 " id="top" >
        <div class="card recent-sales">
  
  
          <div class="card-body">
  
  <br />
            
  <div class="row" >
  
  
  <form action="{{route('jobscategorie')}}" method="post" autocomplete="off" id="etudiants_par_ecole">
  @csrf
  <div class="row" >
      <select name="categorie_id" id="categorie_id" class="col chosen-select form-control custom-select" required>
          <option value="#" selected disabled>-- Sélectionnez la catégorie --</option>
        @php
          $i = 0;
        @endphp
           @foreach($categories as $categorie)
         @php
         $i = $i + 1;
       @endphp
                <option value="{{$categorie->id}}"> {{$i.'.     '.'          '.  ucfirst($categorie->intitule)}} </option>
           @endforeach
  
      </select>
      
      &nbsp;
      &nbsp;
      <input type="submit" class="col-2  btn btn-primary" value="Soumettre" id="take">
  
      {{-- <input type="hidden" name="frais" id="frais_id" value="{{$frais_id}}"> --}}
 

  </form>
  
  
      
  
  </div>
  
  <br>
  
          </div>
  
        </div>
      </div><!-- End Recent Sales -->
  

      @endsection