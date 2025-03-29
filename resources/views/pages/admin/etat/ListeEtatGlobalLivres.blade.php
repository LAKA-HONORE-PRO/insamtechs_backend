@php
    use App\Models\Chapitre;
    use App\Models\Formation;
@endphp

@extends('pages.Dashboard')

@section('content')


<div class="row justify-content-end align-items-end">
    <a href="{{route('etat_global_livres')}}" class="col-3 btn btn-secondary" id="btnAdd">
        <i class=""></i>
        &nbsp;
        Retour
    </a>
  </div>

<div class="pagetitle">
  {{-- <h1>Liste des formation de {{$categorie->intitule}}</h1> --}}
</div><!-- End Page Title -->


@if(!empty($categories))

        @if(sizeOf($categories) > 0)
       
                <div class="row">
                       <div>
                       
          
                          <h4 class="titre">Etat Global des livres<span><img src="{{URL::asset('assets/img/admin/logo-estuaire.png')}}" style="width:50px" alt=""> </span> </h4> 
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
                          $i_cat = 0;
                          @endphp
                            
                            @forelse ($categories as $categorie)

                            @php
                                $livres= Formation::where(['categorie_id'=>$categorie->id])->get();
                                $i_cat = $i_cat + 1;
                            @endphp
                           
                            @if(sizeof($livres)>0)
                            <br><br>
                            <h4 style="color: black; font-weight:bold; font-size:15px;"> Catégorie {{ $i_cat }} : {{strtoupper($categorie->intitule)}} </h4> 
                            <hr>

                                      
                            <table class="table table-striped animate__animated animate__fadeIn" id="for_export">

                                <thead>
                                    <th style="font-size:13px">#</th>
                                    <th style="font-size:13px">Intituté</th>
                                   {{-- <th style="font-size:13px">Langue</th>--}}
                                    {{-- <th style="font-size:13px">Prix</th> --}}

                                </thead>

                                    <tbody>
                                        @forelse($livres as $livre)
                                            @php
                                                $i = $i + 1;
                                            @endphp
                                            <tr class="elemen">
                                                <th style="padding: 1px;font-size:13px">{{$i}}</td>
                                                <td style="padding: 1px; font-size:13px">{{strtoupper($livre->intitule)}}</td>
                                            {{-- <td style="padding: 1px; font-size:13px">{{strtoupper($formation->langue_formation)}}</td>--}}
                                                {{-- <td style="padding: 1px; font-size:13px">{{$formation->prix}}</td>  --}}
                                            </tr>
                                        @empty
                                            Aucune livre disponible!
                                        @endforelse
                                    </tbody>
                            



                            </table>
                        @endif
                                                                    
                            @empty

                            Aucune données disponible!
              
                            @endforelse
                               <br>
                    
                        
                        </div>




                      </div>
                      
                  </div>


        @endif


@endif




@if(!empty($livres))

        @if(sizeOf($livres) > 0)
        <div class="row">
            <div>
            

               <h4 class="titre">Liste des livres de {{$categorie->intitule}} <span><img src="{{URL::asset('assets/img/admin/logo-estuaire.png')}}" style="width:50px" alt=""> </span> </h4> 
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
             

     
                           
                 <table class="table table-striped animate__animated animate__fadeIn" id="for_export">

                     <thead>
                         <th style="font-size:13px">#</th>
                         <th style="font-size:13px">Intituté</th>
                         

                         {{-- <th style="font-size:13px">Prix</th> --}}


                     </thead>

                  @php
                     $i = 0;
                 @endphp
                 
                 @forelse ($livres as $livre)
                     
                 @php
                     $i = $i + 1;
                 @endphp
                 


                             <tr class="elemen">
                                 <th style="padding: 1px;font-size:13px">{{$i}}</td>
                                 <td style="padding: 1px; font-size:13px">{{strtoupper($livre->intitule)}}</td>

                                 {{-- <td style="padding: 1px; font-size:13px">{{$formation->prix}}</td>  --}}
                             </tr>


       

                                     
                             @empty

                             Aucune donnée disponible!
               
                             @endforelse





                 </table>
                             
                    <br>
             
             </div>




           </div>
       </div>

        @else
                        Aucun livres disponible pour cette catégorie
        @endif

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