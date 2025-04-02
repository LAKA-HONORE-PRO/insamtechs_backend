




<style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .iframe-container {
            height: 100%;
        }
        .iframe-container iframe {
            width: 100%;
            height: 100vh;
            border: none; /* Supprimer la bordure de l'iframe */
        }
    </style>

    @if(isset($link))
    <div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-12 h-100">
            <div class="iframe-container">
                <iframe src="{{URL::asset('storage/'.$link)}}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
    @endif


