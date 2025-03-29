@php
    use App\Models\Branche;
@endphp

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
        <h1>Modifier Une Série</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Séries</li>
                <li class="breadcrumb-item active">Modifier</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <div class="col-lg-7">

        <div class="card row align-items-before justify-content-before">
            <div class="card-body">
                <h5 class="card-title">Veuillez remplir tous les champs!</h5>
                <br>


                <form class="row g-3" method="post" action="{{ route('domaine.update', $domaine->id) }}" autocomplete="off"
                    id="domaine_update">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="intitule" class="form-label">Filière</label>
                            <select name="branche_id" id="branche_id" class="form-select">

                              @php
                                if($domaine->branche_id != NULL){
                                  $branch = Branche::find($domaine->branche_id)->intitule;
                                }
                              @endphp

                                <option value="<?= $domaine->branche_id != null ? $domaine->id : '#' ?>">
                                    <?= $domaine->branche_id != null ? $branch : '--Sélectionnez la filière--' ?>
                                </option>






                                @forelse ($branches as $branche)
                                    <option value="{{ $branche->id }}">
                                        {{ ucfirst($branche->intitule) }}
                                    </option>
                                @empty
                                    <option value="#">
                                        Aucune filière enregistrée!
                                    </option>
                                @endforelse

                            </select>
                            <br>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="intitule" class="form-label">Intitulé</label>
                            <input type="text" class="form-control" value="{{ ucfirst($domaine->intitule) }}"
                                id="intitule" name="intitule">
                            <br>
                        </div>
                    </div>




                    <br>

                    <div class="row justify-content-center align-items-center">
                        <input type="submit" class="col-4 btn btn-primary" name="enregistrer" id="enregistrer"
                            value="Enregistrer">
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
                document.querySelector('#domaine_update').submit();
            }

        }
    </script>
@endsection
