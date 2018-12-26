@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = "Danh sách template buổi học" }}@stop

{{-- page styles --}}
@section('header_styles')
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/blog.css') }}" rel="stylesheet" type="text/css">
@stop
<!--end of page css-->
<style>
    .control-label{
        text-align: left !important;
    }
</style>

{{-- Page content --}}
@section('content')
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
        <div class="the-box no-border">
            
            <div class="panel panel-primary panel-table">                
                <div class="panel-heading">
                    <div class="row">
                        
                        
                        <div class="col-md-12 text-right">
<!--                            @if ($USER_LOGGED->canAccess('vne.seminar.create'))-->
                            <a href="{{ route('vne.lesson.create', ['course_id' => request()->get('course_id')]) }}" class="btn btn-sm btn-warning btn-create">Thêm mới</a>                               
<!--                            @endif-->
                        </div>                          
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">STT</th>
                                <th>Buổi học</th>
                                <th>Khóa học</th>
                                <th>Ngày bắt đầu</th>
                                <th>Số thứ tự</th>
                                <th>Hiển thị</th>                                                                                       
                                <th>Actions</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($lessons->items() as $key => $val)
                            <tr>
                                <td style="text-align: center;">{{ $key = $key + 1 }}</td>
                               
                                <td>
                                    {{$val['name']}} 
                                </td>
                                <td>
                                    {{$val->getCourse->name}} 
                                </td>
                                <td>
                                    {{date('Y-m-d H:i', $val->date_start)}} 
                                </td>
                                <td>
                                    {{$val->ordinal}} 
                                </td>
                                <td>{!!$val['active'] == 1 ? '<span class="label label-sm label-success">Có</span>' : '<span class="label label-sm label-danger">Không</span>'!!}</td>                                
                               
                                <td>                                    
                                   @if ($USER_LOGGED->canAccess('vne.lesson.log'))                                                
                                       <a href='{{route('vne.lesson.log',['type' => 'hocplus_lesson', 'subject_id' => $val['lesson_id']])}}' data-toggle="modal" data-target="#log"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#F99928" data-hc="#F99928" title="log contest"></i></a>
                                    @endif
                                    
                                    @if ($USER_LOGGED->canAccess('vne.lesson.update'))
                                    <a href="{{ route('vne.lesson.update', ['lesson_id' => $val['lesson_id']]) }}"><span class="glyphicon glyphicon-edit del-lesson  text-16 pointer" style="color:#000;" aria-hidden="true"></span></a>
                                    @endif                                   
                                    @if ($USER_LOGGED->canAccess('vne.lesson.delete'))
                                    <a href="{{ route('vne.lesson.delete', ['lesson_id' => $val['lesson_id']]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa?')"  class="" >
                                        <span class="glyphicon glyphicon-remove-circle del-lesson text-error text-16 pointer" aria-hidden="true"></span>
                                    </a>
                                    @endif
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-xs-12">
                            <ul class="pagination">
                               {{ $lessons->links('VNE-COURSE::modules.course.lesson.pagination') }}                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<div class="modal fade" id="log" tabindex="-1" role="dialog" aria-labelledby="user_log_title"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<!-- begining of page js -->
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/js/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<!--end of page js-->
<script>
$(function () {
    $("[name='permission_locked']").bootstrapSwitch();
})
</script>
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

@stop

