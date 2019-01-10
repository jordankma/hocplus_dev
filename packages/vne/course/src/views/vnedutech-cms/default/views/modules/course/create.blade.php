@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Tạo khóa học' }}@stop

{{-- page styles --}}
@section('header_styles')
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/css/bootstrap-switch.css' }}" rel="stylesheet" type="text/css"/>
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/css/pages/blog.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vne/coursetemplate/css/coursetemplate.css' }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/vnedutech-cms/default/vendors/iCheck/css/all.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/vnedutech-cms/default/vendors/awesomeBootstrapCheckbox/awesome-bootstrap-checkbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/vnedutech-cms/default/pages/css/radio_checkbox.css')}}">
<link href="{{asset('vendor/vnedutech-cms/default/vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" media="screen" />
<link href="{{asset('vendor/vnedutech-cms/default/pages/css/editor.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendor/vnedutech-cms/default/vendors/daterangepicker/css/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendor/vnedutech-cms/default/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/css/pages/tab.css' }}" />

<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/css/default.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/css/default.date.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/css/default.time.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/flatpickrCalendar/css/flatpickr.min.css' }}" rel="stylesheet" type="text/css" />
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/airDatepicker/css/datepicker.min.css' }}" rel="stylesheet" type="text/css" />

<style>
    .error {
        border-color: red !important;
    }
    .flatpickr-wrapper{
        z-index: 99999 !important;
    }
</style>
@stop
<!--end of page css-->


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('vne.course.manage') }}">
                <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                {{ trans('adtech-core::labels.home') }}
            </a>
        </li>
        <li class="active"><a href="#">{{ $title }}</a></li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            <form class="form-horizontal" action="{{route('vne.course.add')}}" method="post" id="form-add-course">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <fieldset>
                    <div class="col-md-6">
                        <div class="form-group" >
                            <label class="col-md-3 control-label" for="name">Ngày bắt đầu</label>
                            <div class="col-md-4">
                                <input id="date_start" name="date_start" type="text" class="form-control">                                
                            </div>
                            <div class="col-md-4">
                                <input class="form-control flatpickr" id='time_start' data-time_24hr=true name="time_start" data-enabletime=true data-nocalendar=true data-timeFormat="H:i">
                            </div>
                        </div>    

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Ngày kết thúc</label>
                            <div class="col-md-4">
                                <input id="date_end" name="date_end"  type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control flatpickr" id='time_end' name="time_end" data-time_24hr=true data-enabletime=true data-nocalendar=true data-timeFormat="H:i">
                            </div>
                        </div>                         
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Giới hạn học viên</label>
                            <div class="col-md-4">
                                <input id="student_limit" name="student_limit" type="number" min='0' class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Thời lượng khóa học</label>
                            <div class="col-md-4">
                                <input id="time" name="time" type="text" class="form-control">
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-6">                       
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                            <div class="col-md-8">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="1" class="square" checked/> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="0" class="square" /> Không                                    
                                </label>                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Giá</label>
                            <div class="col-md-8">
                                <input id="price" name="price" min='0' type="number" class="form-control">                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Giảm giá(%)</label>
                            <div class="col-md-8">
                                <input id="discount" name="discount" type="number" class="form-control">                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Ngày hết hạn</label>
                            <div class="col-md-8">
                                <input id="discount_exp" name="discount_exp" type="text" data-enabletime=true data-time_24hr=true data-timeFormat="H:i" class="form-control">                             
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label notify-template" for="message">Template khóa học</label>
                            <div class="col-md-8" id="div_template_title" style="display: none;">
                                <input type="text" class="form-control" name="course_template_title" id="course_template_title" disabled="true" >
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="course_template_id" value="" id="course_template_id">

                                <a class="btn btn-primary btn-show-template">Chọn</a>                             
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="load_list_date_lesson">
                        
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-responsive btn-success btn-sm btn-preview" style="font-size:16px;">Preview</a>
                        </div>
                    </div>
                </fieldset>

            </form>                
        </div>
    </div>
    <div class="modal" id="modalTemplate">
        <div class="modal-dialog" style="width: 800px;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chọn template khóa học</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" >
                    <div class="row">
                        <form class="form-horizontal" id="form-find-template">
                            <div class="form-group">
                                <label class="col-md-1 control-label" for="message">Lớp</label>
                                <div class="col-md-2">
                                    <select id="classes" name="classes" class="form-control">
                                        <option value="">Chọn</option>
                                        @if($classes)
                                        @foreach($classes as $class)
                                        <option value="{{$class['classes_id']}}">{{$class['name']}}</option>
                                        @endforeach
                                        @endif                                                                        
                                    </select>
                                </div>

                                <label class="col-md-1 control-label" for="message">Môn</label>
                                <div class="col-md-2">
                                    <select id="subject" name="subject" class="form-control">
                                        <option value="">Chọn</option>
                                        @if($subjects)
                                        @foreach($subjects as $subject)
                                        <option value="{{$subject['subject_id']}}">{{$subject['name']}}</option>
                                        @endforeach
                                        @endif    
                                    </select>
                                </div>

                                <label class="col-md-2 control-label" for="message">Giáo viên</label>
                                <div class="col-md-2">
                                    <select class="form-control" name="teacher" id="teacher">
                                        <option value="">Chọn</option>                                   
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-primary btn-find-template">Tìm</a>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ảnh</th>
                                    <th>Tên template</th>
                                    <th>Lớp</th>
                                    <th>Môn</th>
                                    <th>Giáo viên</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="reload_data">
                                @if(!empty($courseTemplates))
                                @foreach($courseTemplates as $i => $val)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td><img src='{{$val['template_avatar']}}' width="50px"></td>
                                    <td>{{$val['template_name']}}</td>
                                    <td>{{$val->isClass->name}}</td>
                                    <td>{{$val->isSubject->name}}</td>
                                    <td>{{$val->isTeacher->name}}</td>
                                    <td>
                                        <span class="label label-sm label-info btn-add-template" style="cursor: pointer;" template-id="{{$val['course_template_id']}}" template-name="{{$val['template_name']}}">Chọn</span>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col col-xs-12">
                            <ul class="pagination" id="reload_pagination">

                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-close-option-timer" data-dismiss="modal">Hủy</button>                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalPreview">
        <div class="modal-dialog" style="width: 1000px;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Preview thông tin khóa học</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="preview">                    
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-warning btn-save-to-template" data-type="saveToTemplate">Save to template</button>                    
                    <button type="button" class="btn btn-success btn-save" data-type="save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page js -->
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/js/bootstrap-switch.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}" type="text/javascript" ></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/config.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>

