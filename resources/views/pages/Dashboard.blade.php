@php
use App\Http\Controllers\Controller;
@endphp

@auth


@if (Auth::user()->role == 'admin')
  
  
<!DOCTYPE html>
<html lang="en">

@include('components.admin.Head')


<style>
  .plus {
  border: 1px solid rgb(88, 16, 197);
  padding:6px;
  border-radius:5px;
  transition: all 0.5s;
}

.plus:hover{
  border: 1px solid rgb(88, 16, 197);
  background-color: rgb(88, 16, 197);
  color: white;
  padding:6px;
  border-radius:5px;

}
</style>

<body>

<!--   
  <div class="loader-bg">
    <div class="loader">

    </div>

  </div> -->


    @include('components.admin.Header')

    @include('components.admin.SideBar')


  <main id="main" class="main">

        @yield('content')

  </main>



    @include('components.admin.Footer')

</body>










<?php

        if(isset($_SESSION['message']) == true) {
            $error= $_SESSION['message'];
        ?>

                <script type="text/javascript">
                    Swal.fire({
                        icon: '<?php echo $error['type']; ?>',
                        title:'<?php echo $error['title'];  ?>',
                        text: '<?php echo $error['message']; ?>',
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
                </script>

                <?php
        unset($_SESSION['message']);
        }

?>




</html>
@else

 
{{-- <script>
  window.location.href = "{{route('404')}}";
</script> --}}


@endif


@endauth
