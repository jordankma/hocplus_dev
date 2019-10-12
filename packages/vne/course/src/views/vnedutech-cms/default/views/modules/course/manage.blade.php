@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = "Danh sách khóa học" }}@stop

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
    <div class="row">

        <div class="col-md-12">
            <!--lg-6 starts-->
            <!--basic form starts-->
            <div class="panel panel-primary">
                <div class="panel-body ">
                    <form name='search-form' id='search-form' class="form-horizontal" action="{{route('vne.course.manage')}}" method="get">
                        <input type='hidden' name='limit' id='limit' value="20">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">Khóa học</label>
                                <div class="col-md-4">
                                    <input id="name" name="name_course" value="{{ !empty(request()->name_course) ? request()->name_course : '' }}" type="text" placeholder="Tên khóa học" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">Giáo viên</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="teacher">
                                        <option value="">--Chọn--</option>
                                        @if(!empty($teachers))
                                            @foreach($teachers as $item)
                                                <option value="{{ $item['teacher_id'] }}" @if($item['teacher_id'] == request()->teacher) selected @endif> {{$item['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-4">
                                    <button type="submit" class="btn btn-success" id="search">Tìm</button>
                                </div>
                            </div>
                            <!-- Form actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            
            <div class="panel panel-primary panel-table">                
                <div class="panel-heading">
                    <div class="row">
                        
                        
                        <div class="col-md-12 text-right">
<!--                            @if ($USER_LOGGED->canAccess('vne.seminar.create'))-->
                            <a href="{{ route('vne.course.create') }}" class="btn btn-sm btn-warning btn-create">Thêm mới</a>                               
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
                                <th>Tên khóa học</th>
                                <th>Lớp</th>
                                <th>Môn</th>
                                <th>Giáo viên</th>                                                                           
                                <th>Start</th>
                                <th>End</th>
                                <th>Buổi học</th>
                                <th>Giá</th>
                                <th>Actions</th>                                
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($courses->items() as $key => $val)
                            <tr>
                                <td style="text-align: center;">{{ $key = $key + 1 }}</td>
                                <td>                                    
                                    <img src='{{config('site.url_static')}}{{$val->avartar}}' width="75px">                                 
                                </td>
                                <td>
                                    {{$val->name}} 
                                </td>
                                <td>                                    
                                    {{isset($val->isClass->name) ? $val->isClass->name : ''}}
                                </td>
                                <td>                                                                        
                                    {{isset($val->isSubject->name) ? $val->isSubject->name : ''}}
                                </td>
                                <td>                                    
                                    {{isset($val->isTeacher->name) ? $val->isTeacher->name : ''}}
                                </td>                                
                                <td>{{date('Y-m-d H:i', $val->date_start)}}</td>
                                <td>{{date('Y-m-d H:i', $val->date_end)}}</td>
                                <td>{{$val->number_lesson}}</td>
                                <td>{{number_format($val->price, 0, ',', '.')}} vnđ</td>    
                                <td>                                    
                                   @if ($USER_LOGGED->canAccess('vne.course.log'))                                                
                                   <a href='{{route('vne.course.log',['type' => 'hocplus_course', 'subject_id' => $val['course_id']])}}' data-toggle="modal" data-target="#log" title="Log">
                                           <span class="glyphicon glyphicon-info-sign pointer" style="font-size: 16px; color: #67C5DF;" ></span>
                                       </a>
                                    @endif
                                    
                                    @if ($USER_LOGGED->canAccess('vne.course.update'))
                                    <a href="{{ route('vne.course.update', ['course_id' => $val['course_id']]) }}" title="Sửa">
                                        <span class="glyphicon glyphicon-edit pointer" style="font-size: 16px; color: #F89A14;" ></span>
                                    </a>
                                    @endif                                   
                                    @if ($USER_LOGGED->canAccess('vne.course.delete'))
                                    <a href="{{ route('vne.course.delete', ['course_id' => $val['course_id']]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa?')"  title="Xóa" >
                                        <span class="glyphicon glyphicon-remove-circle  pointer" style="font-size: 16px; color: red;" ></span>
                                    </a>
                                    @endif
                                    <a href="{{route('vne.lesson.manage', ['course_id' => $val['course_id']])}}"  title="Tạo buổi học">
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
                               {{ $courses->links('VNE-COURSE::modules.course.pagination') }}                               
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
