<!DOCTYPE html>
<html lang="en">
{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head> --}}

@include('components.Head')
<body>

    @include('components.Topbar')
    @include('components.Navbar')
    <section id="courses" class="courses">
        <div class="container">
    
            <div class="section-title" >
                <h2 style="color: red"> <span style="color: red"> <span style="text-transform: uppercase">O</span><span style="text-transform: lowercase">oops</span>!!!!</span>  Pas Cette page.(404)</h2>
            </div>
    
            <div class="row">
  
                <div class="d-flex justify-content-center align-items-center" style="margin-top:40px">
                    <a href="{{route('accueil')}}" style="background-color: rgb(88, 16, 197); text-decoration:none; padding:15px; color:white; text-align:center; "><i class="bi bi-arrow-left-circle"></i> Revenir sur le site </a>
                  </div>
    
            </div>
    
        </div>
    </section><!-- End Courses Section -->
    

    @include('components.Foot')
    @include('components.Footer')
    
</body>
</html>