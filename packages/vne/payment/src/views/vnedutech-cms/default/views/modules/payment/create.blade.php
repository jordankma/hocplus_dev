@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Thêm phương thức thanh toán' }}@stop

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
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
@stop
<!--end of page css-->


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('vne.payment.manage') }}">
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
            <form class="form-horizontal" action="{{route('vne.payment.add')}}" method="post" id="form-add-payemnt">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <fieldset>
                    <!-- Name input-->
                    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Tên phương thức</label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" placeholder="Nhập tên..." class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Mã phương thức</label>
                            <div class="col-md-6">
                                <input id="code" name="code" type="text" placeholder="Nhập mã..." class="form-control">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Client ID</label>
                            <div class="col-md-6">
                                <input id="client_id" name="client_id" type="text" placeholder="Nhập client id..." class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Secret key</label>
                            <div class="col-md-6">
                                <input id="secret_key" name="secret_key" type="text" placeholder="Nhập secret_key..." class="form-control">
                            </div>
                        </div>                         -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Ảnh đại diện</label>
                            <div class="col-md-6 input-group" style="padding-left:15px;">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="img" style="width: 250px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name"></label>
                            <img id="holder" style="max-height:100px; margin-left: 15px;">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Ảnh hover</label>
                            <div class="col-md-6 input-group" style="padding-left:15px;">
                                <span class="input-group-btn">
                                    <a id="lfm2" data-input="img_hover" data-preview="preview_img_hover" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </a>
                                </span>
                                <input id="img_hover" class="form-control" type="text" name="img_hover" style="width: 250px;">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name"></label>
                            <img id="preview_img_hover" style="max-height:100px; margin-left: 15px;">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Kiểu</label>
                            <div class="col-md-6">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="type" value="cod" class="square method" checked/> Cod
                                </label>
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="type" value="card" class="square method" /> Thẻ
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="type" value="ebanking" class="square method" /> Ebanking                                    
                                </label>
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="type" value="transfer" class="square method" /> Chuyển khoản                                    
                                </label>
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="type" value="wallet" class="square method" /> Ví
                                </label>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                            <div class="col-md-6">
                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="status" value="1" class="square" checked/> Có
                                </label>

                                <label style="margin-right: 10px; cursor: pointer;">
                                    <input type="radio" name="status" value="0" class="square" /> Không                                    
                                </label>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Nội dung thông báo</label>
                            <div class="col-md-6">
                                <textarea rows="5" class="form-control resize_vertical" name="notifi" id="notify" placeholder="Nhập nội dung thông báo sau khi thanh toán thành công..."></textarea>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Thứ tự hiển thị</label>
                            <div class="col-md-3">
                                <input id="ordinal" name="ordinal" type="number" placeholder="Nhập thứ tự hiển thị..." class="form-control">
                            </div>
                        </div>
                                        
                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-responsive btn-primary btn-sm btn-save">Thêm mới</button>
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
<script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>

<!--end of page js-->
<script>
var domain = "/admin/laravel-filemanager/";
$('#lfm').filemanager('image', {prefix: domain});
$('#lfm2').filemanager('image', {prefix: domain});
$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%'
});

$('#form-add-payemnt').bootstrapValidator({
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        img: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        code: {            
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        type: {           
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        notifi: {           
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


</script>
@stop
