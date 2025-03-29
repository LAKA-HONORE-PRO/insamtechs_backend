@php
use App\Models\Formation;
@endphp

@extends('pages.Dashboard')


@section('content')
    
<div class="row justify-content-end align-items-end">
  <a href="{{route('create_question', $fascicule->slug)}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
    <i class=""></i>
    &nbsp;
    Nouvelle Question
  </a>
</div>

<div class="pagetitle">
  <h1>Liste des Questions</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Questions</li>
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
                          <th scope="col">Fascicule</th>
                          <th scope="col">Intitulé</th>
                       <!--   <th scope="col">Bonne réponse</th>-->
                          <th scope="col">Nombre de points</th>
                    <!--      <th scope="col">Option 1</th>
                          <th scope="col">Option 2</th>
                          <th scope="col">Option 3</th>
                          <th scope="col">Option 4</th>-->
                          <th scope="col">Options</th>
                        </tr>
                      </thead>
                      <tbody>

                          @php
                            $i = 0;
                          @endphp

                        @forelse ($questions as $question)

                           @php
                              $i = $i + 1;
                           @endphp
                        

                          <tr class="element">
                            <th scope="row">{{$i}}</th>
                            <td class="data">{{ucfirst(Formation::find($question->formation_id)->intitule)}}</td>
                            <td class="data">{{ucfirst($question->intitule)}}</td>
                           <!-- <td class="data">{{ucfirst(substr($question->bonne_reponse, 0, 20))}}...</td> -->
                            <td class="data">{{ucfirst($question->nombre_de_points)}}</td>
                           <!-- <td class="data">{{ucfirst(substr($question->question_une, 0, 10))}}...</td>
                            <td class="data">{{ucfirst(substr($question->question_deux, 0, 10))}}...</td>
                            <td class="data">{{ucfirst(substr($question->question_trois, 0, 10))}}...</td>
                            <td class="data">{{ucfirst(substr($question->question_quatre, 0, 10))}}...</td>
                          -->

                            <td>
                              <a href="{{route('question_edit', $question->id)}}">
                                <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                            </a>
&nbsp;
&nbsp;
                          
                        @empty

                          <tr>
                            <td colspan = "4">
                              Aucune Question disponible pour le moment!

                            </td>
                          </tr>
                          
                        @endforelse
                       
                       
                            
                       
                      </tbody>
       
                    </table>
                    {{-- <div class="pagination-links">
                      {{ $chapitres->links() }}
                   </div> --}}
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->

              
              
@endsection

