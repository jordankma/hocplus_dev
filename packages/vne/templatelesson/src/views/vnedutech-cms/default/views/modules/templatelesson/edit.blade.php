@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Tạo template khóa học' }}@stop

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
@stop
<!--end of page css-->


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('vne.templatelesson.manage') }}">
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
            <form class="form-horizontal" action="{{route('vne.templatelesson.edit', ['template_lesson_id' => $template->template_lesson_id])}}" method="post" id="form-add-template-course">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <fieldset>
                    <!-- Name input-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="name">Tên buổi học</label>
                            <div class="col-md-6">
                                <input id="template_name" name="template_lesson_name" type="text" value="{{old('template_lesson_name', !empty($template->name) ? $template->name : '' )}}" class="form-control">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                            <div class="col-md-4">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="1" class="square"  @if($template->active == 1) checked @endif /> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="0" class="square" @if($template->active == 0) checked @endif /> Không                                    
                                </label>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message">Template khóa học</label>
                            <div class="col-md-5" id="div_template_title">
                                <input type="text" class="form-control" name="course_template_title" value="{{$template->getCourseTemplate->template_name}}" id="course_template_title" disabled="true" >
                                <input type="hidden" name="course_template_id" value="{{$template->getCourseTemplate->course_template_id}}" id="course_template_id">  
                            </div>
                            <div class="col-md-1">
                                                              
                                <a class="btn btn-primary btn-show-template">Chọn</a>                             
                            </div>
                        </div>
                        
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message">Nội dung buổi học</label>
                            <div class="col-md-6">
                                <textarea class="form-control resize_vertical" id="content" name="content" rows="5">{!!$template->content!!}</textarea>
                            </div>
                        </div>                       
                        
                    </div>
                    
                    <hr class="col-md-12">
                    
                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-8 text-center">
                            <button type="submit" class="btn btn-responsive btn-primary btn-sm">Cập nhật</button>
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
                        <form class="form-horizontal">
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


<!--end of page js-->
<script>
var domain = "/admin/laravel-filemanager/";
$('#lfm').filemanager('image', {prefix: domain});
$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%'
});
$("#date_start").datetimepicker({format: 'YYYY-MM-DD HH:mm'});

$('#form-add-template-course').bootstrapValidator({
    trigger: 'blur',
    feedbackIcons: {
        // validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        template_lesson_name: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        course_template_title: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        date_start: {
            
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        
        content: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        }             
    }
});


$('body').on('change', '#subject, #classes', function () {
    let class_id = $("#classes").val();
    let subject_id = $("#subject").val();
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

$('body').on('click', '.btn-show-template', function () {
    $('#modalTemplate').modal('show');
});

$('body').on('click', '.btn-find-template', function(){
    let classes_id = $("#classes").val();
    let subject_id = $("#subject").val();
    let teacher_id = $("#teacher").val();
    $.ajax({
        url: "/admin/vne/course/find-template",
        type: 'GET',
        cache: false,
        data: {
            class_id: classes_id,
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

$('body').on('click', 'a.paginate', function(e){
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

$('body').on('click', '.btn-add-template', function(){
   $("#course_template_id").val($(this).attr('template-id')); 
   $("#course_template_title").val($(this).attr('template-name'));
   $("#div_template_title").show();
   $('#modalTemplate').modal('hide');
});
</script>
@stop
