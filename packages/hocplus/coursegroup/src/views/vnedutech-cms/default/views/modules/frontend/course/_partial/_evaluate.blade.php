<div class="evaluate">
    @if(Auth::guard('member')->check())
    <div class="btn-evaluate">
      <span class="text">Đánh giá</span>
      <span class="stars js-stars" data-modal="#modal-stars">
        @for ($i=1; $i<= $your_rate; $i++ )
            <i class="fa fa-star star rating active" id="rating{{$i}}" data-value="{{$i}}"></i>
        @endfor
        @for ($i= $your_rate+1; $i<=5; $i++)
            <i class="fa fa-star star rating" id="rating{{$i}}" data-value="{{$i}}"></i>
        @endfor

      </span>
    </div>
    @endif
    <div class="row inner">
      <div class="col-12 col-md-3 left">
        <div class="inner">
          <div class="number">{{$rate}}</div>
          <div class="star">
            @for ($i=1; $i<= round($rate); $i++)
            <i class="fa fa-star active"></i>
            @endfor
            @for ($i=round($rate)+1; $i<=5; $i++)
            <i class="fa fa-star"></i>
            @endfor
          </div>
        </div>
      </div>
      <div class="col-7 col-md-6 center">
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{$stars[5]}}%"></div>
        </div>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{$stars[4]}}%"></div>
        </div>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{$stars[3]}}%"></div>
        </div>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{$stars[2]}}%"></div>
        </div>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{$stars[1]}}%"></div>
        </div>
      </div>
      <div class="col-5 col-md-3 right">
        <div class="statistic">
          <div class="star">
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
          </div>
          <div class="number">{{$stars[5]}}%</div>
        </div>
        <div class="statistic">
          <div class="star">
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star"></i>
          </div>
          <div class="number">{{$stars[4]}}%</div>
        </div>
        <div class="statistic">
          <div class="star">
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <div class="number">{{$stars[3]}}%</div>
        </div>
        <div class="statistic">
          <div class="star">
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <div class="number">{{$stars[2]}}%</div>
        </div>
        <div class="statistic">
          <div class="star">
            <i class="fa fa-star active"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <div class="number">{{$stars[1]}}%</div>
        </div>
      </div>
    </div><!-- / inner -->
  </div> <!-- / evaluate -->