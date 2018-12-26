@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Cập nhật buổi học' }}@stop

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
            <a href="{{ route('vne.lesson.manage') }}">
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
            <form class="form-horizontal" action="{{route('vne.lesson.edit', ['lesson_id' => $lesson->lesson_id])}}" method="post" id="form-add-template-course">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="course_id" value="{{$lesson->course_id}}"/>
                <fieldset>
                    <!-- Name input-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="name">Tên buổi học</label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" value="{{old('name', !empty($lesson->name) ? $lesson->name : '' )}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-2 control-label" for="name">Ngày bắt đầu</label>
                            <div class="col-md-6">
                                <input  name="date_start" type="text" value="{{date('Y-m-d H:i', $lesson->date_start)}}" class="date_start form-control">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-2 control-label" for="name">Số thứ tự</label>
                            <div class="col-md-6">
                                <input  name="ordinal" type="text" value="{{$lesson->ordinal}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                            <div class="col-md-4">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="1" class="square"  @if($lesson->active == 1) checked @endif /> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active" value="0" class="square" @if($lesson->active == 0) checked @endif /> Không                                    
                                </label>                               
                            </div>
                        </div>
                                               
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message">Nội dung buổi học</label>
                            <div class="col-md-6">
                                <textarea class="form-control resize_vertical" id="content" name="content" rows="5">{!!$lesson->content!!}</textarea>
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

$('#form-add-template-course').bootstrapValidator({
    trigger: 'blur',
    feedbackIcons: {
        // validating: 'glyphicon glyphicon-refresh'
    },
    fields: {        
        date_start: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        
        content: {            
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        name: {            
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        ordinal: {            
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        }
    }
});

$('body').on('click', '.btn-show-template', function () {
    $('#modalTemplate').modal('show');
});
$(".date_start").datetimepicker({format: 'YYYY-MM-DD HH:mm'});  

$('.date_start')
    .on('dp.change dp.show', function(e) {
        // Revalidate the date when user change it
        $('#form-add-template-course').bootstrapValidator('revalidateField', 'date_start');
});

</script>
@stop
