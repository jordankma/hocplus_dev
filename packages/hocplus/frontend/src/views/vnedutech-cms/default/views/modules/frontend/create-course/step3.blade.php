@extends('HOCPLUS-TEACHERFRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Khởi tạo khóa học' }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    <main class="main ml-main">

        <div class="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-3 ml-left">
                    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial.profileteacher._ml-info')
                </div> <!-- / col-3 -->

                <div class="col-12 col-md-8 col-lg-9 ml-right">
                    <section class="ml-template">
                        <div class="headline">
                            <h2 class="title">Khởi tạo khóa học</h2>
                            <div class="steps">
                                <ul class="steps-nav">
                                    <li class="steps-nav__item active">
                                        <a>
                                            <span class="number">1</span>
                                            <span class="title">Bước 1: Thông tin chung</span>
                                        </a>
                                    </li>
                                    <li class="steps-nav__item active">
                                        <a>
                                            <span class="number">2</span>
                                            <span class="title">Bước 2: Mô tả chi tiết</span>
                                        </a>
                                    </li>
                                    <li class="steps-nav__item active">
                                        <a>
                                            <span class="number">3</span>
                                            <span class="title">Bước 3: Xem lại khóa học</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="ml-detail">
                            <div class="detail-wrapper">
                                <div class="headline">
                                    <h2 class="title">{{ $course->name }}</h2>
                                    <a href="" class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                </div>
                                <div class="media">
                                    <iframe width="560" height="315" src="{{ $course->video }}" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="info">
                                    <ul class="row list">
                                        <li class="col-6 item"><i class="fa fa-book-open"></i> Môn học: {{ $course->isSubject->name }}</li>
                                        <li class="col-6 item"><i class="fa fa-clock"></i> Thời lượng: {{ $course->time }} giờ</li>
                                        <li class="col-6 item"><i class="fa fa-bookmark"></i> Khối lớp: {{ $course->isClass->name }}</li>
                                        <li class="col-6 item"><i class="fa fa-group"></i> Số lượng HS tối đa: {{ $course->student_limit }} người</li>
                                        <li class="col-6 item"><i class="fa fa-chalkboard-teacher"></i> Số buổi: {{ count($course->getLesson) }} buổi</li>
                                    </ul>
                                    <a href="" class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Bạn sẽ được học</h3>
                                        <a href="" class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                    </div>
                                    {!! $course->will_learn !!}
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Mục tiêu khóa học:</h3>
                                        <a href="" class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                    </div>
                                    {!! $course->will_learn !!}
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Các yêu cầu khóa học:</h3>
                                        <a href="" class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                    </div>
                                    {!! $course->request_content !!}
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Nội dung khóa học:</h3>
                                        <a href="" class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                    </div>
                                    <div class="calendar">
                                        <div class="row">
                                            <div class="col-2"><b>Lịch học</b></div>
                                            <div class="col-7"><b>Thời gian biểu</b></div>
                                            <div class="col-3"><b>Vào lớp</b></div>
                                        </div>
                                        @if (count($course->getLesson) > 0)
                                            @foreach($course->getLesson as $k => $lesson)
                                                <div class="row">
                                                    <div class="col-2"><b>{{ $lesson->name }}</b></div>
                                                    <div class="col-7">
                                                        {!! $lesson->content !!}
                                                    </div>
                                                    <div class="col-3">
                                                        <p>{{ date('H:i - d/m/Y', $lesson->date_start) }}</p>
                                                        <p>{{ date('H:i - d/m/Y', $lesson->date_start + $lesson->time_line*60) }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('hocplus.frontend.create-course.step4') }}?id={{ $course->course_id }}" class="btn btn-next">Đăng khóa học</a>
                        </div>
                    </section>
                </div> <!-- / col-9 -->

            </div>

        </div> <!-- / container -->

    </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
