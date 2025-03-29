  <section class="vh-80" style="background-color: #f1f1f1;">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
            
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">
    
                    <form method="POST" action="{{route('doLogin')}}" id="login-form" class="animate__animated animate__fadeInUp" autocomplete="off">
                      @csrf
                      <div class="d-flex align-items-center justify-content-center mb-3 pb-1">

                        <span class="h1 fw-bold mb-0" style="color: #0f70b6;">
                        @lang('message.connexion')
                        </span>
                      </div>
    
                      <h5 class="fw-normal d-flex mb-3 pb-3 align-items-center justify-content-center" style="letter-spacing: 1px;">@lang('message.text_login') !</h5>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="email">Numéro de téléphone</label>
                        <input type="tel" id="tel_1" class="form-control form-control-lg" name="tel_1" value="{{ old('tel_1') }}">
                      </div>
    
                      <div class="form-outline mb-4">
                        <label class="form-label" for="password">@lang('message.mot_de_passe')</label>
                        <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                      </div>

                          @if ($errors->any())
                              {{-- <div > --}}
                                  <ul class="alert alert-danger" style="margin-top: -15px">
                                    <li style="list-style: none; text-align:center">Numéro de téléphone ou mot de passe incorrect!</li>
                                      {{-- @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach --}}
                                  </ul>
                              {{-- </div> --}}
                          @endif
          
                      <div class="pt-1 mb-4 d-flex align-items-center justify-content-center">
                        <input type="submit" value="@lang('message.se_connecter')" style="width: 200px; padding: 8px; background-color: #0f70b6; color: white; border: none; border-radius: 5px;">
                      </div>
    
                      <!--<a class="small text-muted d-flex align-items-center justify-content-center" href="#!">@lang('message.password_oublier') ?</a>-->
                      <p class="mb-5 pb-lg-2 d-flex align-items-center justify-content-center" style="color: #393f81;">@lang('message.pas_de_compte') ? <a href="#!"
                          style="color: #393f81;" id="btn-register">@lang('message.inscrivez_vous')...</a></p>
                      <!-- <a href="#!" class="small text-muted">Terms of use.</a>
                      <a href="#!" class="small text-muted">Privacy policy</a> -->
                    </form>








                    <form action="{{route('doInscription')}}" method="POST" id="form-register" class="animate__animated animate__fadeInUp">
                      
                      @csrf
                      
                      <div class="d-flex align-items-center justify-content-center pb-3">
                        <span class="h1 fw-bold mb-0" style="color: #0f70b6;">
                        @lang('message.inscription') !
                        </span>
                      </div>


                      <div class="form-outline mb-4">
                        <label class="form-label" for="nom">Noms / Name</label>
                        <input type="text" id="nom" class="form-control form-control-lg" name="nom" value="{{ old('nom') }}">
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="prenom">Prénoms / Surname</label>
                        <input type="text" id="prenom" class="form-control form-control-lg" name="prenom" value="{{ old('prenom') }}">
                      </div>

    
                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Numéro de téléphone</label>
                        <input type="tel" id="tel" name="tel" class="form-control form-control-lg" required/>
                      </div>
    
                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">@lang('message.mot_de_passe')</label>
                        <input type="password" id="password_ins" name="password_ins" class="form-control form-control-lg" required/>
                      </div>

                        <div class="form-outline mb-4">
                          <label class="form-label" for="form2Example27">@lang('message.confirmer_mot_de_passe')</label>
                          <input type="password" id="confirm_password_ins" name="confirm_password_ins" class="form-control form-control-lg" required/>
                        </div>
    
                        <div class="pt-1 mb-4 d-flex align-items-center justify-content-center">
                          <input type="submit" value="@lang('message.creer_un_nouveau_compte')" id="btn_ins" style="width: 300px; padding: 8px; background-color: #0f70b6; color: white; border: none; border-radius: 5px;">
                        </div>
          
                      <p class="mb-5 pb-lg-2 d-flex align-items-center justify-content-center" style="color: #393f81;">@lang('message.vous_avez_un_compte') ? <a href="#!"
                          style="color: #393f81;" id="login-btn">@lang('message.connexion')...</a></p>
                      <!-- <a href="#!" class="small text-muted">Terms of use.</a>
                      <a href="#!" class="small text-muted">Privacy policy</a> -->
                    </form>
    
                  </div>
                </div>

                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="{{URL::asset('assets/img/admin/login.png')}}"
                    alt="login form" class="img-fluid" style="border-radius:  0 1rem 1rem 0 ;" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>


  <script type="text/javascript">

    document.querySelector("#btn_ins").onclick = function(e){
    e.preventDefault();

    var nom = document.querySelector("#nom").value;
    var prenom = document.querySelector("#prenom").value;
    var email_ins = document.querySelector("#tel").value;
    var password_ins = document.querySelector("#password_ins").value;
    var confirm_password_ins = document.querySelector("#confirm_password_ins").value;
  
  
  
    if(nom == ''){
      Swal.fire({
                    title: 'Information!',
                     text: "Veuillez saisir le nom!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
                    })
    }
    else if(prenom == ''){
      Swal.fire({
                    title: 'Information!',
                     text: "Veuillez saisir le prénom!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
                    })
    }
   else if(email_ins == ''){
      Swal.fire({
                    title: 'Information!',
                     text: "Veuillez saisir le numéro de téléphone!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
                    })
    }
    else if(password_ins == '')
    {
      Swal.fire({
                    title: 'Information!',
                     text: "Veuillez saisir le mot de passe!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
                    })
    }
    else if(password_ins.length < 8 || !/[A-Z]/.test(password_ins) || !/[0-9]/.test(password_ins))
    {
      Swal.fire({
                    title: 'Information!',
                     text: "Le mot de passe doit être d'au moins 8 caractères et inclure au moins une lettre minuscule, une lettre majuscule, et un chiffre !!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',

                    showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
                    })
    }
    else if(confirm_password_ins != password_ins)
    {
      Swal.fire({
                    title: 'Information!',
                     text: "Les mots de passe ne correspondent pas!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    showClass: {
                        popup: `
                          animate__animated
                          animate__fadeInUp
                          animate__faster
                        `
                      },
                      hideClass: {
                        popup: `
                          animate__animated
                          animate__fadeOutDown
                          animate__faster
                        `
                      }
                    })
                    
    }
    else{
        document.querySelector('#form-register').submit();
    }
  
    }
  
    </script>
    