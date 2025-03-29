@extends('pages.Dashboard')

@section('content')
    <div class="row justify-content-end align-items-end">
        <a href="{{ route('domaine.index') }}" class="col-3 btn btn-secondary" id="btnAdd"
            style="background-color: #0f70b6; border:none">
            <i class=""></i>
            &nbsp;
            Liste des Séries
        </a>
    </div>



    <div class="pagetitle">
        <h1>Ajouter Une Série</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Série</li>
                <li class="breadcrumb-item active">Ajouter</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <div class="col-lg-7">

        <div class="card row align-items-before justify-content-before">
            <div class="card-body">
                <h5 class="card-title">Veuillez remplir tous les champs!</h5>
                <br>


                <form class="row g-3" method="post" action="{{ route('domaine.store') }}" autocomplete="off"
                    id="categorie_create">
                    @csrf


                    <div class="row">
                        <div class="form-group col-12">
                            <label for="intitule" class="form-label">Filière <span style="color: red">*</span></label>
                            <select name="branche_id" id="branche_id" class="chosen-select form-select custom-select">

                                <option value="#" selected disabled>
                                    --Sélectionnez une filière--
                                </option>


                                @forelse ($branches as $branche)
                                    <option value="{{ $branche->id }}">
                                        {{ ucfirst($branche->intitule) }}
                                    </option>
                                @empty
                                    <option value="#" disabled>
                                        Aucune filière enregistrée pour le moment !
                                    </option>
                                @endforelse

                            </select>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="intitule" class="form-label">Intitulé <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="intitule" name="intitule">
                            <br>
                        </div>
                    </div>



                    <br>

                    <div class="row justify-content-center align-items-center">
                        <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer"
                            value="Enregistrer">
                        <span id="loader" style="display: none; text-align:center; color:green; font-weight:700">Veuillez
                            patienter...</span>

                    </div>


                </form>

            </div>
        </div>


    </div>



    <script type="text/javascript">
        document.querySelector("#enregistrer").onclick = function(e) {
            e.preventDefault();

            var intitule = document.querySelector("#intitule").value;
            var branche = document.querySelector("#branche_id").value;




            if (intitule == '') {
                Swal.fire({
                    title: 'Information!',
                    text: "Veuillez saisir l'intitulé!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                })
            } else if (branche == "#") {
                Swal.fire({
                    title: 'Information!',
                    text: "Veuillez sélectionner la filière!!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3e53ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                })
            } else {
                document.querySelector('#categorie_create').submit();
                $('#enregistrer').prop('disabled', true); // Désactiver l'input
                $('#loader').show(); // Afficher le loader
            }

        }
    </script>
@endsection