<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/js/picker.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/js/picker.date.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/js/picker.time.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/airDatepicker/js/datepicker.min.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/airDatepicker/js/datepicker.en.js' }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/flatpickrCalendar/js/flatpickr.min.js' }}"></script>

<!--end of page js-->
<script>
var domain = "/admin/laravel-filemanager/";
$('#lfm').filemanager('image', {prefix: domain});
$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%'
});

//$("#date_start").datetimepicker({format: 'YYYY-MM-DD HH:mm'});
//$("#date_end").datetimepicker({format: 'YYYY-MM-DD HH:mm'});
flatpickr("#discount_exp", { minDate: new Date(), dateFormat: 'Y-m-d' });

var check_in = flatpickr("#date_start", { minDate: new Date(), dateFormat: 'Y-m-d' });
var check_out = flatpickr("#date_end", { minDate: new Date(), dateFormat: 'Y-m-d' });

check_in.set("onChange", function(d) {
    check_out.set("minDate", d.fp_incr(1)); //increment by one day
     $('#form-add-course').bootstrapValidator('revalidateField', 'date_start');
});
check_out.set("onChange", function(d) {
    check_in.set("maxDate", d);
    $('#form-add-course').bootstrapValidator('revalidateField', 'date_end');
});

var calendars = flatpickr(".flatpickr");
flatpickr(".calendar");


$('body').on('click', '.btn-show-template', function () {
    $('#modalTemplate').modal('show');
});

