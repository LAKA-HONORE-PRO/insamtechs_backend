@php
    use App\Models\Formation;
@endphp
@extends('pages.Dashboard')

@section('content')






  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xl-3   col-md-6">
            <div class="card info-card sales-card">

    
              <div class="card-body">
                <h5 class="card-title">@lang('message.videotheque')</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-camera-reels"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ Formation::where('type_formation_id', 1)->count(); }}</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xl-3 col-md-6">
            <div class="card info-card revenue-card">

       
              <div class="card-body">
                <h5 class="card-title">@lang('message.bibliotheque')</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-collection"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ Formation::where('type_formation_id', 2)->count(); }}</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xl-3 col-md-12">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">@lang('message.fascicule')</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ Formation::where('type_formation_id', 3)->count(); }}</h6>
                    {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> --}}

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

                    <!-- Customers Card -->
                    <div class="col-xl-3 col-md-12">

                      <div class="card info-card customers-card">
          
                        <div class="card-body">
                          <h5 class="card-title">@lang('message.job_description')</h5>
          
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-book"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{ Formation::where('type_formation_id', 4)->count(); }}</h6>
                              {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> --}}
          
                            </div>
                          </div>
          
                        </div>
                      </div>
          
                    </div><!-- End Customers Card -->

          <!-- Reports -->
          <div class="col-12">
            <div class="card">

              <div class="card-body">

                <!-- Line Chart -->
                <div id="reportsChart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#reportsChart"), {
                      series: [{
                        name: 'Vidéothèque',
                        data: [31, 40, 28, 51, 42, 82, 56],
                      }, {
                        name: 'Bibliothèque',
                        data: [11, 32, 45, 32, 34, 52, 41]
                      }, {
                        name: 'Fascicules',
                        data: [15, 11, 32, 18, 9, 24, 11]
                      }, {
                        name: 'Description de l\'emploi',
                        data: [15, 11, 32, 18, 9, 24, 60]
                      }],
                      
                      chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                          show: false
                        },
                      },
                      markers: {
                        size: 4
                      },
                      colors: ['#4154f1', '#2eca6a', '#ff771d', '#fd72d7'],
                      fill: {
                        type: "gradient",
                        gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth',
                        width: 2
                      },
                      xaxis: {
                        type: 'datetime',
                        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                      },
                      tooltip: {
                        x: {
                          format: 'dd/MM/yy HH:mm'
                        },
                      }
                    }).render();
                  });
                </script>
                <!-- End Line Chart -->

              </div>

            </div>
          </div><!-- End Reports -->


  </section>







@endsection