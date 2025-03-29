@extends('pages.Dashboard')

@section('content')
    

<div class="row justify-content-end align-items-end">
  <a href="{{route('user.index')}}" class="col-3 btn btn-secondary" id="btnAdd"  style="background-color: #0f70b6; border:none">
      <i class=""></i>
      &nbsp;
      Liste des Utilisateurs
  </a>
</div>



<div class="pagetitle">
  <h1>Modifier Un Utilisateur</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Utilisateur</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<div class="col-lg-7">

    <div class="card row align-items-before justify-content-before">
      <div class="card-body">
        <h5 class="card-title">Veuillez remplir tous les champs!</h5>
        <br>

      
        <form class="row g-3" method="post" action="{{route('user.update', $user->id)}}" autocomplete="off" id="categorie_update">
          @csrf
          {{ method_field('PUT') }}


          <div class="row">
            <div class="form-group col-12">
              <label for="intitule" class="form-label">Adresse Email <span style="color: red; font-weight:700">*</span></label>
              <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required> 
              <br>
            </div>
          </div>

          
          <div class="row">
            <div class="form-group col-12">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="text" class="form-control" id="password" name="password" > 
              <br>
            </div>
          </div>


          <div class="row">
            <div class="form-group col-12">
              <label for="password" class="form-label" >Rôle de l'utilisateur <span style="color: red; font-weight:700">*</span></label>
                <select name="role" id="role" class="form-select">
                  
                  <option value="{{$user->role}}" selected>
                    @if ($user->role == 'user')
                      Utilisateur
                    @else
                      Administrateur
                    @endif
                  </option>
                  
                  <option value="#" disabled>--Séléctionnez un autre rôle rôle--</option>
                  <option value="user">Utilisateur</option>
                  <option value="admin">Administrateur</option>
                </select>
              <br>
            </div>
          </div>


     <br>

          <div class="row justify-content-center align-items-center">
          <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer" value="Enregistrer">
          </div>  


        </form>

      </div>
    </div>


</div>



<script type="text/javascript">

  document.querySelector("#enregistrer").onclick = function(e){
  e.preventDefault();

  var email = document.querySelector("#email").value;
  // var password = document.querySelector("#password").value;
  var role = document.querySelector("#role").value;




 if(email == ''){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez saisir l'adresse E-mail!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }
  else if(role == '#'){
    Swal.fire({
                  title: 'Information!',
                   text: "Veuillez sélectionner le rôle de l'utilsateur!!",
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#3e53ef',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                  })
  }
  else{
      document.querySelector('#categorie_update').submit();
  }

  }

  </script>
  

@endsection

