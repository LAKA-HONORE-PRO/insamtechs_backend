@php
    use App\Models\Chapitre;
    use App\Models\Video;
@endphp

@extends('pages.Dashboard')

@section('content')


<div class="row justify-content-end align-items-end">
    <a href="{{route('videos_par_categories')}}" class="col-3 btn btn-secondary" id="btnAdd">
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
                      
                      @forelse ($formations as $formation)
                      
                      @php
                          $i = $i + 1;
                          $chapitres = Chapitre::where(['formation_id'=>$formation->id])->get();
                          $i_chap = 0;
                      @endphp
                        <br>
                        <br>
                        <h4 class="titre" style="font-weight:700"> Formation :  {{ucfirst($formation->intitule)}} </h4> 

                        <hr>
                        <br>
                        <br>

                            @forelse($chapitres as $chapitre)
                
                            @php
                                $i_chap = $i_chap + 1;
                                $i_vid = 0;
                                $videos = Video::where(['chapitre_id'=>$chapitre->id])->get();
                            @endphp
  
                            <h4 style="color: black; font-weight:bold; font-size:15px;"> Chapitre {{ $i_chap }}:  {{ucfirst($chapitre->intitule)}} </h4> 

                                      
                            <table class="table table-striped animate__animated animate__fadeIn" id="for_export">

                                <thead>
                                    <th style="font-size:13px">#</th>
                                    <th style="font-size:13px">Intituté</th>
                                    <th style="font-size:13px">Lien</th>
                                    <th style="font-size:13px">Option</th>
                                    {{-- <th style="font-size:13px">Prix</th> --}}


                                </thead>

                            
       
                                    @forelse($videos as $video)

                                            @php
                                                $i_vid = $i_vid + 1;
                                            @endphp
                                        <tr class="elemen">
                                            <th style="padding: 1px;font-size:13px">{{$i_vid}}</td>
                                            <td style="padding: 1px; font-size:13px">{{ucfirst($video->intitule)}}</td>
                                           {{-- <td style="padding: 1px; font-size:13px">{{ucfirst($formation->langue_formation)}}</td>--}}
                                            <td style="padding: 1px; font-size:13px">{{$video->lien}}</td>
                                            <td>
                                                <a href="{{route('video_edit', $video->id)}}" target="_blank">
                                                    <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        @empty

                                        Aucune vidéo disponible pour ce chapitre    !
                          
                                        @endforelse


  




                            </table>

                            @empty

                            Aucun  chapitre disponible pour cette formation!
              
                            @endforelse
                                        
                                                                    
                            @empty

                            Aucune données disponible!
              
                            @endforelse
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