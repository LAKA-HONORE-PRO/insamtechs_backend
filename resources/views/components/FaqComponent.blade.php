<section id="faque" class="faque section-bg">
    <div class="container">

      <div class="section-title" >
        <h2>F.A.Q</h2>
        <p>@lang('message.faq')</p>
      </div>

  
      @if (sizeof($faqs) > 0)

      @php
        $i = 0;
      @endphp

          @forelse ($faqs as $faq)

      @php
       $i = $i + 1;
     @endphp
          <div class="faque-list">
            <ul class="ull">
    
              <li class="lii" >
                  
                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faque-list-{{$i}}"> {{ucfirst($faq->intitule)}} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faque-list-{{$i}}" class="collapse" data-bs-parent=".faque-list">
                  <p>
                    {{ucfirst($faq->reponse)}}
                  </p>
                  <a href="{{$faq->lien}}" style="color: rgb(88, 16, 197)" target="_blank"> En savoir plus </a>
                </div>
              </li>
            </ul>
          </div>
    
          @empty
            
          @endforelse
     
      @endif

    </div>
  </section><!-- End F.A.Q Section -->
