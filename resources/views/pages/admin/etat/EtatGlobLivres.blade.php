@php
  use App\Models\Formation;
@endphp
@extends('pages.Dashboard')

@section('content')
<div class="pagetitle">
    <h1>Liste globale des livres</h1>
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
  
  
  <form action="{{route('etatGlobalLivre')}}" method="post" autocomplete="off" id="etudiants_par_ecole">
  @csrf
  <div class="row" >
      <select name="categorie_id" id="categorie_id" class="col chosen-select form-control custom-select" required>
          <option value="#" selected disabled>-- Sélectionnez la catégorie --</option>
          @php
          $i = 0;
        @endphp
           @foreach($categories as $categorie)
           
              @php
              $livres = Formation::where('categorie_id', $categorie->id)->first();
                $i = $i + 1;
              @endphp
                    @if($livres)
                        <option value="{{$categorie->id}}"> {{$i.'.     '.'          '.  ucfirst($categorie->intitule)}} </option>
                    @endif
          @endforeach
          <option value="tout">Toutes les catégories</option>
  
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