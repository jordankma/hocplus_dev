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
            <li class="breadcrumb-item"><a href="{{URL::to('')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Mua khóa học</li>
          </ol>
        </div>
      </nav> <!-- / breadcrumb -->

      <section class="pay-course">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 left">
              <div class="group">
                <div class="headline">
                  <div class="row">
                    <div class="col-9">Khóa học</div>
                    <div class="col-3">Học phí</div>
                  </div>
                </div>
                <figure class="item">
                  <div class="wrapper">
                    <div class="inner">
                      <div class="row">
                        <div class="col-12 col-md-9">
                          <div class="content">
                            <div class="img">
                              <a href="{{ route('hocplus.course.detail',$data['course_id']) }}"><img src="{{ config('site.url_static') . $data['avartar'] }}" alt=""></a>
                            </div>
                            <div class="info">
                              <h3 class="name"><a href="{{ route('hocplus.course.detail',$data['course_id']) }}">{{$data['name']}}</a></h3>
                              <div class="lecturers">
                                <div class="avatar">
                                  <img src="{{$data['teacher_avatar']}}" alt="">
                                </div>
                                <a class="name-lecturers" href="">{{$data['teacher_name']}}</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-3">
                          <div class="price">
                            <div class="real">{{number_format($data['price'], 0, ',', '.')}}<span>đ</span></div>
                            @if($data['price_discount'] > 0)
                              <div class="fake">{{number_format($data['price_before'], 0, ',', '.')}}<span>đ</span></div>
                              <div class="events">-{{$data['discount']}}%</div>
                            @endif
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </figure> <!-- / item -->
              </div>
            </div> <!-- / left -->
            <div class="col-12 col-lg-4 right">
              <div class="buying">
                <div class="price-detail">
                  <div class="inner">
                    <div class="price">
                      <div class="text">Tạm tính</div>
                      <div class="number">{{number_format($data['price'], 0, ',', '.')}}<span>đ</span></div>
                    </div>
                    <div class="sale">
                      <!-- <div class="text">Giảm giá</div>
                      <div class="number">20.000<span>đ</span></div> -->
                    </div>
                  </div>
                  <div class="total-price">
                    <div class="text">Thành tiền</div>
                    <div class="number total_price">{{number_format($data['price'], 0, ',', '.')}}<span>đ</span></div>
                  </div>
                </div>
                @if(!$checkExits)
                <div class="discount-code">
                  <form>
                    <div class="form-group">
                      <label for="exampleInputDiscountCode">Bạn có mã giảm giá?</label>
                      <input type="text" class="form-control" id="voucher_code" placeholder="Nhập mã giảm giá">
                      <input type="hidden" class="form-control" id="courseId" value="{{$data['course_id']}}">
                      <input type="hidden" class="form-control" id="secretKey" value="{{$data['secret_key']}}">
                      <input type="hidden" class="form-control" id="price" value="{{$data['price']}}">
                      <input type="hidden" class="form-control" id="discount_voucher" value="0">
                      <input type="hidden" class="form-control" id="discount_course" value="{{$data['price_discount']}}">                      
                    </div>
                    <button type="button" class="btn btn-use-voucher">Áp dụng</button>
                  </form>
                </div>                
                  <a href="#" class="btn btn-buying">Mua khóa học</a>
                @endif
              </div>

            </div><!-- / right -->
          </div>
        </div> <!-- / container -->
      </section> <!-- / pay course -->
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
    <script>
      $('body').on('click', '.btn-use-voucher', function(){
        let voucherCode = $("#voucher_code").val();
        let courseId = $("#courseId").val();
        let secretKey = $("#secretKey").val();
        let price = $("#price").val();
        $.ajax({
            url: '/buy-course/use-voucher',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
            },
            type: 'POST',
            cache: false,
            data: {
                voucherCode: voucherCode,
                courseId: courseId,
                secretKey: secretKey,
                price: price
            },
            success: function (response) {
                  if (response.status == true) {
                    $("#secretKey").val(response.data.secretKey);
                    $("#price").val(response.data.price);
                    $("#discount_voucher").val(response.data.discountVoucher);
                    let html = `<div class="text">Giảm giá</div>
                              <div class="number">${response.data.labelDiscountVoucher}<span>đ</span></div>`;
                    $('.sale').html(html);
                    $('.total_price').html(response.data.labelPrice + '<span>đ</span>');                          
                  } 
                  alert(response.msg);
            }
        }, 'json');
      });

      $('body').on('click', '.btn-buying', function(){
          let voucherCode = $("#voucher_code").val();
          let courseId = $("#courseId").val();
          let secretKey = $("#secretKey").val();
          let price = $("#price").val();
          let discountVoucher = $("#discount_voucher").val();          
          let discountCourse = $("#discount_course").val();
          $.ajax({
            url: '/buy-course/create-order',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
            },
            type: 'POST',
            cache: false,
            data: {
                voucherCode: voucherCode,
                courseId: courseId,
                secretKey: secretKey,
                price: price,
                discountVoucher: discountVoucher,
                discountCourse: discountCourse                
            },
            success: function (response) {
                if(response.status == true){
                    window.location.href = response.redirect;
                } else {
                  alert(response.msg);
                }
            }
        }, 'json');

      })
    </script>
@stop
