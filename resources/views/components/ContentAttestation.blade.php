
<div class="container" style="margin-top: 30px; margin-bottom:30px">
  <div class="row">
    <button class="btn btn-success col-4 gap-2" id="print">  Imprimer <i class="bi bi-printer-fill"></i></button>
  </div>
</div>

<div class="container" id="all" style="justify-content:center; align-items:center; transition: all 0.5s; background-color : white; padding:50px; text-align:center;">
          <div class="row" style="margin-bottom:90px">
              <h2 style=" text-transform: uppercase; font-weight: bold; color: #196fb8; font-size:40px">

                @if($formation->langue_formation == "français")
                  attestation de formation
                @else
                  certificate of achievement
                @endif
              
              </h2>
          </div>

          <div class="row gap-4" style="margin-bottom: 30px">
              <p style="font-size:20px;">

                @if($formation->langue_formation == "français")
                  Le présent document atteste que :
                @else
                  This certificate is presented to :
                @endif
              
              </p>
              <h2 style="font-weight:bold; font-style:italic; text-transform:uppercase">
                {{ Auth::user()->nom.' '.Auth::user()->prenom }}
              </h2>
          </div>

          <div class="row gap-4" style="margin-bottom: 30px">
            <p style="font-size:20px;">
              @if($formation->langue_formation == "français")
                A suivi avec succès la formation en:
              @else
                for successfull completing a course about
              @endif
            </p>
            <h2 style="font-weight:bold; font-style:italic; text-transform:uppercase">
              {{$formation->intitule}}
            </h2>
          </div>

          <div class="row" style="margin-bottom: 20px">
            <p>
              @if($formation->langue_formation == "français")
                Attestation n°
              @else
                Certificate n°
              @endif
            </p>
            <h2 style="font-size: 20px; font-weight:bolder; color:#196fb8">
              {{strtoupper($attestation->certificate_number)}}
            </h2>
          </div>


          <div class="row" style="justify-content: center; align-items:center; margin-bottom:50px">
              <div class="col-4">
                  <p style="font-size: 17px;">
                    Date
                  </p>
                  <h2 style="font-size: 17px; font-weight:bold; font-style:italic">
                    {{$attestation->created_at->format('d . m . Y')}}
                  </h2>
              </div>

              <div class="col-4">
                <p style="font-size: 17px;">
                  Signature
                </p>
                <h2 tyle="font-size: 17px; font-weight:bold; font-style:italic">
                                                                        
                </h2>
            </div>
          </div>


          <div class="row" style="margin-top: -10px">
            <div class="col-4">
              <img src="{{URL::asset('assets/img/admin/logo_insam.png')}}" alt="" style="width: 110px; height:110px">
            </div>

            <div class="col-4">
              <img src="{{URL::asset('assets/img/admin/logo-estuaire.png')}}" alt="" style="width: 110px; height:110px">
            </div>

            <div class="col-4">
                {{ $qrCode }}
            </div>
          </div>
</div>



