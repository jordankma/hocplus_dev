@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Thống kê doanh thu' }}@stop

{{-- page styles --}}
@section('header_styles')
<link href="{{ asset('css/app2.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/blog.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/buttons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-tagsinput/css/app.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/intl-tel-input/css/intlTelInput.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/icon.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/vendor/' . $group_name . '/' . $skin . '/vendors/daterangepicker/css/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/form2.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/form3.css') }}" rel="stylesheet" type="text/css"/>    
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/style_question.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('/vendor/' . $group_name . '/' . $skin . '/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML"></script>
@stop
<!--end of page css-->

{{-- Page content --}}
@section('content')
<style type="text/css">
    .form-horizontal .control-label{
        margin-top: 5px !important;
        margin-bottom: 0;
        text-align: left !important;
    }
    .pd {
        padding: 20px;
        border: 5px solid black;
        box-sizing: border-box;
    }
    .mar-t5{
        margin-top:5px;
    }
    .wd {
        width: 300px
    }

    .pd-45 {
        padding: 45px;
    }

    .display-no {
        display: none;

    }
    .select2-container .select2-selection--single {
        height: 34px;
    }
    .icheckbox_line-red, .iradio_line-red{
        margin-bottom:4px;
    }
    .checkbox label, .radio label{
        padding-left:0px;
    }
</style>
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.homepage') }}">
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

        <div class="col-md-12">
            <!--lg-6 starts-->
            <!--basic form starts-->

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title">
                        Danh sách câu hỏi
                    </h3>                  
                </div>
                <div class="panel-body ">
                    <form class="form-horizontal" name='search-form' id='search-form' action="{{route('vne.statistical.search')}}" method="get">                            
                        <fieldset>
                            <div class='col-md-6'>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label">Lớp</label>
                                    <div class="col-md-8">
                                        <select id="class_id" class="form-control" name="class_id" >
                                            <option value="">--Chọn--</option>
                                            @if(!empty($classes))
                                                @foreach($classes as $item)
                                                    <option value="{{$item['classes_id']}}" @if($item['classes_id'] == request()->classes_id) selected @endif>{{$item['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                </div>                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Môn</label>
                                    <div class="col-md-8">
                                        <select id="subject_id" class="form-control" name="subject_id" >
                                            <option value="">--Chọn--</option>
                                            @if(!empty($subjects))
                                                @foreach($subjects as $item)
                                                    <option value="{{$item['subject_id']}}" @if($item['subject_id'] == request()->subject_id) selected @endif>{{$item['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Phương thức thanh toán</label>
                                        <div class="col-md-8">
                                            <select id="method" class="form-control" name="method">
                                                <option value="">--Chọn--</option>
                                                <option value="cod">COD</option>
                                                <option value="wallet">Ví</option>
                                                <option value="transfer">Chuyển khoản</option>
                                                <option value="ebanking">Thanh toán trực tuyến</option>
                                                <option value="card">Thẻ học plus</option>
                                            </select>
                                        </div>    
                                    </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Giáo viên</label>
                                    <div class="col-md-8">
                                        <select id="teachers" class="form-control" name="teacher_id">
                                            <option value="">--Chọn--</option>
                                            @if(!empty($teachers))
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher['teacher_id']}}" @if($teacher['teacher_id'] == request()->teacher_id) selected @endif>{{$teacher['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                </div>        
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="name">Thời gian</label>
                                    <div class="col-md-4">
                                        <input type="text" name='start' value="{{old('start', request()->start)}}" class="form-control" id="rangepicker1" />
                                    </div>
                                    <div class="col-md-4">                                          
                                        <input type="text" name='end' value="{{old('end', request()->end)}}" class="form-control" id="rangepicker2" />
                                    </div>
                                </div>  
                            </div>                               
                            <div class="col-md-12 col-md-offset-5">
                                <button type='submit' class="btn btn-success">Tìm</button>
                            </div>
                            <!-- Form actions -->
                        </fieldset>
                    </form>
                </div>  
            </div>

        </div>
    </div>

    <div class="row" id='reload-question'>
        <div class="col-md-12">
            <div class="panel panel-default panel-table">
                <form id="list-question" action="{{route('vne.statistical.search')}}" method="post">
                    <input type='hidden' name="_token" value="{!! csrf_token() !!}">
                    <div class="panel-heading">
                        <div class="row">
                            <div class=" col-md-5">
                                <h4>Tìm được : {{ !empty($data) ? count($data->toArray()['data']) : 0}} kết quả</h4>
                            </div>    
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-list" style='font-size: 12px;'>
                            <thead>
                                <tr>                                    
                                    <th class="center-align">STT</th>
                                    <th class="center-align">Khóa học</th>
                                    <th class="center-align">Phương thức</th>
                                    <th class="center-align">Giáo viên</th>
                                    <th class="center-align">Lớp</th>
                                    <th class="center-align">Môn</th>
                                    <th class="center-align">Số tiền</th>
                                    <th class="center-align">Ngày thanh toán</th>
                                </tr> 
                            </thead>
                            <tbody>
                                @if(!empty($data))
                                    @foreach($data->items() as $index => $val)
                                    <tr>
                                        <td class="">{{ $index + 1 }}</td>
                                        <td align="center">{{ @$val->isCourse->name }}</td>
                                        <td align="center">{{ $val->method }}</td>
                                        <td align="center">{{ @$val->isTeacher->name }}</td>
                                        <td align="center">{{ @$val->isClass->name }}</td>
                                        <td align="center">{{ @$val->isSubject->name }}</td>
                                        <td align="center">{{ number_format($val->money_payment, 0, '.,', '.') }}</td>
                                        <td align="center">{{ $val->created_at }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>    
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-xs-8">
                            @if(!empty($data))
                            {{ $data->links('VNE-STATISTICAL::modules.statistical.pagination') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
   
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page js -->
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/js/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/intl-tel-input/js/intlTelInput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/fancybox/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
<script src="{{asset('/vendor/' . $group_name . '/' . $skin . '/vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/vendor/' . $group_name . '/' . $skin . '/vendors/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('/vendor/' . $group_name . '/' . $skin . '/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/common/common.js') }}" type="text/javascript"></script>
<script src="http://www.wiris.net/demo/editor/editor"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-validator-master/dist/validator.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/list.js') }}" type="text/javascript"></script>

<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/html-docx-js/test/vendor/FileSaver.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/dhcd/question/html-docx-js/dist/html-docx.js') }}" type="text/javascript"></script>
<div class="modal fade" id="log" tabindex="-1" role="dialog" aria-labelledby="user_log_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
</div>
<script>
$(function () {
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
    $('body').on('change','.show-page-limit',function(){
        $("#search-form").submit();
    });
    $('body').on('change','.show-page-sort',function(){
        $("#search-form").submit();
    });
});
</script>
<script>
    $("#rangepicker1").datetimepicker({
       format: 'YYYY-MM-DD'
    });
    $("#rangepicker2").datetimepicker({
       format: 'YYYY-MM-DD'               
    });
    $('#teachers').multiselect({
        buttonWidth: '100%',
        nonSelectedText: 'Chọn giáo viên',
        enableFiltering: true,
    });    
</script>

@stop
