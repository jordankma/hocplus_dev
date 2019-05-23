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
                                    <li class="steps-nav__item">
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
                            <div class="headline">
                                <h3 class="title">Lựa chọn khung khóa học</h3>
                            </div>
                            <ul class="menu">
                                <li class="{{ $tab == 0 ? 'menu-active' : '' }}" data-choose="#template-available">Chọn khung khóa học</li>
                                <li class="{{ $tab == 1 ? 'menu-active' : '' }}" data-choose="#template-new">Tạo khung khóa học</li>
                            </ul>
                            <div class="template-available {{ $tab == 0 ? 'template-active' : '' }}" id="template-available">
                                <div class="group">
                                    <div class="row">

                                        @if (count($allCourse) > 0)
                                            @foreach($allCourse as $template)
                                                <figure class="col-6 col-md-3 item" title="{{ $template->template_name }}"
                                                        data-id="{{ $template->course_template_id }}"
                                                        data-href="{{ route('hocplus.frontend.create-course.step2') }}">
                                                    <div class="inner">
                                                        <div class="img">
                                                            <div class="wrapper">
                                                                <span><img src="{{ config('site.url_storage') . (substr($template->template_avatar, 0, 6) != '/files' ? '/files/' . $template->template_avatar : $template->template_avatar) }}" alt=""></span>
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <h3 class="title">{{ $template->template_name }}</h3>
                                                        </div>
                                                    </div>
                                                </figure> <!-- / item -->
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <a class="btn btn-next" id="btn-next1-create-course" data-course-id="0">
                                    Tiếp theo <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <div class="template-new {{ $tab == 1 ? 'template-active' : '' }}" id="template-new">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="all">
                                        @if($errors->any())
                                            <div class="alert alert-danger" role="alert">
                                                @foreach($errors->all() as $error)
                                                    {{$error}}<br>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateName">Tên khóa học *</label>
                                            </div>
                                            <div class="grid-right">
                                                <input class="form-control" type="text" id="exampleInputTemplateName" name="template_name"
                                                       required="required" oninvalid="this.setCustomValidity('Vui lòng nhập tên mẫu!')" oninput="setCustomValidity('')"
                                                       value="{{old('template_name')}}" placeholder="VD: Khóa học bồi dưỡng học sinh giỏi lớp 12 - Môn Sinh">
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateCategories">Chuyên mục *</label>
                                            </div>
                                            <div class="grid-right">
                                                <div class="grid">
                                                    <div class="grid-50">
                                                        <select class="form-control" id="exampleInputTemplateCategoriesSpecies" name="template_subject_id"
                                                                required="required" value="{{old('template_subject_id')}}" oninvalid="this.setCustomValidity('Vui lòng chọn môn học!')"
                                                                oninput="setCustomValidity('')" onchange="filterClasses()">
                                                            {{-- <option selected="true" disabled="disabled">Môn học</option> --}}
                                                            @if (count($arrSubject) > 0)
                                                                @foreach($arrSubject as $subject)
                                                                <option value="{{ $subject->getSubject->subject_id }}">{{ $subject->getSubject->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="grid-50">
                                                        <select class="form-control" id="exampleInputTemplateCategoriesClass" name="template_classes_id"
                                                                required="required" value="{{old('template_classes_id')}}" oninvalid="this.setCustomValidity('Vui lòng chọn khối lớp!')"
                                                                oninput="setCustomValidity('')">
                                                            {{-- <option selected="true" disabled="disabled">Lớp học</option> --}}
                                                            @if (count($arrClasses) > 0)
                                                                @foreach($arrClasses as $classes)
                                                                    <option value="{{ $classes->classes_id }}">{{ $classes->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateSession">Số buổi học *</label>
                                            </div>
                                            <div class="grid-right">
                                                <input class="form-control" type="text" id="exampleInputTemplateSession" name="template_numlesson" value="{{old('template_numlesson')}}"
                                                       required="required" oninvalid="this.setCustomValidity('Vui lòng nhập số buổi học!')" oninput="setCustomValidity('')" placeholder="Số buổi học trong khóa học">
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateSessionNumber">Thời lượng buổi học *</label>
                                            </div>
                                            <div class="grid-right">
                                                <input class="form-control" type="text" id="exampleInputTemplateSessionNumber" name="template_timelesson" value="{{old('template_timelesson')}}"
                                                       required="required" oninvalid="this.setCustomValidity('Vui lòng nhập tổng thời lượng khóa học!')" oninput="setCustomValidity('')" placeholder="Tổng số giờ của khóa học">
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateMedia">Ảnh hoặc Video đại diện</label>
                                            </div>
                                            <div class="grid-right">
                                                <div class="form-control-input-media">
                                                    <div class="show-media">
                                                        <div class="img">
                                                            <img id="profile-img-tag" src="src/images/logo-all.png" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="btn-input">
                                                        <span><i class="fa fa-camera-retro"></i>Thay ảnh đại diện</span>
                                                        <input id="exampleInputTemplateMediaImage" name="template_avatar" type="file" accept="image/*">
                                                    </div>
                                                </div>
                                                <span class="form-text"><i>Kích thước tối thiểu: 750 * 400</i></span>
                                                <input class="form-control form-control-video" type="text" name="template_video_intro" id="exampleInputTemplateMediaVideo"
                                                       value="{{old('template_video_intro')}}" placeholder="Hoặc nhập URL video VD: https://www.youtube.com/watch?v=qcIfT7V0RT0">
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateDescription">Mô tả ngắn gọn</label>
                                            </div>
                                            <div class="grid-right">
                                                <textarea class="form-control" rows="6" type="text" name="template_summary" id="exampleInputTemplateDescription"
                                                          value="{{old('template_summary')}}" placeholder="Ví dụ: Mọi kiến thức căn bản về tiếng anh lớp 10 v.v... (Tối đa 100 ký tự)"></textarea>
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplatekKeyWord">Từ khóa</label>
                                            </div>
                                            <div class="grid-right">
                                                <input class="form-control" type="text" name="template_keyword" id="exampleInputTemplatekKeyWord"
                                                       value="{{old('template_keyword')}}" placeholder="VD: Môn anh, tiếng anh, học sinh giỏi">
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateResult">Bạn sẽ được học *</label>
                                            </div>
                                            <div class="grid-right">
                                                <textarea class="form-control" rows="6" name="template_will_learn" id="exampleInputTemplateResult"
                                                          required="required" oninvalid="this.setCustomValidity('Vui lòng nhập nội dung!')" oninput="setCustomValidity('')" value="{{old('template_will_learn')}}"></textarea>
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateTarget">Mục tiêu khóa học *</label>
                                            </div>
                                            <div class="grid-right">
                                                <textarea class="form-control" rows="6" name="template_target" id="exampleInputTemplateTarget"
                                                          required="required" oninvalid="this.setCustomValidity('Vui lòng nhập nội dung!')" oninput="setCustomValidity('')" value="{{old('template_target')}}"></textarea>
                                            </div>
                                        </div>
                                        <div class="grid form-group">
                                            <div class="grid-left">
                                                <label for="exampleInputTemplateRequest">Yêu cầu khóa học *</label>
                                            </div>
                                            <div class="grid-right">
                                                <textarea class="form-control" rows="6" name="template_request_content" id="exampleInputTemplateRequest"
                                                          required="required" oninvalid="this.setCustomValidity('Vui lòng nhập nội dung!')" oninput="setCustomValidity('')" value="{{old('template_request_content')}}"></textarea >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="posts">
                                        <div class="posts-headline">
                                            <div class="title">Nội dung buổi học</div>
                                        </div>
                                        <div class="posts-inner">
                                            <div class="posts-list"></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-next" type="submit" id="login-btn-submit">Tiếp theo <i class="fa fa-angle-double-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div> <!-- / col-9 -->

            </div>

        </div> <!-- / container -->

    </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        var teacher_id = {{ $teacher->teacher_id }};
        var route_name = '{{ route('hocplus.frontend.create-course.filter') }}';
    </script>
    <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/script/create-course.js' }}"></script>

    <script type="text/javascript">
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#exampleInputTemplateMediaImage").change(function(){
        readURL(this);
      });

    </script>
@stop
