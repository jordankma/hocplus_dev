@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Thêm thông tin chi tiết phương thức thanh toán' }}@stop

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

@php
    $detail = !empty($payment->detail) ? json_decode($payment->detail, true) : [];
    
@endphp

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
            <form class="form-horizontal" action="{{route('vne.payment.addDetail', ['payment_id' => $payment->payment_id])}}" method="post" id="form-add-payemnt">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="payment_type" value="{{$payment->type}}">
                <fieldset>
                    <!-- Name input-->
                        @if($payment->type == 'card')
                        <div id="card">
                            @if(!empty($detail))
                                @if(!empty($detail['info']))
                                    @foreach($detail['info'] as $i => $info)
                                    <div class="item">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Loại thẻ</label>                                 
                                            <div class="col-md-2">
                                                <select name="card_type[{{$i}}]" class="form-control">
                                                    <option value="">Chọn</option>
                                                    <option value="hocplus" {{ $info['card_type'] == 'hocplus' ? 'selected' : '' }} >Học plus</option>
                                                    <option value="vtel" {{ $info['card_type'] == 'vtel' ? 'selected' : '' }}>Viettel</option>
                                                    <option value="mobi" {{ $info['card_type'] == 'mobi' ? 'selected' : '' }}>Mobifone</option>
                                                    <option value="vina" {{ $info['card_type'] == 'vina' ? 'selected' : '' }}>Vinafone</option>
                                                </select>
                                            </div>
                                            @if($i > 0)
                                            <div class="col-md-2">
                                                <button class="btn btn-danger remove-item">Xóa</button>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Ảnh thẻ cào</label>
                                            <div class="col-md-6 input-group" style="padding-left:15px;">
                                                <span class="input-group-btn">
                                                    <a data-input="thumbnail_{{$i}}" data-preview="holder_{{$i}}" class="lfm btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                                    </a>
                                                </span>
                                                <input id="thumbnail_{{$i}}" class="form-control" value="{{$info['img']}}" type="text" name="img[{{$i}}]" style="width: 250px;">                                        
                                            </div>                                   
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name"></label>
                                            <img id="holder_{{$i}}" src="{{asset($info['img'])}}" style="max-height:100px; margin-left: 15px; display:block;">
                                        </div>   
                                    </div>
                                    @endforeach
                                @endif
                            @else
                            <div class="item">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">Loại thẻ</label>                                 
                                    <div class="col-md-2">
                                        <select name="card_type[0]" class="form-control">
                                            <option value="">Chọn</option>
                                            <option value="hocplus">Học plus</option>
                                            <option value="vtel">Viettel</option>
                                            <option value="mobi">Mobifone</option>
                                            <option value="vina">Vinafone</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">Ảnh thẻ cào</label>
                                    <div class="col-md-6 input-group" style="padding-left:15px;">
                                        <span class="input-group-btn">
                                            <a data-input="thumbnail_0" data-preview="holder_0" class="lfm btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh
                                            </a>
                                        </span>
                                        <input id="thumbnail_0" class="form-control" type="text" name="img[0]" style="width: 250px;">                                        
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name"></label>
                                    <img id="holder_0" style="max-height:100px; margin-left: 15px;">
                                </div>   
                            </div>
                            @endif
                            
                        </div>
                        @elseif($payment->type == 'transfer') 
                        <div id="tranfer">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Nội dung</label>
                                <div class="col-md-6">
                                    <textarea rows="5" class="form-control resize_vertical" name="transfer_content" id="transfer_content" placeholder="Nhập nội dung...">{{!empty($detail['content']) ? $detail['content'] : '' }}</textarea>                               
                                </div>
                            </div>
                            @if(!empty($detail))                                
                                @if(!empty($detail['info']))
                                    @foreach($detail['info'] as $i => $info)
                                
                                    <div class="item">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Tên ngân hàng</label>
                                            <div class="col-md-6">
                                                <input id="name" name="name[{{$i}}]" type="text" value="{{$info['name']}}" placeholder="Nhập tên..." class="form-control">
                                            </div>
                                            @if($i > 0)
                                            <div class="col-md-2">
                                                <button class="btn btn-danger remove-item">Xóa</button>
                                            </div>
                                            @endif                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Số tài khoản</label>
                                            <div class="col-md-6">
                                                <input id="name" name="account[{{$i}}]" type="text" value="{{$info['account']}}" placeholder="Nhập số tài khoản..." class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Ảnh ngân hàng</label>
                                            <div class="col-md-6 input-group" style="padding-left:15px;">
                                                <span class="input-group-btn">
                                                    <a data-input="thumbnail_{{$i}}" data-preview="holder_{{$i}}" class="lfm btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                                    </a>
                                                </span>
                                                <input id="thumbnail_{{$i}}" class="form-control" value="{{$info['img']}}" type="text" name="img[{{$i}}]" style="width: 250px;">                                        
                                            </div>                                   
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name"></label>
                                            <img id="holder_{{$i}}" src="{{asset($info['img'])}}" style="max-height:100px; margin-left: 15px; display:block;">
                                        </div> 
                                    </div>
                                    @endforeach                               
                                @endif
                            @else                                
                                <div class="item">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="name">Tên ngân hàng</label>
                                        <div class="col-md-6">
                                            <input id="name" name="name[0]" type="text" placeholder="Nhập tên..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="name">Số tài khoản</label>
                                        <div class="col-md-6">
                                            <input id="name" name="account[0]" type="text" placeholder="Nhập số tài khoản..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="name">Ảnh ngân hàng</label>
                                        <div class="col-md-6 input-group" style="padding-left:15px;">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail_0" data-preview="holder_0" class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Chọn ảnh
                                                </a>
                                            </span>
                                            <input id="thumbnail_0" class="form-control" type="text" name="img[0]" style="width: 250px;">                                        
                                        </div>                                   
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="name"></label>
                                        <img id="holder_0" style="max-height:100px; margin-left: 15px;">
                                    </div> 
                                </div>
                            @endif
                            
                        </div>  
                        @else
                        <div id="ebanking">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Nội dung</label>
                                <div class="col-md-6">
                                    <textarea rows="5" class="form-control resize_vertical" name="ebanking_content" id="ebanking_content" placeholder="Nhập nội dung...">{{!empty($detail['content']) ? $detail['content'] : '' }}</textarea>                               
                                </div>
                            </div>
                        </div> 
                        @endif
                                                                                        
                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            @if($payment->type != 'ebanking')<button type="button" class="btn btn-responsive btn-primary btn-sm btn-add">Thêm thẻ mới</button> @endif
                            <button type="submit" class="btn btn-responsive btn-success btn-sm btn-save">Lưu thông tin</button>
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
$('.lfm').filemanager('image', {prefix: domain});