$('body').on('click', '.btn-find-template', function () {
    let classes_id = $("#form-find-template #classes").val();    
    let subject_id = $("#form-find-template #subject").val();
    let teacher_id = $("#form-find-template #teacher").val();
    $.ajax({
        url: "/admin/vne/course/find-template",
        type: 'GET',
        cache: false,
        data: {
            classes_id: classes_id,
            subject_id: subject_id,
            teacher_id: teacher_id
        },
        success: function (response) {
            if (response.status == true) {
                $("#reload_data").html(response.html);
                $("#reload_pagination").html(response.paginate);
            } else {
                alert(response.msg);
            }
        }
    }, 'json');
});

$('body').on('change', '#form-find-template #subject, #form-find-template #classes', function () {
    let class_id = $("#form-find-template #classes").val();
    let subject_id = $("#form-find-template #subject").val();
    $.ajax({
        url: "/admin/vne/coursetemplate/find-teacher",
        type: 'GET',
        cache: false,
        data: {
            class_id: class_id,
            subject_id: subject_id
        },
        success: function (response) {
            if (response.status == true) {
                $("#teacher").html(response.html);
            } else {
                alert(response.msg);
            }
        }
    }, 'json');
});

$('body').on('click', 'a.paginate', function (e) {
    let url = $(this).attr('href');
    $.ajax({
        url: url,
        type: 'GET',
        cache: false,
        data: {},
        success: function (response) {
            if (response.status == true) {
                $("#reload_data").html(response.html);
                $("#reload_pagination").html(response.paginate);
            } else {
                alert(response.msg);
            }
        }
    }, 'json');
    e.preventDefault();
});

$('body').on('click', '.btn-add-template', function () {
    let template_id = $(this).attr('template-id');
    
    
    
    if(template_id && $('#date_start').val() && $('#date_end').val()){
        
        $("#course_template_id").val(template_id);
        $("#course_template_title").val($(this).attr('template-name'));
        $("#div_template_title").show();
        $('#modalTemplate').modal('hide');
        
        $.ajax({
            url: "/admin/vne/course/get-lesson-template",
            type: 'GET',
            cache: false,
            data: {
                template_id: template_id
            },
            success: function (response) {
                if (response.status == true) {
                    $("#load_list_date_lesson").html(response.html);
                    flatpickr(".lesson_date", { minDate: $('#date_start').val(), maxDate: $('#date_end').val() ,dateFormat: 'Y-m-d' });                                 
                    
                } else {
                    alert(response.msg);
                }
            }
        }, 'json');
    } else {
        alert('Bạn chưa nhập ngày bắt đầu hoặc ngày kết thúc khóa học');
    }
    
});

$('body').on('click', '.btn-preview', function () {
    
    if ($('#form-add-course').bootstrapValidator('validate').has('.has-error').length) {
        alert('Bạn chưa nhập đầy đủ thông tin khóa học');        
        return;
    }
    let template_couse_id = $("#course_template_id").val();
    if (!template_couse_id) {
        alert('Bạn chưa chọn khóa học');
        $('.notify-template').addClass('error');
    } else {
        $.ajax({
            url: '/admin/vne/course/preview-template',
            type: 'GET',
            cache: false,
            data: {template_couse_id: template_couse_id},
            success: function (response) {
                if (response.status == true) {
                    $("#preview").html(response.html);
                    $('#modalPreview').modal('show');
                    loadCourseDetail();
                    flatpickr(".preview_lesson_date_start", { minDate: $('#date_start').val(), maxDate: $('#date_end').val(), dateFormat: 'Y-m-d' });                                                            
                } else {
                    alert(response.msg);
                }
            }
        }, 'json');
    }
});



