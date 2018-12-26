@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Sửa khóa học' }}@stop

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
@stop
<!--end of page css-->


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('vne.coursetemplate.manage') }}">
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
            <form class="form-horizontal" action="{{route('vne.course.edit', ['course_id' => $course->course_id])}}" method="post" id="form-add-template-course">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <fieldset>
                    <!-- Name input-->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Tên khóa học</label>
                            <div class="col-md-8">
                                <input id="name" name="name" type="text" value="{{old('name', isset($course) ? $course->name : '')}}" class="form-control"></div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label" for="name">Ngày bắt đầu</label>
                            <div class="col-md-8">
                                <input id="date_start" name="date_start" type="text" value="{{date('Y-m-d H:i', $course->date_start)}}" class="type_date form-control">
                            </div>
                        </div>    

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Ngày kết thúc</label>
                            <div class="col-md-8">
                                <input id="date_end" name="date_end" value="{{date('Y-m-d H:i', $course->date_end)}}" type="text" class="type_date form-control">
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Ảnh đại diện</label>
                            <div class="col-md-8 input-group" style="padding-left:15px;">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="avartar" value="{{old('avartar', isset($course) ? $course->avartar : '')}}" style="width: 250px;">
                            </div>
                        </div>
                        <div class="form-group" style="display: flex;">
                            <label class="col-md-3 control-label" for="name"></label>
                            <img id="holder" src="{{$course->avartar}}" style="margin-top:15px;max-height:100px; margin-left: 15px; display: block;">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Video giới thiệu</label>
                            <div class="col-md-8">
                                <input id="template_video_intro" name="video" type="text" value="{{old('video', isset($course) ? $course->video : '')}}" class="form-control"></div>
                        </div>
                        @if($course->video)
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name"></label>
                            <div class="col-md-8">
                                <iframe width="auto" height="auto" src="{{$course->video}}" style="border: none;"></iframe>                    
                            </div>
                        </div>
                        @endif

                    </div>
                    <div class="col-md-4">
                        <!-- Message body -->                                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Giáo viên</label>
                            <div class="col-md-8">
                                <select class="form-control" name="teacher" id="teacher">
                                    <option value="">Chọn</option>
                                    @if(!empty($teachers))                                       
                                        @foreach($teachers as $teacher)
                                            <option value="{{$teacher['teacher_id']}}" @if($teacher['teacher_id'] == $course->teacher_id) selected @endif>{{$teacher['name']}}</option>
                                        @endforeach                                        
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Lớp</label>
                            <div class="col-md-8" id='select_class_subject'>
                               <select id="classes" name="classes" class="form-control"  >                                                                       
                                    @if(!empty($data))
                                        @foreach($data as $c => $class)
                                            <optgroup label="{{ $class['name'] }}">
                                                @if(!empty($class['subject']))
                                                    @foreach($class['subject'] as $s => $subject)
                                                        <option value="{{$c . '-' . $s}}" @if($c == $course->classes_id  && $s == $course->subject_id) selected @endif>{{ $subject['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    @endif                                                                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Nổi bật</label>
                            <div class="col-md-8">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="is_hot" value="1" class="square" @if($course->is_hot == 1) checked @endif /> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="is_hot" value="0" class="square" @if($course->is_hot == 0) checked @endif /> Không                                    
                                </label>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                            <div class="col-md-8">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="1" class="square" @if($course->active == 1) checked @endif /> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="0" class="square" @if($course->active == 0) checked @endif /> Không                                    
                                </label>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Giới hạn hv</label>
                            <div class="col-md-8">
                                <input id="student_limit" name="student_limit" value="{{$course->student_limit}}" type="number" min='0' class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Thời lượng </label>
                            <div class="col-md-8">
                                <input id="time" name="time" type="text" value="{{$course->time}}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Giá</label>
                            <div class="col-md-8">
                                <input id="price" name="price" min='0' type="number" value="{{$course->price}}" class="form-control">                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Giảm giá(%)</label>
                            <div class="col-md-8">
                                <input id="discount" name="discount" value="{{$course->discount}}" type="number" class="form-control">                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Ngày hết hạn</label>
                            <div class="col-md-8">
                                <input id="discount_exp" name="discount_exp" value="{{date('Y-m-d H:s', $course->discount_exp)}}" type="text" class="form-control">                             
                            </div>
                        </div>
                        
                    </div>
                    <hr class="col-md-12">                                                                               
                    <div class="col-md-12">
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Mô tả</label>
                            <div class="col-md-9">
                                <textarea class="form-control resize_vertical" id="summary" name="summary" placeholder="Nhập mô tả khóa học..." rows="5">
                                    {{old('summary', isset($course) ? $course->summary : '')}}
                                </textarea>
                            </div>
                        </div>
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Nội dung khóa học</label>
                            <div class="col-md-9">
                                <textarea class="form-control resize_vertical" id="will_learn" name="will_learn" placeholder="Nhập nội dung khóa học..." rows="5">
                                    {{old('will_learn', isset($course) ? $course->will_learn : '')}}
                                </textarea>
                            </div>
                        </div>
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Mục tiêu khóa học</label>
                            <div class="col-md-9">
                                <textarea class="form-control resize_vertical" id="target" name="target" placeholder="Nhập mục tiêu khóa học..." rows="5">
                                    {{old('target', isset($course) ? $course->target : '')}}
                                </textarea>
                            </div>
                        </div>
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Yêu cầu khóa học</label>
                            <div class="col-md-9">
                                <textarea class="form-control resize_vertical" id="request" name="request_content" placeholder="Nhập yêu cầu khóa học..." rows="5">
                                    {{old('request_content', isset($course) ? $course->request_content : '')}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-responsive btn-primary ">Cập nhật</button>
                        </div>
                    </div>
                </fieldset>
            </form>                
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

<!--end of page js-->
<script>
var domain = "/admin/laravel-filemanager/";
$('#lfm').filemanager('image', {prefix: domain});
$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%'
});
$('textarea#summary').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]

});
$('textarea#will_learn').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]

});
$('textarea#target').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]

});
$('textarea#request').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]
});

