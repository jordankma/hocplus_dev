@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Homepage" }}@stop

{{-- page level styles --}}
@section('header_styles')
@if($agent->isMobile())
  <style>
    .pay-course .container::before {
      display: none !important;
  }
  </style>
@endif
@stop

{{-- Page content --}}
@section('content')   
<main class="main">
    @if(!$agent->isMobile())
      <nav class="c-breadcrumb">
        <div class="container">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Mua khóa học</a></li>
            <li class="breadcrumb-item"><a href="#">Thông tin thanh toán</a></li>
            <li class="breadcrumb-item"><a href="#">Xem lại đơn hàngn</a></li>
            <li class="breadcrumb-item active">Hoàn thành đơn hàng</li>
          </ol>
        </div>
      </nav> <!-- / breadcrumb -->
    @endif  

      <section class="pay-notification">
        <div class="container">
          <div class="wrapper">
            <div class="inner">
              <h2 class="title">Mua khóa học thành công</h2>
              <img src="{{asset('image/thanh-cong.png')}}" alt="">
              <p>Cảm ơn quý khách đã mua khóa học tại Học Plus. Bạn đã chọn hình thức thanh toán {{$method->type}}, mã đơn hàng của
                quý khách là:</p>
              <div style="font-size: 30px;font-weight: 700;color: #d2232f;">{{$order_code}}</div>
              <p>
               {{$method->notifi}}
              </p>
            </div>
          </div>
          <a class="btn" href="{{URL::to('khoa-hoc-cua-toi')}}">Xem khóa học</a>
        </div>
      </section> <!-- / notification -->
</main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        var resetToken = '{{ $resetToken }}';        
        var routeApigetCourse = '{{ route('hocplus.frontend.api.getCourse') }}';
        var routeApigetCourseRun = '{{ route('hocplus.frontend.api.getCourseRun') }}';
    </script>
    <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/script/homepage.js' }}"></script>
    
@stop
