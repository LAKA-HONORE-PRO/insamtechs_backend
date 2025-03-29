
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Insam Technologie</span></strong>. Tous droits reservés.
    </div>
    <div class="credits">
    
      Designed by <a href="https://bootstrapmade.com/">Estuaire Service</a>
    </div>
</footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="{{URL::asset('dashboard/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/js/sweetalert2.min.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/js/recherche.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/js/chargement.js')}}"></script>
  <script src="{{URL::asset('dashboard/assets/js/table2excel.js')}}"></script>

  <script src="{{URL::asset('chosen/docsupport/jquery-3.2.1.min.js')}}" type="text/javascript" charset="utf-8"></script>
  <script src="{{URL::asset('chosen/chosen.jquery.js')}}" type="text/javascript" charset="utf-8"></script>
  <script src="{{URL::asset('chosen/docsupport/prism.js')}}" type="text/javascript" charset="utf-8"></script>
  <script src="{{URL::asset('chosen/docsupport/init.js')}}" type="text/javascript" charset="utf-8"></script>


  <script src="{{URL::asset('dashboard/assets/js/main.js')}}"></script>



                <!-- EXPORT EN FICHIER EXCEL -->
                <script>
                  document.querySelector('#btn_export').addEventListener('click', function() {
                      var table2excel = new Table2Excel();
                      table2excel.export(document.querySelectorAll("#for_export"));
                  });
              </script>
          <!-- FIN EXPORT EXCEL -->
  
          <script type="text/javascript">
            $(document).ready(function() {
              $('#myForm').submit(function() {
                $('#submitBtn').prop('disabled', true); // Désactiver l'input
                $('#loader').show(); // Afficher le loader
              });
            });
          </script>