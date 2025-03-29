@php
  use App\Models\User;
@endphp
<div class="container" style="margin-top: 30px; margin-bottom:30px">
  <div class="row">
    <button class="btn btn-success col-4 gap-2" id="print">  Imprimer <i class="bi bi-printer-fill"></i></button>
  </div>
</div>

<div class="container" id="all" style="justify-content:center; align-items:center; transition: all 0.5s; background-color : white; padding:50px; text-align:center;">
  <div class="class="container mt-5">
    <table class="table table-striped">
      <h2 style="font-size:20px">Liste des apprenants ayant bravé la formation <span style="text-transform: uppercase">{{ucfirst($formation->intitule)}}</h2>
      <thead class="thead-dark">
        <tr>
          <th >Nom</th>
          <th >Prénoms</th>
        </tr>
      </thead>
      <tbody>

        @forelse ($studies as $item)
          @php
                $user = User::find($item->user_id);
          @endphp

            <tr>
              <td>{{ucfirst($user->nom)}}</td>
              <td>{{ucfirst($user->prenom)}}</td>
            </tr>
        @empty
            Aucune donnée à afficher.
        @endforelse
       
      </tbody>
    </table>
  </div>
</div>