$('#form-add-template-course').bootstrapValidator({
    feedbackIcons: {
        // validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        price: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        student_limit: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        time: {
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
                },
                datetime: {
                    max: 'date_end'
                }
            }
        },
        date_end: {
            validators: {
                notEmpty: {
                    message: ' '
                },
                datetime: {
                    min: 'date_start'
                }
            }
        },
        avartar: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        'classes[]': {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        
        teacher: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
    }
}).on('status.field.bv', function (e, data) {
    data.bv.disableSubmitButtons(false);
});

$('#classes').multiselect({
    buttonWidth: '100%',
    nonSelectedText: 'Chọn lớp',
    enableFiltering: true,
});

$(".type_date").datetimepicker({format: 'YYYY-MM-DD HH:mm'});

$('body').on('change', '#teacher', function () {
    let teacher_id = $(this).val();
    $.ajax({
        url: "/admin/vne/coursetemplate/find-class-subject",
        type: 'GET',
        cache: false,
        data: {
            teacher_id: teacher_id,
            type: 'edit'
        },
        success: function (response) {
            if (response.status == true) {
                $("#select_class_subject").html(response.html);
                $('#classes').multiselect({
                    buttonWidth: '100%',
                    nonSelectedText: 'Chọn lớp',
                    enableFiltering: true,
                });
                
            } else {
                alert(response.msg);
            }
        }
    }, 'json');
});

$('body').on('click', '.btn-save', function(e){    
    let class_subject = $("#classes").val();    
    if(class_subject == null || class_subject == ''){
        alert("Bạn chưa chọn lớp");
        e.preventDefault();
    }        
});

</script>
@stop
