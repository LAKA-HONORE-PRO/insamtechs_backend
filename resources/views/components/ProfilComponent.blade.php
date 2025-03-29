<section id="hero_other">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
  
      <ol class="carousel-indicators_other" id="hero-carousel-indicators_other"></ol>
  
      <div class="carousel-inner_other" role="listbox">
  
        <!-- Slide 1 -->
        <div class="carousel-item_other active">
          <div class="carousel-container_other">
            <div class="container_other">
              <h2 class="animate__animated animate__fadeInDown"><span> @lang('message.mon_profil') </span></h2>
              <p class="animate__animated animate__fadeInDown">@lang('message.home') / @lang('message.mon_profil') </p> 
  
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Passez à l'action</a> -->
            </div>
          </div>
        </div>
  
  
  
      </div>
  
  
    </div>
  </section>

  <br>
  <br>


  @if ($errors->any())
    <div class="container">
        <ul class="alert alert-secondary" style="margin-top: -15px; background-color: rgb(88, 16, 197); color:white">
          @foreach ($errors->all() as $error)
          <li style="list-style: none; text-align:center">{{$error}}</li>
          @endforeach
        </ul>
    </div>
  @endif

<main id="main" class="main">
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{URL::asset('public/dashboard/assets/img/profil.png')}}" alt="Profile" class="rounded-circle">
              <h2>{{Auth::user()->tel_1}}</h2>
              <h3> @lang('message.votre_profil') </h3>
            </div>
          </div>
        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">@lang('message.mes_parametres')</button>
                </li>


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">@lang('message.mot_de_passe')</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <form action="{{route('update_profil')}}" method="POST" autocomplete="off">
                      
                      @csrf
    
                        <div class="row mb-3">
                          <label for="nom" class="col-md-4 col-lg-3 col-form-label"> @lang('message.nom_de_famille') </label>
                          <div class="col-md-8 col-lg-9">
                            <input name="nom" type="text" class="form-control" id="nom" value="{{ucfirst(Auth::user()->nom)}}">
                          </div>
                        </div>


                        <div class="row mb-3">
                            <label for="prenom" class="col-md-4 col-lg-3 col-form-label"> @lang('message.prenom') </label>
                            <div class="col-md-8 col-lg-9">
                              <input name="prenom" type="text" class="form-control" id="prenom" value="{{ucfirst(Auth::user()->prenom)}}">
                            </div>
                          </div>
    

                        <div class="row mb-3">
                          <label for="nationalite" class="col-md-4 col-lg-3 col-form-label"> @lang('message.nationalite') </label>
                          <div class="col-md-8 col-lg-9">
                            <select name="nationalite" class="chosen-select form-control custom-select" id="nationalite" required>
                              <option value="{{Auth::user()->nationalite}}" selected>{{ucfirst(Auth::user()->nationalite)}}</option>

                                <option value="Cameroun">Cameroun</option>

                                <option value="Afghanistan">Afghanistan </option>
                                <option value="Afrique_Centrale">Afrique Centrale </option>
                                <option value="Afrique_du_Sud">Afrique du Sud </option>
                                <option value="Albanie">Albanie </option>
                                <option value="Algerie">Algérie </option>
                                <option value="Allemagne">Allemagne </option>
                                <option value="Andorre">Andorre </option>
                                <option value="Angola">Angola </option>
                                <option value="Anguilla">Anguilla </option>
                                <option value="Arabie_Saoudite">Arabie Saoudite </option>
                                <option value="Argentine">Argentine </option>
                                <option value="Armenie">Armenie </option>
                                <option value="Australie">Australie </option>
                                <option value="Autriche">Autriche </option>
                                <option value="Azerbaidjan">Azerbaidjan </option>

                                <option value="Bahamas">Bahamas </option>
                                <option value="Bangladesh">Bangladesh </option>
                                <option value="Barbade">Barbade </option>
                                <option value="Bahrein">Bahrein </option>
                                <option value="Belgique">Belgique </option>
                                <option value="Belize">Belize </option>
                                <option value="Benin">Bénin </option>
                                <option value="Bermudes">Bermudes </option>
                                <option value="Bielorussie">Biélorussie </option>
                                <option value="Bolivie">Bolivie </option>
                                <option value="Botswana">Botswana </option>
                                <option value="Bhoutan">Bhoutan </option>
                                <option value="Boznie_Herzegovine">Boznie Herzégovine </option>
                                <option value="Bresil">Brésil </option>
                                <option value="Brunei">Brunei </option>
                                <option value="Bulgarie">Bulgarie </option>
                                <option value="Burkina_Faso">Burkina Faso </option>
                                <option value="Burundi">Burundi </option>

                                <option value="Caiman">Caïman </option>
                                <option value="Cambodge">Cambodge </option>
                                <option value="Cameroun">Cameroun </option>
                                <option value="Canada">Canada </option>
                                <option value="Canaries">Canaries </option>
                                <option value="Cap_vert">Cap Vert </option>
                                <option value="Chili">Chili </option>
                                <option value="Chine">Chine </option>
                                <option value="Chypre">Chypre </option>
                                <option value="Colombie">Colombie </option>
                                <option value="Comores">Colombie </option>
                                <option value="Congo">Congo </option>
                                <option value="Congo_democratique">Congo Démocratique </option>
                                <option value="Cook">Cook </option>
                                <option value="Coree_du_Nord">Corée du Nord </option>
                                <option value="Coree_du_Sud">Corée du Sud </option>
                                <option value="Costa_Rica">Costa Rica </option>
                                <option value="Cote_d_Ivoire">Côte d’Ivoire </option>
                                <option value="Croatie">Croatie </option>
                                <option value="Cuba">Cuba </option>

                                <option value="Danemark">Danemark </option>
                                <option value="Djibouti">Djibouti </option>
                                <option value="Dominique">Dominique </option>

                                <option value="Egypte">Egypte </option>
                                <option value="Emirats_Arabes_Unis">Emirats Arabes Unis </option>
                                <option value="Equateur">Equateur </option>
                                <option value="Erythree">Erythrée </option>
                                <option value="Espagne">Espagne </option>
                                <option value="Estonie">Estonie </option>
                                <option value="Etats_Unis">Etats-Unis </option>
                                <option value="Ethiopie">Ethiopie </option>

                                <option value="Falkland">Falkland </option>
                                <option value="Feroe">Féroé </option>
                                <option value="Fidji">Fidji </option>
                                <option value="Finlande">Finlande </option>
                                <option value="France">France </option>

                                <option value="Gabon">Gabon </option>
                                <option value="Gambie">Gambie </option>
                                <option value="Georgie">Géorgie </option>
                                <option value="Ghana">Ghana </option>
                                <option value="Gibraltar">Gibraltar </option>
                                <option value="Grece">Grèce </option>
                                <option value="Grenade">Grenade </option>
                                <option value="Groenland">Groënland </option>
                                <option value="Guadeloupe">Guadeloupe </option>
                                <option value="Guam">Guam </option>
                                <option value="Guatemala">Guatémala</option>
                                <option value="Guernesey">Guernesey </option>
                                <option value="Guinee">Guinée </option>
                                <option value="Guinee_Bissau">Guinée Bissau </option>
                                <option value="Guinee equatoriale">Guinée Equatoriale </option>
                                <option value="Guyana">Guyana </option>
                                <option value="Guyane_Francaise ">Guyane Francaise </option>

                                <option value="Haiti">Haïti </option>
                                <option value="Hawaii">Hawaii </option>
                                <option value="Honduras">Honduras </option>
                                <option value="Hong_Kong">Hong Kong </option>
                                <option value="Hongrie">Hongrie </option>

                                <option value="Inde">Inde </option>
                                <option value="Indonesie">Indonésie </option>
                                <option value="Iran">Iran </option>
                                <option value="Iraq">Iraq </option>
                                <option value="Irlande">Irlande </option>
                                <option value="Islande">Islande </option>
                                <option value="Israel">Israël </option>
                                <option value="Italie">italie </option>

                                <option value="Jamaique">Jamaïque </option>
                                <option value="Jan Mayen">Jan Mayen </option>
                                <option value="Japon">Japon </option>
                                <option value="Jersey">Jersey </option>
                                <option value="Jordanie">Jordanie </option>

                                <option value="Kazakhstan">Kazakhstan </option>
                                <option value="Kenya">Kenya </option>
                                <option value="Kirghizstan">Kirghizistan </option>
                                <option value="Kiribati">Kiribati </option>
                                <option value="Koweit">Koweït </option>

                                <option value="Laos">Laos </option>
                                <option value="Lesotho">Lesotho </option>
                                <option value="Lettonie">Lettonie </option>
                                <option value="Liban">Liban </option>
                                <option value="Liberia">Liberia </option>
                                <option value="Liechtenstein">Liechtenstein </option>
                                <option value="Lituanie">Lituanie </option>
                                <option value="Luxembourg">Luxembourg </option>
                                <option value="Lybie">Lybie </option>

                                <option value="Macao">Macao </option>
                                <option value="Macedoine">Macédoine </option>
                                <option value="Madagascar">Madagascar </option>
                                <option value="Madère">Madère </option>
                                <option value="Malaisie">Malaisie </option>
                                <option value="Malawi">Malawi </option>
                                <option value="Maldives">Maldives </option>
                                <option value="Mali">Mali </option>
                                <option value="Malte">Malte </option>
                                <option value="Man">Man </option>
                                <option value="Mariannes du Nord">Mariannes du Nord </option>
                                <option value="Maroc">Maroc </option>
                                <option value="Marshall">Marshall </option>
                                <option value="Martinique">Martinique </option>
                                <option value="Maurice">Maurice </option>
                                <option value="Mauritanie">Mauritanie </option>
                                <option value="Mayotte">Mayotte </option>
                                <option value="Mexique">Mexique </option>
                                <option value="Micronesie">Micronésie </option>
                                <option value="Midway">Midway </option>
                                <option value="Moldavie">Moldavie </option>
                                <option value="Monaco">Monaco </option>
                                <option value="Mongolie">Mongolie </option>
                                <option value="Montserrat">Montserrat </option>
                                <option value="Mozambique">Mozambique </option>

                                <option value="Namibie">Namibie </option>
                                <option value="Nauru">Nauru </option>
                                <option value="Nepal">Nepal </option>
                                <option value="Nicaragua">Nicaragua </option>
                                <option value="Niger">Niger </option>
                                <option value="Nigeria">Nigéria </option>
                                <option value="Niue">Niue </option>
                                <option value="Norfolk">Norfolk </option>
                                <option value="Norvege">Norvège </option>
                                <option value="Nouvelle_Caledonie">Nouvelle Calédonie </option>
                                <option value="Nouvelle_Zelande">Nouvelle Zélande </option>

                                <option value="Oman">Oman </option>
                                <option value="Ouganda">Ouganda </option>
                                <option value="Ouzbekistan">Ouzbékistan </option>

                                <option value="Pakistan">Pakistan </option>
                                <option value="Palau">Palau </option>
                                <option value="Palestine">Palestine </option>
                                <option value="Panama">Panama </option>
                                <option value="Papouasie_Nouvelle_Guinee">Papouasie Nouvelle Guinée</option>
                                <option value="Paraguay">Paraguay </option>
                                <option value="Pays_Bas">Pays Bas </option>
                                <option value="Perou">Perou </option>
                                <option value="Philippines">Philippines </option>
                                <option value="Pologne">Pologne </option>
                                <option value="Polynesie">Polynésie </option>
                                <option value="Porto_Rico">Porto Rico </option>
                                <option value="Portugal">Portugal </option>

                                <option value="Qatar">Qatar </option>

                                <option value="Republique_Dominicaine">République Dominicaine </option>
                                <option value="Republique_Tcheque">République Tchèque </option>
                                <option value="Reunion">Réunion </option>
                                <option value="Roumanie">Roumanie </option>
                                <option value="Royaume_Uni">Royaume Uni </option>
                                <option value="Russie">Russie </option>
                                <option value="Rwanda">Rwanda </option>

                                <option value="Sahara Occidental">Sahara Occidental </option>
                                <option value="Sainte_Lucie">Sainte-Lucie </option>
                                <option value="Saint_Marin">Saint-Marin </option>
                                <option value="Salomon">Salomon </option>
                                <option value="Salvador">Salvador </option>
                                <option value="Samoa_Occidentales">Samoa Occidentales</option>
                                <option value="Samoa_Americaine">Samoa Américaine </option>
                                <option value="Sao_Tome_et_Principe">Sao Tome et Principe </option>
                                <option value="Senegal">Sénégal </option>
                                <option value="Seychelles">Seychelles </option>
                                <option value="Sierra Leone">Sierra Léone </option>
                                <option value="Singapour">Singapour </option>
                                <option value="Slovaquie">Slovaquie </option>
                                <option value="Slovenie">Slovénie</option>
                                <option value="Somalie">Somalie </option>
                                <option value="Soudan">Soudan </option>
                                <option value="Sri_Lanka">Sri Lanka </option>
                                <option value="Suede">Suède </option>
                                <option value="Suisse">Suisse </option>
                                <option value="Surinam">Surinam </option>
                                <option value="Swaziland">Swaziland </option>
                                <option value="Syrie">Syrie </option>

                                <option value="Tadjikistan">Tadjikistan </option>
                                <option value="Taiwan">Taiwan </option>
                                <option value="Tonga">Tonga </option>
                                <option value="Tanzanie">Tanzanie </option>
                                <option value="Tchad">Tchad </option>
                                <option value="Thailande">Thailande </option>
                                <option value="Tibet">Tibet </option>
                                <option value="Timor_Oriental">Timor Oriental </option>
                                <option value="Togo">Togo </option>
                                <option value="Trinite_et_Tobago">Trinite et Tobago </option>
                                <option value="Tristan da cunha">Tristan de cuncha </option>
                                <option value="Tunisie">Tunisie </option>
                                <option value="Turkmenistan">Turmenistan </option>
                                <option value="Turquie">Turquie </option>

                                <option value="Ukraine">Ukraine </option>
                                <option value="Uruguay">Uruguay </option>

                                <option value="Vanuatu">Vanuatu </option>
                                <option value="Vatican">Vatican </option>
                                <option value="Venezuela">Vénézuela </option>
                                <option value="Vierges_Americaines">Vierges Américaines </option>
                                <option value="Vierges_Britanniques">Vierges Britanniques </option>
                                <option value="Vietnam">Vietnam </option>

                                <option value="Wake">Wake </option>
                                <option value="Wallis et Futuma">Wallis et Futuma </option>

                                <option value="Yemen">Yemen </option>
                                <option value="Yougoslavie">Yougoslavie </option>

                                <option value="Zambie">Zambie </option>
                                <option value="Zimbabwe">Zimbabwe </option>

                            </select>
                          </div>
                        </div>

    
                        <div class="row mb-3">
                          <label for="Phone" class="col-md-4 col-lg-3 col-form-label"> @lang('message.telephone') </label>
                          <div class="col-md-8 col-lg-9">
                            <input name="phone" type="tel" class="form-control" id="Phone" value="{{Auth::user()->tel_1}}" required>
                          </div>
                        </div>
    
                        <div class="row mb-3">
                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">@lang('message.adresse_email')</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="Email" value="{{Auth::user()->email}}" required>
                          </div>
                        </div>
    
      
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary" style="background-color: rgb(88, 16, 197); border:none; width:80%">@lang('message.enregistrer_btn')</button>
                        </div>
                      </form>

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{route('update_password')}}" method="POST" autocomplete="off" id="form-register">
                    @csrf
                    
                    <div class="row mb-3">
                      <label for="password_actuel" class="col-md-4 col-lg-3 col-form-label">@lang('message.motdepasseactuel')</label>
                      <div class="col-md-8 col-lg-9"> 
                        <input name="password_actuel" type="password" class="form-control" id="password_actuel" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="new_password" class="col-md-4 col-lg-3 col-form-label"> @lang('message.nouveaumotdepasse') </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="new_password" type="password" class="form-control" id="new_password" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="confirm_new_password" class="col-md-4 col-lg-3 col-form-label"> @lang('message.confirmer_nouveau_mot_de_passe') </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirm_new_password" type="password" class="form-control" id="confirm_new_password" required>
                      </div>
                    </div>

      
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background-color: rgb(88, 16, 197); border:none; width:80%" id="btn_ins"> @lang('message.enregistrer_btn') </button>
                      </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



  <script type="text/javascript">

    document.querySelector("#btn_ins").onclick = function(e){
    e.preventDefault();
  
    var password_actuel = document.querySelector("#password_actuel").value;
    var new_password = document.querySelector("#new_password").value;
    var confirm_new_password = document.querySelector("#confirm_new_password").value;
  
  
  
  
   if(password_actuel == ''){
      Swal.fire({
                    title: 'Information!',
                     text: "Veuillez saisir le mot de passe actuel!!",
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
    else if(new_password == '')
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
    else if(new_password.length < 8 || !/[A-Z]/.test(new_password) || !/[0-9]/.test(new_password))
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
    else if(confirm_new_password != new_password)
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
    