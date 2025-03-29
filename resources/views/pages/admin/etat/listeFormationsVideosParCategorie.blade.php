@php
    use App\Models\Chapitre;
    use App\Models\Video;
@endphp

@extends('pages.Dashboard')

@section('content')


<div class="row justify-content-end align-items-end">
    <a href="{{route('formations_videos_par_categories')}}" class="col-3 btn btn-secondary" id="btnAdd">
        <i class=""></i>
        &nbsp;
        Retour
    </a>
  </div>

<div class="pagetitle">
  {{-- <h1>Liste des formation de {{$categorie->intitule}}</h1> --}}
</div><!-- End Page Title -->


@if(!empty($formations))


       
                     <div class="row">
                       <div>
                       
          
                          <h4 class="titre">Liste des formation de {{$categorie->intitule}} <span><img src="{{URL::asset('assets/img/admin/logo-estuaire.png')}}" style="width:50px" alt=""> </span> </h4> 
                          <hr />
          
                          <div class="row justify-content-end align-items-end">
                              <button class="col-2 btn btn-outline-success" id="btn_export">&nbsp;<i class="bi bi-file-earmark-spreadsheet"></i>
                                  Exporter</button>
                              &nbsp;
                              &nbsp;
                              <button id="printBtn" class="col-3 btn btn-outline-success"><i class="bi bi-file-earmark-arrow-up"></i>
                                  Imprimer</button>
                          </div>
                          <br />
                                
                      @php
                          $i = 0;
                      @endphp
                      
                                                            
                      <table class="table table-striped animate__animated animate__fadeIn" id="for_export">

                        <thead>
                            <th style="font-size:13px">#</th>
                            <th style="font-size:13px">Intitulé</th>
                            {{-- <th style="font-size:13px">Lien</th>
                            <th style="font-size:13px">Option</th>
                            <th style="font-size:13px">Prix</th> --}}


                        </thead>
                      @forelse ($formations as $formation)
                      
                      @php
                          $i = $i + 1;
                          $chapitres = Chapitre::where(['formation_id'=>$formation->id])->get();
                          $i_chap = 0;
                      @endphp





                            
       
                                   
                                <tbody>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ strtoupper($formation->intitule) }}</td>
                                    </tr>
                                </tbody>
  




                                        
                                                                    
                            @empty

                            Aucune données disponible!
              
                            @endforelse


                            
                        </table>

                               <br>
                    
                        
                        </div>




                      </div>
                      
                  </div>


@endif


<script type="text/javascript">
    var printBtn = document.querySelector("#printBtn");
    var btn_export = document.querySelector("#btn_export");
    var top = document.querySelector("#btnAdd");
    var pagetitle = document.querySelector(".pagetitle");
  
  
  
  
    printBtn.addEventListener('click', function() {
        printBtn.style.display = "none";
        btn_export.style.display = "none";
        document.querySelector("#btnAdd").style.display = "none";
        pagetitle.style.display = "none";

  
  
        // option.style.display = "none";
        // pagetitle.style.display = "none";
  
  
        document.querySelector('#header').style.visibility = "hidden";
        document.querySelector('#footer').style.display = "none";
        
        window.print();
  
  
        printBtn.style.display = "";
        btn_export.style.display = "";
        document.querySelector("#btnAdd").style.display = "";
        pagetitle.style.display = "";


     
  
  
  
        // op.style.display = "";
        // option.style.display = "";
        // pagetitle.style.display = "";
        document.querySelector('#header').style.visibility = "visible";
        document.querySelector('#footer').style.display = "";
    })
    </script>
  
@endsection