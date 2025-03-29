@php
use App\Models\Categorie;
@endphp

@extends('pages.Dashboard')


@section('content')
    
<div class="row justify-content-end align-items-end">
  <a href="{{route('job.create')}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Ajouter Un Job Description
  </a>

</div>

<div class="pagetitle">
  <h1>Liste des Job Descriptions</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Job Descriptions</li>
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
                            <button class="col-3 btn btn-outline-success" id="btn_export" style="background-color: rgb(27, 123, 27); color:white">
                                Exporter  &nbsp;<i class="bi bi-file-earmark-spreadsheet"></i>
                            </button>

                            &nbsp;
                            &nbsp;


                            <a href="{{ route('import_job') }}" class="col-3 btn btn-outline-success" style="background-color: rgb(33, 33, 194); color:white" id="btn_export">
                              Importer  &nbsp;<i class="bi bi-download"></i>
                            </a>
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
                          <th scope="col">Nombre de Points</th>
                          <th scope="col">Options</th>
                        </tr>
                      </thead>
                      <tbody>

                          @php
                            $i = 0;
                          @endphp

                        @forelse ($jobs as $job)

                           @php
                              $i = $i + 1;
                           @endphp
                        

                          <tr class="element">
                            <th scope="row">{{$i}}</th>
                            <td class="data">{{ucfirst(Categorie::find($job->categorie_id)->intitule)}}</td>
                            <td class="data">{{ucfirst($job->intitule)}}</td>
                            <td class="data">{{($job->nombre_de_points)}} pts</td>

                            
                            <td>
                              <a href="{{route('job.edit', $job->slug)}}">
                                <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                             </a> 

                             &nbsp;
                             &nbsp;
 
                             <a href="{{route('questionjob_index', $job->slug)}}" class="plus">
                               Voir plus
                              </a>
                            </td>
                          </tr>
                          
                        @empty

                          <tr>
                            <td colspan = "9">
                              Aucun Job Description disponible pour le moment!

                            </td>
                          </tr>
                          
                        @endforelse
                       
                       
                            
                       
                      </tbody>

                    </table>
                    {{$jobs->links()}}
  
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->

              
              
@endsection

