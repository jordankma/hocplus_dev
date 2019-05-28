@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Homepage" }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')   
<main class="main">
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

      <section class="pay-notification">
        <div class="container">
          <div class="wrapper">
            <div class="inner">
              <h2 class="title">Mua khóa học thành công</h2>
              <img src="{{asset('image/thanh-cong.png')}}" alt="">
              <p>Sau khi nhận được thông tin về việc thanh toán, chúng tôi sẽ kích hoạt khóa học. Chúc bạn có những bài học thật hay và bổ ích</p>
              {{--  <div style="font-size: 30px;font-weight: 700;color: #d2232f;">{{$order_code}}</div>  --}}
              <p>
               {{--  {{$method->notifi}}  --}}
              </p>
            </div>
          </div>
          <a class="btn" href="{{route('hocplus.studentprofile.bang-thong-tin')}}">Xem khóa học</a>
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