//click save khoa hoc
$('body').on('click', '.btn-save, .btn-save-to-template', function (e) {
    //validate template course
    let type = $(this).attr('data-type');
    let course = {};
    if ($("#template_name").val() === '' || $("#template_name").val() == null) {
        $("#template_name").addClass('error');
        alert('Tên khóa học không được để trống');
        return;
    } else {
        course.name = $("#template_name").val();
    }

    if ($("#thumbnail").val() === '' || $("#thumbnail").val() == null) {
        $("#thumbnail").addClass('error');
        alert('Bạn chưa chọn ảnh đại diện');
        return;
    } else {
        course.avartar = $("#thumbnail").val();
    }

    if ($("#form-add-review-course #teacher").val() === '' || $("#form-add-review-course #teacher").val() == null) {
        $("#form-add-review-course #teacher").addClass('error');
        alert($("#form-add-review-course #teacher").val());
        return;
    } else {
        course.teacher_id = $("#form-add-review-course #teacher").val();
    }

    if ($("#form-add-review-course #classes").val() === '' || $("#form-add-review-course #classes").val() == null) {
        $("#form-add-review-course #classes").addClass('error');
        alert('Bạn chưa chọn lớp - môn');
        return;
    } else {
        course.classes = $("#form-add-review-course #classes").val();
    }

    if ($("#date_start").val() === '' || $("#date_start").val() == null) {
        $("#date_start").addClass('error');
        alert('Bạn chưa nhập ngày bắt đầu');
        $('#modalPreview').modal('hide');
        return;
    } else {        
        course.date_start = $("#date_start").val();
    }

    if ($("#date_end").val() === '' || $("#date_end").val() == null) {
        $("#date_end").addClass('error');
        alert('Bạn chưa nhập ngày bắt kết thúc');
        $('#modalPreview').modal('hide');
        return;
    } else {
        course.date_end = $("#date_end").val();
    }

    if ($("#student_limit").val() === '' || $("#student_limit").val() == null) {
        $("#student_limit").addClass('error');
        alert('Bạn chưa nhập giới hạn học viên');
        $('#modalPreview').modal('hide');
        return;
    } else {
        course.student_limit = $("#student_limit").val();
    }

    if ($("#time").val() === '' || $("#time").val() == null) {
        $("#time").addClass('error');
        alert('Bạn chưa nhập thời lượng khóa học');
        $('#modalPreview').modal('hide');
        return;
    } else {
        course.time = $("#time").val();
    }

    if ($("#price").val() === '' || $("#price").val() == null) {
        $("#price").addClass('error');
        alert('Bạn chưa nhập giá khóa học');
        $('#modalPreview').modal('hide');
        return;
    } else {
        course.price = $("#price").val();
    }

    if ($("#course_template_id").val() === '' || $("#course_template_id").val() == null) {
        $("#course_template_id").addClass('error');
        alert('Không tìm thấy template khóa học');
        return;
    } else {
        course.course_template_id = $("#course_template_id").val();
    }

    course.discount = $("#discount").val();
    course.discount_exp = $("#discount_exp").val();

    course.video = $("#template_video_intro").val();
    course.summary = $("#summary").val();
    course.will_learn = $("#will_learn").val();
    course.target = $("#target").val();
    course.request_content = $("#request").val();
    course.active = $('input[name^="active"]:checked').val();
    course.is_hot = $('input[name^="ishot"]:checked').val();
    course.time_start = $('input[name^="time_start"]').val();
    course.time_end = $('input[name^="time_end"]').val();
    console.log(course);

    //validate lesson

    let lesson_name = [];
    let lesson_date_start = [];
    let lesson_content = [];
    let lesson_ordinal = [];
    let lesson_active = [];
    let lesson_template_id = [];
    let error_lesson = false;
    $('#preview input[name^="template_lesson_name"]').each(function (i, index) {
        if (!$(this).val()) {
            $(this).css('border-color', 'red');
            $("#tab_name_lesson_" + i).addClass('error');
            
            error_lesson = true;
        }
        lesson_name.push($(this).val());
    });

    $('#preview input[name^="lesson_date_start"]').each(function (i, index) {
        if (!$(this).val()) {
            $(this).css('border-color', 'red');
            $("#tab_name_lesson_" + i).addClass('error');
            
           error_lesson = true;
        }
        lesson_date_start.push($(this).val());
    });

    $('#preview textarea[name^="lesson_content"]').each(function (i, index) {
        if (!$(this).val()) {
            $(this).css('border-color', 'red');
            $("#tab_name_lesson_" + i).addClass('error');
            
            error_lesson = true;
        }
        lesson_content.push($(this).val());
    });

    $('#preview input[name^="lesson_active"]:checked').each(function (i, index) {
        if (!$(this).val()) {
            $(this).css('border-color', 'red');
            $("#tab_name_lesson_" + i).addClass('error');
           
            error_lesson = true;
        }
        lesson_active.push($(this).val());
    });

    $('#preview input[name^="lesson_ordinal"]').each(function (i, index) {
        if (!$(this).val()) {
            $(this).css('border-color', 'red');
            $("#tab_name_lesson_" + i).addClass('error');
           
            error_lesson = true;
        }
        lesson_ordinal.push($(this).val());
    });
    if (type == 'saveToTemplate') {
        $('#preview input[name^="template_lesson_id"]').each(function (i, index) {
            if (!$(this).val()) {
                $(this).css('border-color', 'red');
                $("#tab_name_lesson_" + i).addClass('error');
               
                error_lesson = true;
            }
            lesson_template_id.push($(this).val());
        });
    }
    if(error_lesson){
        alert('Vui lòng kiểm tra lại dữ liệu nhập vào');
    } else {
         let lesson = {
        lesson_name: lesson_name,
        lesson_date_start: lesson_date_start,
        lesson_active: lesson_active,
        lesson_content: lesson_content,
        lesson_ordinal: lesson_ordinal,
        lesson_template_id: lesson_template_id
    };

    console.log(lesson);

    if ($('#form-add-course').bootstrapValidator('validate').has('.has-error').length) {
        alert('Bạn chưa nhập đầy đủ thông tin khóa học');
        $('#modalPreview').modal('hide');
        return;
    } else {

        $.ajax({
            url: '/admin/vne/course/add',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
            },
            type: 'POST',
            cache: false,
            data: {
                lesson: lesson,
                course: course,
                type: type
            },
            success: function (response) {
                if (response.status == true) {
                    alert(response.msg);
                    window.location.href = response.redirect;
                } else {
                    alert(response.msg);
                }
            }
        }, 'json');
    }
    }
    

   


});

