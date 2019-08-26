{{-- <section class="c-hero">
    <div class="backgrounb">
      <img src="{{ config('site.url_static') . $bannerHome->image }}" alt="">
    </div> <!-- / backgrounb -->
    <div class="container">
      <div class="button-group">
        <div class="row">
          <div class="col-md-4">
            <a href="#" class="btn btn-red"><span>Lựa chọn giáo viên<i class="fa fa-arrow-right"></i></span><img
                src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/images/icon-01.png' }}" alt=""></a>
          </div>
          <div class="col-md-4">
            <a href="#" class="btn btn-blue"><span>Đăng ký khóa học<i class="fa fa-arrow-right"></i></span><img
                src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/images/icon-02.png' }}" alt=""></a>
          </div>
          <div class="col-md-4">
            <a href="#" class="btn btn-white btn-active-advisory"><span>Tư vấn miễn phí<i
                  class="fa fa-arrow-right"></i></span><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/images/icon-03.png' }}" alt=""></a>
          </div>
        </div>
      </div> <!-- / button group -->
    </div> <!-- / container -->
  </section> <!-- / hero --> --}}
  <section class="c-hero">
    <div class="backgrounb js-backgrounb">
      @if(!empty($bannerHome))
      @foreach($bannerHome as $item)
        <div class="item"><a href="{{ $item->link }}"><img src="{{ config('site.url_static') . $item->image }}" alt=""></a></div>
      @endforeach
      @endif
    </div> <!-- / backgrounb -->
    <div class="btn-group">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <a href="{{ route('home.teacher.index') }}" class="btn btn-red"><span>Lựa chọn giáo viên<i class="fa fa-arrow-right"></i></span><img
                src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/images/icon-01.png' }}" alt=""></a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('hocplus.course.list') }}" class="btn btn-blue"><span>Đăng ký khóa học<i class="fa fa-arrow-right"></i></span><img
                src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/images/icon-02.png' }}" alt=""></a>
          </div>
          <div class="col-md-4">
            <a href="#" class="btn btn-white btn-active-advisory"><span>Tư vấn miễn phí<i
                  class="fa fa-arrow-right"></i></span><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/images/icon-03.png' }}" alt=""></a>
          </div>
        </div>
      </div>
    </div> <!-- / button group -->
  </section> <!-- / hero -->