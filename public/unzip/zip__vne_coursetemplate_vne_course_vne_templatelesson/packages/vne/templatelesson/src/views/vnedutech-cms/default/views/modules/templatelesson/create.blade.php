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
            <form class="form-horizontal" action="{{route('vne.templatelesson.add')}}" method="post" id="form-add-template-course">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="course_template_id" value="{{request()->get('course_template_id')}}" >
                <fieldset >
                    <div id="load_content_lesson">
                        <div class="col-md-12 lesson_item">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="name">Tên buổi học</label>
                            <div class="col-md-6">
                                <input id="template_name" name="template_lesson_name[1]" type="text" placeholder="Nhập tên buổi học..." class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                            <div class="col-md-4">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active[1]" value="1" class="square" checked/> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="active[1]" value="0" class="square" /> Không                                    
                                </label>                               
                            </div>
                        </div>


                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="message">Nội dung buổi học</label>
                            <div class="col-md-6">
                                <textarea class="form-control resize_vertical" id="content" name="content[1]" placeholder="Nhập nội dung buổi học..." rows="5"></textarea>
                            </div>
                        </div>                       

                    </div>

                    <hr class="col-md-12">
                    </div>
                                      
                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-8 text-center">
                            <a class="btn btn-primary add-lesson">Thêm buổi học mới</a>
                            <button type="submit" class="btn btn-responsive btn-success btn-save-lesson">Save</button>
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
<script type="text/javascript">
var domain = "/admin/laravel-filemanager/";
$('#lfm').filemanager('image', {prefix: domain});
$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%'
});

$('body').on('click', '.add-lesson', function () {

    let lesson_item = $('.lesson_item').length;
    let html = `<div class="col-md-12 lesson_item">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Tên buổi học</label>
                        <div class="col-md-6">
                            <input id="template_name" name="template_lesson_name[${lesson_item + 1}]" type="text" placeholder="Nhập tên buổi học..." class="form-control">
                        </div>
                        <div class="col-md-2"><a class="btn btn-danger remove-lesson-item">Xóa</a></div>        
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                        <div class="col-md-4">
                            <label style="margin-right: 10px; cursor: pointer;">
                                <input type="radio" name="active[${lesson_item + 1}]" value="1" class="square" checked/> Có
                            </label>

                            <label style="margin-right: 10px; cursor: pointer;">
                                <input type="radio" name="active[${lesson_item + 1}]" value="0" class="square" /> Không                                    
                            </label>                               
                        </div>
                    </div>


                    <!-- Message body -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="message">Nội dung buổi học</label>
                        <div class="col-md-6">
                            <textarea class="form-control resize_vertical" id="content" name="content[${lesson_item + 1}]" placeholder="Nhập nội dung buổi học..." rows="5"></textarea>
                        </div>
                    </div>                       
                <hr class="col-md-12">                
                </div>`;
    $('#load_content_lesson').append(html);
    $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '20%'
    });
});

$('body').on('click', '.remove-lesson-item', function(){
    $(this).parent().parent().parent().remove();
});

$('body').on('click', '.btn-save-lesson', function(e){
    let error = false;
    $('input[name^="template_lesson_name"]').each(function() {
        if(!$(this).val()){
             error = true;
             $(this).css('border-color','red');
        }         
    });
    
    $('textarea[name^="content"]').each(function() {
        if(!$(this).val()){
             error = true;
             $(this).css('border-color','red');
        }         
    });
    
    if(error){
        alert('Vui lòng nhập đầy đủ thông tin');
        e.preventDefault();
    } 
            
});

</script>
@stop
