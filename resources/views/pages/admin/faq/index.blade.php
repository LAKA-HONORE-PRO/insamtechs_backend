@extends('pages.Dashboard')


@section('content')
    
<div class="row justify-content-end align-items-end">
  <a href="{{route('faq.create')}}" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Ajouter Une FAQ
  </a>
</div>

<div class="pagetitle">
  <h1>Liste des FAQS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">FAQS</li>
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
                          <th scope="col">Intitulé</th>
                          <th scope="col">Réponse</th>
                          <th scope="col">Lien</th>
                          <th scope="col">Options</th>
                        </tr>
                      </thead>
                      <tbody>

                          @php
                            $i = 0;
                          @endphp

                        @forelse ($faqs as $faq)

                           @php
                              $i = $i + 1;
                           @endphp
                        

                          <tr class="element">
                            <th scope="row">{{$i}}</th>
                            <td class="data">{{ucfirst($faq->intitule)}}</td>
                            <td class="data">{{ucfirst($faq->reponse)}}</td>
                            <td class="data">{{ucfirst($faq->lien)}}</td>

                            <td>
                              <a href="{{route('faq.edit', $faq->id)}}">
                                <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                            </a>

                            &nbsp;

                            {{-- <a href="{{route('faq.destroy', $faq->id)}}">
                              <i class="bi bi-trash" style="font-size:20px; color:red"></i>
                            </a> --}}
                            </td>
                          </tr>
                          
                        @empty

                          <tr>
                            <td colspan = "3">
                              Aucune question disponible pour le moment!

                            </td>
                          </tr>
                          
                        @endforelse
                       
                       
                            
                       
                      </tbody>
       
                    </table>
                    <div class="pagination-links">
                      {{ $faqs->links() }}
                   </div>
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->

              
              
@endsection

