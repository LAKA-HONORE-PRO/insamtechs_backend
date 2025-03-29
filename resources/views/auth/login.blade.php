<!doctype html>
<html lang="fr">

<head>
    <title>Banque</title>
    <link href="{{asset('public/accueil/img/INSAM.png')}}" rel="icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('public/login_assets/css/style.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img"
                            style="background-image: url({{ asset('public/login_assets/images/dossier2.jpg') }});">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4 text-center">Connexion</h3>
                                </div>
                            </div>
                            <form action="{{route('doLogin')}}" class="signin-form" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Login</label>
                                    <input type="text" class="form-control" placeholder="Numéro de téléphone" name="tel" value="{{ old('tel') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Mot de Passe</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Mot de Passe">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Se
                                        Connecter</button>
                                </div>  
                            </form>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('public/login_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/login_assets/js/popper.js') }}"></script>
    <script src="{{ asset('public/login_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/login_assets/js/main.js') }}"></script>


</body>

</html>
