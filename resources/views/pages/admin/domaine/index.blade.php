@php
use App\Models\Branche;
@endphp
@extends('pages.Dashboard')


@section('content')
    
<div class="row justify-content-end align-items-end">
  <a href="{{route('domaine.create')}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Ajouter Une Série
  </a>
</div>

<div class="pagetitle">
  <h1>Liste des Séries</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Séries</li>
      <li class="breadcrumb-item active">Liste</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<br>
            <!-- Recent Sales -->
            <div class="col-12 ">
                <div class="card recent-sales overflow-auto">
  
   
                  <div class="card-body">
                    <br>

                    <div class="row">

                        <div class="row col-6 justify-content-before align-items-before">
                          <button class="col-3 btn btn-outline-success" id="btn_export" style="background-color: rgb(27, 123, 27); color:white">
                            Exporter  &nbsp;<i class="bi bi-file-earmark-spreadsheet"></i>
                        </button>

                        &nbsp;
                        &nbsp;

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
                          <th scope="col">Filière</th>
                          <th scope="col">Intitulé</th>
                          <th scope="col">Options</th>
                        </tr>
                      </thead>
                      <tbody>

                          @php
                            $i = 0;
                          @endphp

                        @forelse ($domaines as $domaine)

                           @php
                              $i = $i + 1;
                           @endphp
                        

                          <tr class="element">
                            <th scope="row">{{$i}}</th>
                            <td class="data">
                              @if($domaine->branche_id != NULL)
                              {{ucfirst(Branche::find($domaine->branche_id)->intitule)}}
                              @else
                               Non définie pour le moment.
                              @endif

                            </td>

                            <td class="data">{{ucfirst($domaine->intitule)}}</td>

                            <td>
                              <a href="{{route('domaine.edit', $domaine->slug)}}">
                                <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                            </a>
                            </td>
                          </tr>
                          
                        @empty

                          <tr>
                            <td colspan = "3">
                              Aucune catégorie disponible pour le moment!

                            </td>
                          </tr>
                          
                        @endforelse
                       
                       
                            
                       
                      </tbody>
       
                    </table>
                    <div class="pagination-links">
                      {{ $domaines->links() }}
                   </div>
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->

              
              
@endsection

