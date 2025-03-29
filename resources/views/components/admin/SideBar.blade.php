  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Tableau de Bord</span>
        </a>
      </li><!-- End Dashboard Nav -->

    



      <li class="nav-heading">Administration</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('branche.index')}}">
          <i class="bi bi-bar-chart-steps"></i>
          <span>Filières</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('domaine.index')}}">
          <i class="bi bi-bar-chart-steps"></i>
          <span>Séries pour fascicules</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('categorie.index')}}">
          <i class="bi bi-bar-chart-steps"></i>
          <span>Catégories</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('formation.index')}}">
          <i class="bi bi-award"></i>
          <span>Formations</span>
        </a>
      </li>



      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('fascicule.index')}}">
          <i class="bi bi-book"></i>
          <span>Fascicules</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('job.index')}}">
          <i class="bi bi-book"></i>
          <span>Jobs Descriptions</span>
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('bibliotheques.index')}}">
          <i class="bi bi-collection"></i>
          <span>Bibliothèque</span>
        </a>
      </li>

      
{{-- 
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-collection"></i>
          <span>Chapitres</span>
        </a>
      </li> --}}



      {{--<li class="nav-item">
        <a class="nav-link collapsed" href="{{route('video.index')}}">
          <i class="bi bi-camera-reels"></i>
          <span>Vidéos</span>
        </a>
      </li>--}}



      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user.index')}}">
          <i class="bi bi-person-lines-fill"></i>
          <span>Utilisateurs</span>
        </a>
      </li>



      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-text-paragraph"></i></i><span>Administration</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>


        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          

    
          <li class="">
            <a class="" href="{{route('faq.index')}}">
              <i class="bi bi-question-circle"></i>
              <span>Questions fréquentes</span>
            </a>
          </li>


          <li class="">
            <a class="" href="{{route('videos_par_categories')}}">
              <i class="bi bi-bar-chart-steps"></i>
              <span>Liste des vidéos par catégorie</span>
            </a>
          </li>


          <li class="">
            <a class="" href="{{route('formations_videos_par_categories')}}">
              <i class="bi bi-bar-chart-steps"></i>
              <span>Liste des formations vidéos par catégorie</span>
            </a>
          </li>
          
          
          
          <li class="">
            <a class="" href="{{route('fascicules_par_categorie')}}">
              <i class="bi bi-bar-chart-steps"></i>
              <span>Liste des fascicules par catégorie</span>
            </a>
          </li>


          <li class="">
            <a class="" href="{{route('jobs_par_categorie')}}">
              <i class="bi bi-bar-chart-steps"></i>
              <span>Liste des jobs descriptions par catégorie</span>
            </a>
          </li>


          
          <li class="">
            <a class="" href="{{route('etat_global_livres')}}">
              <i class="bi bi-bar-chart-steps"></i>
              <span>Etat Global des livres</span>
            </a>
          </li>


        </ul>

      </li>



    </ul>

      

  </aside><!-- End Sidebar-->
