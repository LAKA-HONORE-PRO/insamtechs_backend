@php
use App\Models\Formation;
@endphp

@extends('pages.Dashboard')


@section('content')
    
    <div class="row justify-content-end align-items-end">
      <a href="{{route('create_video', $chapitre->id)}}" target="_blank" class="col-3 btn btn-secondary" id="btnAdd" style="background-color: #0f70b6; border:none">
        <i class=""></i>
        &nbsp;
        Nouvelle Vidéo
      </a>
    </div>

    <div class="pagetitle">
      <h1>Liste des Vidéos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Vidéos</li>
          <li class="breadcrumb-item active">Liste</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <dialog id='modal'>
      <div class="close">
          <span>X</span>
      </div>
      <div>
          {{-- <video src="#" controls></video> --}}

          <iframe width="40" height="20" src="#" frameborder="0"></iframe>

      </div>
  </dialog>

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


                        <a href="{{ route('import_video') }}" class="col-3 btn btn-outline-success" style="background-color: rgb(33, 33, 194); color:white" id="btn_export">
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
                          <th scope="col">Formation</th>
                          <th scope="col">Chapitre</th>
                          <th scope="col">Intitulé de la vidéo</th>
                          <th scope="col">Lien</th>

                          <th scope="col">Options</th>
                        </tr>
                      </thead>
                      <tbody>

                          @php
                            $i = 0;
                          @endphp

                        @forelse ($videos as $video)

                           @php
                              $i = $i + 1;
                           @endphp
                        

                          <tr class="element">
                            <th scope="row">{{$i}}</th>
                            <td class="data">{{ucfirst(Formation::find($chapitre->formation_id)->intitule)}}</td>
                            <td class="data">{{ucfirst($chapitre->intitule)}}</td>
                            <td class="data">{{ucfirst($video->intitule)}}</td>
                            <td class="data">{{$video->lien}}</td>
                            
                            <td>
                              <a href="{{route('video_edit', $video->id)}}">
                                <i class="bi bi-pencil-square" style="font-size:20px;"></i>
                            </a>

                            &nbsp;
                            &nbsp;
                            
                                                        <a href="#" onclick="supprimer({{ $video }})">
                                                          <i class="bi bi-trash3" style="font-size:20px; color:red;"></i>
                                                         </a>
                            {{-- &nbsp; --}}

                              {{-- <span id="{{$video->id}}" class="voir">
                                <i class="bi bi-badge-hd-fill" style="font-size:20px;"></i>
                              </span> --}}
                            </td>
                          </tr>

                        @empty

                          <tr>
                            <td colspan = "6">
                              Aucune vidéo disponible pour le moment!

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

              

{{-- 
              <style>
                .close {
                    display: flex;
                    justify-content: end;
                    margin-bottom: 5px ;
                    margin-top: 0px ;
                    color:black;
                    transition : all 0.3s;
                }
        
                .close:hover span{
                    /* scale(1.1); */
                    cursor:pointer;
                    color:red;
                    transform: rotate(360deg);
                }
        
                .close span {
                    cursor: pointer;
                   transition: 0.5s all;
                    user-select: none;
                }
                dialog {
                    border: none;
                }
                dialog iframe {
                    width: 60vw;
                    height: 70vh;
                }
                dialog::backdrop{
                    background-color: rgba(0, 0, 0, 0.8);
                }
                #modal{
                    /* background-color:#012970; */
                }
            </style>
            <script>
                let close = document.querySelector('.close span');
                let video = document.querySelector('dialog iframe');
                let mod = document.querySelector('dialog');
                let voir = document.querySelectorAll('.voir');
                for(let i = 0 ;  i < voir.length; i++) {
                  
                    voir[i].addEventListener('click', function () {
                        
                        video.src = voir[i].id;
                        mod.showModal();
                    });
                }
                close.onclick = function() {
                    mod.close();
                    iframe.src = '#';
                };
            </script> --}}
              
@endsection

<script>
  function supprimer(video) {

     
      var route = "../video_delete/"+video.id;
      Swal.fire({
          title: 'Attention !',
          showClass: {
              popup: 'animate__animated animate__fadeIn'
          },
          hideClass: {
              popup: 'animate__animated animate__fadeOut'
          },
          text: "Voulez-vous vraiment vous supprimer cet élément ?",
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