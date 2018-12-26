@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = "Danh sách template khóa học" }}@stop

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
                            <a href="{{ route('vne.coursetemplate.create') }}" class="btn btn-sm btn-warning btn-create">Thêm mới</a>                               
<!--                            @endif-->
                        </div>                          
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">STT</th>
                                <th>Ảnh</th>
                                <th>Tên Template</th>
                                <th>Lớp</th>
                                <th>Môn</th>
                                <th>Giáo viên</th>                                                                           
                                <th>Nổi bật</th>                                
                                <th>Actions</th>                                
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($courseTemplates->items() as $key => $val)
                            <tr>
                                <td style="text-align: center;">{{ $key = $key + 1 }}</td>
                                <td>                                    
                                    <img src='{{$val['template_avatar']}}' width="75px">                                 
                                </td>
                                <td>
                                    {{$val['template_name']}} 
                                </td>
                                <td>
                                    {{$val->isClass->name}} 
                                </td>
                                <td>
                                    {{$val->isSubject->name}} 
                                </td>
                                <td>
                                    {{$val->isTeacher->name}}
                                </td>                                
                                <td>{!!$val['is_hot'] == 1 ? '<span class="label label-sm label-success">Có</span>' : '<span class="label label-sm label-danger">Không</span>'!!}</td>                                
                                <td>
                                    
                                   @if ($USER_LOGGED->canAccess('vne.coursetemplate.log'))                                                
                                   <a href='{{route('vne.coursetemplate.log',['type' => 'hocplus_course_templates', 'subject_id' => $val['course_template_id']])}}' title="Log" data-toggle="modal" data-target="#log">
                                           <span class="glyphicon glyphicon-info-sign pointer" style="font-size: 16px; color: #67C5DF;" ></span>
                                       </a>
                                    @endif
                                    
                                    @if ($USER_LOGGED->canAccess('vne.coursetemplate.update'))
                                    <a href="{{ route('vne.coursetemplate.update', ['course_template_id' => $val['course_template_id']]) }}" title="Sửa">
                                            <span class="glyphicon glyphicon-edit pointer" style="font-size: 16px; color: #F89A14;" ></span>
                                        </a>                                    
                                    @endif                                   
                                    @if ($USER_LOGGED->canAccess('vne.coursetemplate.delete'))
                                    <a href="{{ route('vne.coursetemplate.delete', ['course_template_id' => $val['course_template_id']]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa?')"  title="Xóa">
                                        <span class="glyphicon glyphicon-remove-circle  pointer" style="font-size: 16px; color: red;" ></span>
                                    </a>
                                    @endif
                                    <a href="{{route('vne.templatelesson.manage', ['course_template_id' => $val['course_template_id']])}}"  title="Tạo buổi học">
                                        <span class="glyphicon glyphicon-plus-sign  pointer" style="font-size: 16px; color: #418BCA;" ></span>
                                    </a>
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
                               {{ $courseTemplates->links('VNE-COURSETEMPLATE::modules.coursetemplate.pagination') }}                               
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
