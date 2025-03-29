@extends('pages.Dashboard')

@section('content')


<div class="row justify-content-end align-items-end">
    <a href="{{route('fascicules_par_categorie')}}" class="col-3 btn btn-secondary" id="btnAdd">
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
                       
          
                          <h4 class="titre">Liste des fascicules de {{$categorie->intitule}} <span><img src="{{URL::asset('assets/img/admin/logo-estuaire.png')}}" style="width:50px" alt=""> </span> </h4> 
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
                                    <th style="font-size:13px">Lien</th>
                                    <th style="font-size:13px">Option</th>
                                    <th style="font-size:13px">Etat</th>



                                </thead>
        
                             @php
                                $i = 0;
                            @endphp
                            
                            @forelse ($formations as $formation)
                                
                            @php
                                $i = $i + 1;
                            @endphp
                            
       

                                        <tr class="elemen">
                                            <th style="padding: 1px;font-size:13px">{{$i}}</td>
                                            <td style="padding: 1px; font-size:13px">{{strtolower($formation->intitule)}}</td>
                                            <td style="padding: 1px; font-size:13px">{{ucfirst($formation->lien)}}</td>
                                            <td style="padding: 1px; font-size:13px">
                                                <a href="{{route('fascicule.edit', $formation->slug)}}" target="_blank">
                                                    <i class="bi bi-pencil-square" style="font-size:20px; color:blue"></i>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                                <a href="#" onclick="supprimer({{ $formation }})">
                                                    <i class="bi bi-trash" style="font-size:20px; color:red"></i>
                                                </a>
                                                <a href="{{ route('question_index', $formation->slug) }}" class="plus">
                                                    Voir plus
                                                   </a>
                                            </td>
                                            <td>
                                            <form action="{{route('update_etat_fascicule')}}" method="POST">
                                                @csrf

                                                <button type="submit" class="<?=$formation->etat === 0 ? 'btn btn-success' : 'btn btn-danger' ?>">

                                                <input type="hidden" name="booklet_id" value="{{$formation->id}}" id="">
                                                @if($formation->etat == 0)
                                                    Lancer l'examen
                                                @else
                                                    Arrêter l'examen
                                                @endif
                                                </button>

                                            </form>
                                            </td>
                                        </tr>


                  

                                                
                                        @empty

                                        Aucune donnée disponible!
                          
                                        @endforelse
  




                            </table>
                                        
                               <br>
                        
                        </div>




                      </div>
                  </div>



                  <script>
                    function supprimer(formation) {
                        
                        var route = 'supprimer_fascicule/'+formation['slug'];
                        Swal.fire({
                            title: 'Attention !',
                            showClass: {
                                popup: 'animate__animated animate__fadeIn'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOut'
                            },
                            text: "Voulez-vous vraiment vous supprimer ?",
                            icon: 'question',
                            confirmButtonColor: '#4154f1',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oui',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let timerInterval
                                Swal.fire({
                                    title: 'Attention!',
                                    html: 'Suppression en cours...',
                                    timer: 3000,
                                    icon: 'info',
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        const b = Swal.getHtmlContainer().querySelector('.azerty')
                                        timerInterval = setInterval(() => {
                                            b.textContent = Swal.getTimerLeft()
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.href = route;
                                        // console.log('I was closed by the timer')
                                    }
                                })
                            }
                        })
                  
                    }
                  </script>


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