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

                <div class="col-12 col-md-8 col-lg-9">
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
                        <div class="ml-detail ml-fix js-ml-fix">
                            <form method="post" enctype="multipart/form-data">
                            <div class="detail-wrapper">
                                <a class="btn-edit"><i class="fa fa-pencil"></i> Sửa</a>
                                <div class="headline">
                                    <h2 class="title">
                                        <input type="text" class="fix-content" name="courseName" value="{{ $course->name }}">
                                    </h2>
                                </div>
                                <div class="media">
                                    @php
                                        $url = $course->video;
                                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                                        $id = isset($matches[1]) ? $matches[1] : '';  

                                    @endphp
                                    <input type="text" class="fix-content content-editor" name="courseVideo" value="{{ $course->video }}" style="display: none; margin-bottom: 5px">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$id}}?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="info">
                                    <ul class="row list">
                                        {{--<li class="col-6 item"><i class="fa fa-book-open"></i> Môn học: <input class="fix-content" name="courseSubject" type="text" value="{{ $course->isSubject->name }}"></li>--}}
                                        <li class="col-6 item"><i class="fa fa-book-open"></i> Môn học: {{ $course->isSubject->name }}</li>
                                        <li class="col-6 item"><i class="fa fa-clock"></i> Thời lượng: <input class="fix-content" name="courseTime" type="text" value="{{ $course->time }}" style="text-align: right; width: 20px"> giờ</li>
                                        {{--<li class="col-6 item"><i class="fa fa-bookmark"></i> Khối lớp: <input class="fix-content" name="courseClasses" type="text" value="{{ $course->isClass->name }}"></li>--}}
                                        <li class="col-6 item"><i class="fa fa-bookmark"></i> Khối lớp: {{ $course->isClass->name }}</li>
                                        <li class="col-6 item"><i class="fa fa-group"></i> Số lượng HS tối đa: <input class="fix-content" name="courseStudentLimit" type="text" value="{{ $course->student_limit }}" style="text-align: right; width: 20px"> người</li>
                                        <li class="col-6 item"><i class="fa fa-chalkboard-teacher"></i> Số buổi: {{ count($course->getLesson) }} buổi</li>
                                    </ul>
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Bạn sẽ được học</h3>
                                    </div>
                                    <div class="content-preview">{!! $course->will_learn !!}</div>
                                    <textarea class="fix-content content-editor" id="courseWillLearn" name="courseWillLearn" style="display: none">{!! $course->will_learn !!}</textarea>
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Mục tiêu khóa học:</h3>
                                    </div>
                                    <div class="content-preview">{!! $course->target !!}</div>
                                    <textarea class="fix-content content-editor" id="courseTarget" name="courseTarget" style="display: none">{!! $course->target !!}</textarea>
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Các yêu cầu khóa học:</h3>
                                    </div>
                                    <div class="content-preview">{!! $course->request_content !!}</div>
                                    <textarea class="fix-content content-editor" id="courseRequestContent" name="courseRequestContent" style="display: none">{!! $course->request_content !!}</textarea>
                                </div>
                                <div class="ingredient">
                                    <div class="ingredient-headline">
                                        <h3 class="title">Nội dung khóa học:</h3>
                                    </div>
                                    <div class="calendar">
                                        <div class="row">
                                            <div class="col-2"><b>Lịch học</b></div>
                                            <div class="col-6"><b>Thời gian biểu</b></div>
                                            <div class="col-4"><b>Vào lớp</b></div>
                                        </div>
                                        @if (count($course->getLesson) > 0)
                                            @foreach($course->getLesson as $k => $lesson)
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="text" class="fix-content" name="lessonName[]" value="{{ $lesson->name }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <p><textarea class="fix-content" name="lessonContent[]">{!! $lesson->content !!}</textarea></p>
                                                    </div>
                                                    <div class="col-4">
                                                            {{-- {{ date('d/m/Y - H:i', $lesson->date_start) }} --}}
                                                        <p><input class="fix-content datetime" name="lessonStart[]" value="{{ date('d-m-Y - H:i', $lesson->date_start) }}"></p>
                                                        <p><input class="fix-content datetime" name="lessonEnd[]" value="{{ date('d-m-Y - H:i', $lesson->date_start + $lesson->time_line*60) }}"></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--<a href="{{ route('hocplus.frontend.create-course.step4') }}?id={{ $course->course_id }}" class="btn btn-next">Đăng khóa học</a>--}}
                                <button class="btn btn-next" type="submit" id="login-btn-submit">Lưu <i class="fa fa-angle-double-right"></i></button>
                            </form>
                        </div>
                    </section>
                </div> <!-- / col-9 -->

            </div>

        </div> <!-- / container -->

    </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/config.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/vnedutech-cms/default/hocplus/frontend/script/create-course.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        // ml fix
        const fix = $('.js-ml-fix');
        if (fix) {
          const btnEdit = $('.js-ml-fix .detail-wrapper > .btn-edit');
          const body = $('body');
          const ACTIVE_CLASS = 'ml-fix-active';
          btnEdit.on('click', function () {

            $(".content-preview").css('display', 'none');
            $(".content-editor").css('display', 'block');

            body.toggleClass(ACTIVE_CLASS);
            editContent();
            return false;
          });
        }

        function editContent () {
          $('textarea#courseWillLearn,textarea#courseTarget,textarea#courseRequestContent').ckeditor({
            height: '150px',
            toolbar: [
              {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
              }, '',
              {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
              }, '',
              {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
              {name: 'colors', items: ['TextColor', 'BGColor']}, //{name: 'insert', items: [ 'Image' ] },
              {name: 'tools', items: ['Maximize', 'ShowBlocks']},
            ]
          });
        }
        $('.datetime').datetimepicker({
            format: "DD-MM-YYYY HH:mm"
        });
    </script>
@stop
