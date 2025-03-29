<main id="main">

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container-fluid">
      <div class="row gy-4">
        <div class="col-lg-8">
          @php
            $li = 'storage/'.$lien;
          @endphp
          <div class="container">
            <div class="row">
              <div class="col-lg-8 offset-lg-2">
                <div id="pdfViewer" class="embed-responsive embed-responsive-16by9">
                  <!-- Les pages du PDF seront ajoutées ici dynamiquement -->
                </div>
              </div>
            </div>
          </div>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
          <script>
            var pdfUrl = "{{URL::asset($li)}}"; // Remplacez par le chemin approprié vers votre fichier PDF

            // Chargement et affichage du PDF
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
              // Pour chaque page du PDF
              for (var pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                pdf.getPage(pageNumber).then(function(page) {
                  var scale = 1.5;
                  var viewport = page.getViewport({ scale: scale });

                  var containerWidth = window.innerWidth;
                  var desiredWidth = containerWidth; // La div remplira 100% de la largeur de l'écran

                  var scale = desiredWidth / viewport.width;
                  var scaledViewport = page.getViewport({ scale: scale });

                  var canvas = document.createElement('canvas');
                  var context = canvas.getContext('2d');
                  canvas.height = scaledViewport.height;
                  canvas.width = scaledViewport.width;

                  var renderContext = {
                    canvasContext: context,
                    viewport: scaledViewport
                  };

                  page.render(renderContext).promise.then(function() {
                    var pageElement = document.createElement('div');
                    pageElement.classList.add('page');
                    pageElement.appendChild(canvas);
                    document.getElementById('pdfViewer').appendChild(pageElement);
                  });
                });
              }
            });
          </script>
        </div>
      </div>
    </div>
  </section><!-- End Portfolio Details Section -->
</main>