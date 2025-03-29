@php
use App\Http\Controllers\Controller;
@endphp

<!DOCTYPE html>
<html lang="en">
    @include('components.Head')
<body>
      
    @include('components.Topbar')

    @auth
        @include('components.NavBarClient')
    @endauth

    @guest
        @include('components.Navbar') 
    @endguest



    {{-- @include('components.OtherCaroussel') --}}

    @include('components.ContentFormation')
    

    @include('components.Footer')
    <script>
        function goBack() {
         window.history.back();
        }
    </script>
    @include('components.Foot')
</body>
</html>

<script>

    $(document).ready(function(){
        $('.validate').click(function(){
           var id = $(this).attr("aria-id");

           $("#idvideo").val(id);
        });



        $('#soumettre').click(function(e){
            e.preventDefault();


            var check1 = $('input[name="checkbox1"]');
            var check2 = $('input[name="checkbox2"]');
            var check3 = $('input[name="checkbox3"]');

            if(check1.is(':checked') === true){
                check1.attr('value', 'oui');

            }else{
                check1.attr('value', 'non');
            }

            if(check2.is(':checked') === true){
                check2.attr('value', 'oui');

            }else{
                check2.attr('value', 'non');
            }


            if(check3.is(':checked') === true){
                check3.attr('value', 'oui');

            }else{
                check3.attr('value', 'non');
            }

            var formData = $('#form').serialize();


            $.ajax({
                    url: '{{route('confirmation.store')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
            });

            location.reload();
            // alert(  )

            
           
        });
    });

</script>


<script>
    function swalattestation(){
        



        Swal.fire({
  title: "",
  icon: "",
  html: ` @lang('message.message_attestation') `,
  showCloseButton: true,
  showCancelButton: false,
  focusConfirm: false,
  confirmButtonText: `
    <i class="fa fa-thumbs-up"></i> Ok!
  `,
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
//   confirmButtonAriaLabel: "Thumbs up, great!",
//   cancelButtonText: `
//     <i class="fa fa-thumbs-down"></i>
//   `,
//   cancelButtonAriaLabel: "Thumbs down"
});


    }
</script>