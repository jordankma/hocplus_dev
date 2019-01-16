@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ isset($course->name) ? $course->name : 'Khóa học' }}@stop

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
                    <li class="breadcrumb-item"><a href="#">{{ isset($course->isClass->name) ? $course->isClass->name : 'Lớp' }}</a></li>
                    <li class="breadcrumb-item active">{{ isset($course->name) ? $course->name : 'Khóa học' }}</li>
                </ol>
            </div>
        </nav> <!-- / breadcrumb -->

        <div class="container container-main" style="margin-top: 20px">
            <div class="row row-main">
                <div class="col-12 col-lg-8 main-left">
                    <div class="c-detail">
                        <div class="headline">
                            <h1 class="title">{{ isset($course->name) ? $course->name : 'Khóa học' }}</h1>
                            <span class="number-evaluate">
                  <span class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                  {{-- <span class="number">( 35 )</span> --}}
                </span>
                        </div> <!-- / headline -->
                        <div class="user">
                            <div class="avatar">
                                <img src="{{ config('site.url_static') . $course->isTeacher->avatar_detail }}" alt="">
                            </div>
                            <div class="name">{{ $course->isTeacher->name }}</div>
                        </div> <!-- / user -->
                        <div class="media">
                            <iframe width="560" height="315" src="{{ $course->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div> <!-- / media -->
                        <div class="feature">
                            <div class="title">Bạn sẽ được học</div>
                            {!! $course->will_learn !!}
                        </div> <!-- / feature -->
                        <div class="result">
                            <div class="title">Mục tiêu khóa học:</div>
                            {!! $course->target !!}
                        </div> <!-- / result -->
                        <div class="request">
                            <div class="title">Các yêu cầu khóa học:</div>
                            {!! $course->request_content !!}
                        </div> <!-- / request -->
                        @include('HOCPLUS-COURSEGROUP::modules.frontend.course._partial._calendar')
                        <!-- / calendar -->
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_8swg"></div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c0e409afa177bdd"></script>
                        <!-- / end -->

                        @include('HOCPLUS-FRONTEND::modules.frontend.course._partial._evaluate')

                        @include('HOCPLUS-FRONTEND::modules.frontend.course._partial._commit')

                    </div>
                </div> <!-- / main left -->

                <div class="col-12 col-lg-4 main-right">
                    <div class="c-course-info">
                        <div class="price"><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span></div>
                        <div class="info">
                            <ol>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/book.png" alt=""> Môn học: Văn</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/book1.png" alt=""> Khối lớp: 10</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user.png" alt=""> Số buổi: 10 buổi</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/date.png" alt=""> Thời lượng: 2 tiếng</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user1.png" alt=""> Số lượng HS tối đa: 50 người</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user2.png" alt=""> Số lượng HS đã tham gia: 27 người</li>
                            </ol>
                        </div>
                        <a class="btn btn-registration" href="">Đăng ký ngay</a>
                    </div> <!-- / course info -->

                    @include('HOCPLUS-FRONTEND::modules.frontend.course._partial._related')
                </div> <!-- / main right -->

            </div> <!-- / row -->
        </div> <!-- / container -->



    </main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