const method = '{{$payment->type}}';
$('body').on('click', '.btn-add', function(){
    let numItems = $('.item').length;
    let html = '';
    if(method === 'card'){
        html += ` <div class="item">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Loại thẻ</label>                                 
                        <div class="col-md-2">
                            <select name="card_type[${numItems}]" class="form-control">
                                <option value="">Chọn</option>
                                <option value="hocplus">Học plus</option>
                                <option value="vtel">Viettel</option>
                                <option value="mobi">Mobifone</option>
                                <option value="vina">Vinafone</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger remove-item">Xóa</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Ảnh thẻ cào</label>
                        <div class="col-md-6 input-group" style="padding-left:15px;">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail_${numItems}" data-preview="holder_${numItems}" class="lfm btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Chọn ảnh
                                </a>
                            </span>
                            <input id="thumbnail_${numItems}" class="form-control" type="text" name="img[${numItems}]" style="width: 250px;">                                        
                        </div>                                   
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name"></label>
                        <img id="holder_${numItems}" style="max-height:100px; margin-left: 15px;">
                    </div>`;
    
    
    
        $("#card").append(html);
    }

    if(method === 'transfer'){
        html += `<div class="item">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Tên ngân hàng</label>
                        <div class="col-md-6">
                            <input id="name" name="name[${numItems}]" type="text" placeholder="Nhập tên..." class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger remove-item">Xóa</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Số tài khoản</label>
                        <div class="col-md-6">
                            <input id="name" name="account[${numItems}]" type="text" placeholder="Nhập số tài khoản..." class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Ảnh ngân hàng</label>
                        <div class="col-md-6 input-group" style="padding-left:15px;">
                            <span class="input-group-btn">
                                <a data-input="thumbnail_${numItems}" data-preview="holder_${numItems}" class="lfm btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Chọn ảnh
                                </a>
                            </span>
                            <input id="thumbnail_${numItems}" class="form-control" type="text" name="img[${numItems}]" style="width: 250px;">                                        
                        </div>                                   
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name"></label>
                        <img id="holder_${numItems}" style="max-height:100px; margin-left: 15px;">
                    </div> 
                </div>`;
        $("#tranfer").append(html);        
    }
        
    $('.lfm').filemanager('image', {prefix: domain});                        
});

$('body').on('click', '.remove-item', function(){
    $(this).parent().parent().parent().remove();
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

