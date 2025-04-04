@php
use App\Models\Categorie;
@endphp

@extends('pages.Dashboard')


@section('content')
    
<div class="row justify-content-end align-items-end">
  <a href="{{route('bibliotheques.create')}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Ajouter Un Livre
  </a>

</div>

<div class="pagetitle">
  <h1>Liste des Livres</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Livres</li>
      <li class="breadcrumb-item active">Liste</li>
    </ol>
  </nav>
</div>


<br>
            <div class="col-12 ">
                <div class="card recent-sales overflow-auto">
  
   
                  <div class="card-body">
                    <br>

                    <div class="row">

                        <div class="row col-6 justify-content-before align-items-before">
                            <button class="col-3 btn btn-outline-success" id="btn_export">
                                Exporter  &nbsp;<i class="bi bi-file-earmark-spreadsheet"></i>
                            </button>
                        </div>


                        


                        <div class="row col-6" id="searchBar">
                            <div class="col-12 form-group">
                                <input type="search" id="recherche" class="form-control" placeholder="Rechercher..." />
                            </div>
                        </div>

                        

                    </div>
                    <hr>
               
                    <br />
                  
  
                    <table class="table table-bordercollapsed datatab" id="for_export">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Catégorie</th>
                          <th scope="col">Intitulé</th>
                          <th scope="col">Langue</th>
                          <th scope="col">Prix Unitaire</th>
                          <th scope="col">Durée Composition</th>
                          <th scope="col">Nombre de Points</th>
                          <th scope="col">Accessibilité</th>
                          <th scope="col">Options</th>
                        </tr>
                      </thead>
                      <tbody>

                          @php
                            $i = 0;
                          @endphp

                        @forelse ($bibliotheques as $bibliotheque)

                           @php
                              $i = $i + 1;
                           @endphp
                        

                          <tr class="element">
                            <th scope="row">{{$i}}</th>
                            <td class="data">{{ucfirst(Categorie::find($bibliotheque->categorie_id)->intitule)}}</td>
                            <td class="data">{{ucfirst($bibliotheque->intitule)}}</td>
                            <td class="data">{{ucfirst($bibliotheque->langue_formation)}}</td>
                            <td class="data">{{($bibliotheque->prix)}} Fcfa</td>
                            <td class="data">{{($bibliotheque->duree_composition)}} min</td>
                            <td class="data">{{($bibliotheque->nombre_de_points)}} pts</td>
                            <td class="data">
                              @if ($bibliotheque->telechargeable === 0)
                                  Téléchargeable
                              @else
                                  Non Téléchargeable
                              @endif
                            </td>
                            
                            <td>
                              <a href="{{route('bibliotheques.edit', $bibliotheque->slug)}}">
                                <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                            </a>
                            
                            </td>
                          </tr>
                          
                        @empty

                          <tr>
                            <td colspan = "9">
                              Aucun Livre disponible pour le moment!

                            </td>
                          </tr>
                          
                        @endforelse
                       
                       
                            
                       
                      </tbody>

                    </table>
                    {{$bibliotheques->links()}}
  
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->

              
              
@endsection