$('#form-add-course').bootstrapValidator({
    excluded: ':disabled',
    trigger: 'blur',
    fields: {
        student_limit: {
            validators: {
                notEmpty: {
                    message: 'Bạn chưa nhập giới hạn học viên'
                }
            }
        },
        time: {
            validators: {
                notEmpty: {
                    message: 'Bạn chưa nhập thời lượng khóa học'
                }
            }
        },
        price: {
            validators: {
                notEmpty: {
                    message: 'Bạn chưa nhập giá khóa học'
                }
            }
        },
        date_start: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: 'Chưa nhập ngày bắt đầu khóa học'
                },
                datetime: {
                    max: 'date_end'
                }
            }
        },
        date_end: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: 'Chưa nhập ngày kết thúc khóa học'
                },
                datetime: {
                    min: 'date_start'
                }
            }
        },

    }
});



function loadCourseDetail() {
    $("#preview_course_date_start").text($('#date_start').val() + ' ' + $('#time_start').val() );
    $("#preview_course_date_end").text($('#date_end').val() + ' ' + $('#time_end').val());
    $("#preview_course_student_limit").text($('#student_limit').val());
    $("#preview_course_time").text($('#time').val());
    $("#preview_course_price").text($('#price').val());
    $("#preview_course_disscount").text($('#discount').val());
    $("#preview_course_discount_exp").text($('#discount_exp').val());
    let active = $("input[name='active']:checked").val();
    let txt = 'Không';
    if (active == 1) {
        txt = 'Có';
    }
    $("#preview_course_acitve").text(txt);
    
    $('#preview input[name^="lesson_date_start"]').each(function (i, index) {
        let idLesson = $(this).attr('data-id');
             
        $(this).val($("#lesson_date_"+idLesson).val());
    });
}

var isDate = function (date) {
    return (new Date(date) !== "Invalid Date" && !isNaN(new Date(date))) ? true : false;
}

function toDate(dateStr) {
  var parts = dateStr.split("-")
  return new Date(parts[2], parts[1] - 1, parts[0])
}


</script>
@stop

