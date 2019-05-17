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
                                    <li class="steps-nav__item">
                                        <a>
                                            <span class="number">3</span>
                                            <span class="title">Bước 3: Xem lại khóa học</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="setting js-setting">
                            <div class="block-group">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="block">
                                        <div class="block-headline">
                                            <h3 class="title">Mô tả chi tiết</h3>
                                        </div>
                                        <div class="block-inner">
                                            <div class="grid form-group">
                                                <div class="grid-left">
                                                    <label for="exampleInputTemplateDateStart">Ngày bắt đầu *</label>
                                                </div>
                                                <div class="grid-right">
                                                    <input class="form-control width-40 datetime-start" id="exampleInputTemplateDateStart" name="course_date_start"
                                                           required="required" oninvalid="this.setCustomValidity('Vui lòng nhập thời gian bắt đầu!')" oninput="setCustomValidity('')"
                                                           value="{{old('course_date_start')}}">
                                                </div>
                                            </div>
                                            <div class="grid form-group">
                                                <div class="grid-left">
                                                    <label for="exampleInputTemplateDateEnd">Ngày kết thúc *</label>
                                                </div>
                                                <div class="grid-right">
                                                    <input class="form-control width-40 datetime-end" id="exampleInputTemplateDateEnd" name="course_date_end"
                                                           required="required" oninvalid="this.setCustomValidity('Vui lòng nhập thời gian kết thúc!')" oninput="setCustomValidity('')"
                                                           value="{{old('course_date_end')}}">
                                                </div>
                                            </div>
                                            <div class="grid form-group">
                                                <div class="grid-left">
                                                    <label for="exampleInputTemplatePrice">Học phí *</label>
                                                </div>
                                                <div class="grid-right">
                                                    <input class="form-control" type="text" id="exampleInputTemplatePrice" name="course_price"
                                                           placeholder="VD: 1000000 (Không nhập dấu . và , )" required="required" value="{{old('course_price')}}"
                                                           oninvalid="this.setCustomValidity('Vui lòng nhập học phí!')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="grid form-group">
                                                <div class="grid-left">
                                                    <label for="exampleInputTemplateStudentNumber">Số lượng học sinh tối đa</label>
                                                </div>
                                                <div class="grid-right">
                                                    <input class="form-control" type="text" id="exampleInputTemplateStudentNumber" name="course_student_limit"
                                                           placeholder="VD: 10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block js-date">
                                        <div class="block-headline">
                                            <h3 class="title">Thời gian buổi học</h3>
                                        </div>
                                        <div class="block-inner">
                                            <div class="grid">
                                                <div class="grid-left"></div>
                                                <div class="grid-right">
                                                    <div class="grid grid-mg15">
                                                        <div class="grid-50 grid-p15">Bắt đầu</div>
                                                        <div class="grid-50 grid-p15">Kết thúc</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="group">

                                                @if (count($templateDetail->getTemplateLesson) > 0)
                                                    @foreach($templateDetail->getTemplateLesson as $k => $lesson)
                                                        <div class="grid form-group">
                                                            <div class="grid-left">
                                                                <label for="exampleInputTemplateDateStart">{{ $lesson->name }} *</label>
                                                            </div>
                                                            <div class="grid-right">
                                                                <div class="grid grid-mg15">
                                                                    <div class="grid-50 grid-p15">
                                                                        <div class="grid grid-mg7">
                                                                            <div class="grid-60 grid-p7">
                                                                                <input class="form-control datetime-start-{{ $k }}" id="exampleInputTemplateDateStart-{{ $lesson->template_lesson_id }}" name="exampleInputTemplateDateStart-{{ $lesson->template_lesson_id }}" value="">
                                                                            </div>
                                                                            <div class="grid-40 grid-p7">
                                                                                <input class="form-control timepicker" id="exampleInputTemplateTimeStart-{{ $lesson->template_lesson_id }}" name="exampleInputTemplateTimeStart-{{ $lesson->template_lesson_id }}" value="00:00">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid-50 grid-p15">
                                                                        <div class="grid grid-mg7">
                                                                            <div class="grid-60 grid-p7">
                                                                                <input class="form-control datetime-end-{{ $k }}" id="exampleInputTemplateDateEnd-{{ $lesson->template_lesson_id }}" name="exampleInputTemplateDateEnd-{{ $lesson->template_lesson_id }}"  value="">
                                                                            </div>
                                                                            <div class="grid-40 grid-p7">
                                                                                <input class="form-control timepicker" id="exampleInputTemplateTimeEnd-{{ $lesson->template_lesson_id }}" name="exampleInputTemplateTimeEnd-{{ $lesson->template_lesson_id }}" value="00:00">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="block file">
                                        <div class="block-headline">
                                            <h3 class="title">Tài liệu khóa học</h3>
                                        </div>
                                        <div class="block-inner">
                                            <div class="grid">
                                                <div class="grid-left">Lựa chọn tài liệu <br>giảng dạy</div>
                                                <div class="grid-right">
                                                    <div class="btn-input">
                                                        {{--<span><i class="fa fa-camera-retro"></i>Chọn file từ thư viện</span>--}}
                                                        <input id="exampleInputTemplateMediaImage" multiple="multiple" name="course_documents[]" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="grid-left"></div>
                                                <div class="grid-right">
                                                    {{--<form action="/file-upload" class="dropzone"></form>--}}
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="grid-left">Lựa chọn bộ đề <br>trắc nghiệm</div>
                                                <div class="grid-right">
                                                  <a href="" class="btn-file" data-modal="#modal-exam">Chọn bộ đề</a>
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="grid-left">
                                                    Bộ đề trắc nghiệm : 
                                                </div>
                                                <div class="grid-right">
                                                <p id="name-exam"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="course_template_id" value="{{ $course_template_id }}">
                                    
                                    <input type="hidden" name="exam_id" id="exam_id" value="">
                                    <button class="btn btn-next" type="submit" id="login-btn-submit">Tiếp theo <i class="fa fa-angle-double-right"></i></button>
                                </form>
                            </div>
                        </div>
                        <!--
                          bằng Số buổi học mà người dùng nhập vào ID = exampleInputTemplateSession
                          ví dụ ở đây nhừng dùng nhập số buổi là 5.
                        -->
                        {{--<script>--}}
                            {{--// const numberLesson = 5;--}}
                        {{--</script>--}}
                    </section>
                </div> <!-- / col-9 -->

            </div>

        </div> <!-- / container -->

    </main> <!-- / main -->
    <!-- Modal -->
    <div class="modal" id="modal-exam">
        <div class="modal-exit"></div>
        <div class="modal-inner">
          <div class="list-file">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($teacher->getExam)>0)
                    @foreach($teacher->getExam as $exam)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $exam->name }}</td>
                        <td><a class="status select-exam" data-exam-id="{{ $exam->exam_id }}" data-name="{{ $exam->name }}">Chọn</a></td>
                    </tr>
                    @endforeach
                    @else 
                    {{'Chưa có bộ đề thi trắc nghiệm'}}
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script>
        var count_template = "{{count($templateDetail->getTemplateLesson)}}";
        $('.datetime-start').datetimepicker({
            format: "DD-MM-YYYY"
        });
        $('.datetime-end').datetimepicker({
            useCurrent: false, //Important! See issue #1075,
            format: "DD-MM-YYYY" 
        });
        $(".datetime-start").on("dp.change", function (e) {
            console.log($('.datetime-end').data("DateTimePicker"));
            $('.datetime-end').data("DateTimePicker").minDate(e.date);
        });
        $(".datetime-end").on("dp.change", function (e) {
            $('.datetime-start').data("DateTimePicker").maxDate(e.date);
        });
        if(count_template > 0){
            for(var i = 0; i < count_template; i++){
                console.log('.datetime-start-' + i);
                $('.datetime-start-' + i).datetimepicker({
                    format: "DD-MM-YYYY"
                });
                $('.datetime-end-' + i).datetimepicker({
                    useCurrent: false, //Important! See issue #1075,
                    format: "DD-MM-YYYY" 
                });
                // $(".datetime-start-" + i).on("dp.change", function (e) {
                //     $('.datetime-end-' + i).data("DateTimePicker").minDate(e.date);
                // });
                // $(".datetime-end-" + i).on("dp.change", function (e) {
                //     $('.datetime-start-' + i).data("DateTimePicker").maxDate(e.date);
                // });
            }
        }
        $('body').on('click','.select-exam',function(){
            var exam_id = $(this).data('exam-id');
            var exam_name = $(this).data('name');
            console.log(exam_id);
            $("#exam_id").val(exam_id);
            $("#name-exam").text(exam_name);
        });
    </script>
@stop
