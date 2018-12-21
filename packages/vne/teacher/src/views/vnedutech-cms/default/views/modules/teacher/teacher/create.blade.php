@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = trans('vne-teacher::language.titles.teacher.create') }}@stop

{{-- page styles --}}
@section('header_styles')
    <link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/css/bootstrap-switch.css' }}" rel="stylesheet" type="text/css"/>
    <link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/css/pages/blog.css' }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
@stop
<!--end of page css-->


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
                <!-- errors -->
                <form action="{{ route('vne.teacher.teacher.add') }}" method="POST" class="bf" id="form-add-teacher">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="row">
                    <div class="col-sm-4">
                        <label>{{ trans('vne-teacher::language.label.teacher.name') }}</label>
                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.name')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.phone') }}</label>
                        <div class="form-group {{ $errors->first('phone', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.phone')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.email') }}</label>
                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.email')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.intro') }}</label>
                        <div class="form-group {{ $errors->first('intro', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="intro" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.intro')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('intro', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.year_graduation') }}</label>
                        <div class="form-group {{ $errors->first('year_graduation', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="year_graduation" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.year_graduation')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('year_graduation', ':message') }}</span>
                        </div>
                        <label>{{trans('vne-teacher::language.label.teacher.avatar')}}</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> {{trans('vne-teacher::language.label.teacher.choise_image')}}
                                    </a>
                                </span>
                                <input type="text" name="avatar" id="thumbnail1" class="form-control">
                            </div>
                            <img id="holder1" style="margin-top:15px;max-height:100px;">
                        </div>
                        <label>{{trans('vne-teacher::language.label.teacher.video_intro')}}</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm2" data-input="thumbnail2" data-preview="holder1" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> {{trans('vne-teacher::language.label.teacher.choise_video_intro')}}
                                    </a>
                                </span>
                                <input type="text" name="video_intro" id="thumbnail2" class="form-control">
                            </div>
                            <img id="holder1" style="margin-top:15px;max-height:100px;">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>{{ trans('vne-teacher::language.label.teacher.address') }}</label>
                        <div class="form-group {{ $errors->first('address', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="address" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.address')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.experience') }}</label>
                        <div class="form-group {{ $errors->first('experience', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="experience" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.experience')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('experience', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.facebook') }}</label>
                        <div class="form-group {{ $errors->first('facebook', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="facebook" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.facebook')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('facebook', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.workplace') }}</label>
                        <div class="form-group {{ $errors->first('workplace', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="workplace" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.workplace')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('workplace', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.achievements') }}</label>
                        <div class="form-group {{ $errors->first('achievements', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="achievements" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.achievements')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('achievements', ':message') }}</span>
                        </div>
                        <label>{{ trans('vne-teacher::language.label.teacher.degree') }}</label>
                        <div class="form-group {{ $errors->first('degree', 'has-error') }}">
                            <div class="form-group">
                                <input type="text" name="degree" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.degree')}}">
                            </div>  
                            <span class="help-block">{{ $errors->first('degree', ':message') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Chọn lớp môn học:</label>
                            <div class="col-md-12">
                                <select class="form-control" id="class_subject" name="class_subject[]" multiple="multiple">
                                    @if(!empty($list_class))
                                    @foreach($list_class as $key => $value)
                                        <optgroup label="{{ $value->name }}">
                                            @if(!empty($value->getSubject))
                                            @foreach($value->getSubject as $key2 => $value2)
                                                <option value="{{$value->classes_id . '-' . $value2->subject_id}}">{{ $value2->name }}</option>
                                            @endforeach
                                            @endif
                                        </optgroup>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-12">
                        <div class="form-group col-xs-12">
                            <label for="blog_category" class="">Actions</label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{ trans('vne-teacher::language.buttons.create') }}</button>
                                <a href="{!! route('vne.teacher.teacher.create') !!}"  class="btn btn-danger">{{ trans('vne-teacher::language.buttons.discard') }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                </div>
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
    <script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <!--end of page js-->
    <script>
        $(function () {
            $("[name='permission_locked']").bootstrapSwitch();
        })
        $(document).ready(function () {
            var domain = "/admin/laravel-filemanager/";
            $("#lfm1").filemanager('image', {prefix: domain});
            $("#lfm2").filemanager('file', {prefix: domain});

            $('#class_subject').multiselect({
                buttonWidth: '100%',
                nonSelectedText: 'Chọn lớp',
                enableFiltering: true,
            });
            $('#form-add-teacher').bootstrapValidator({
                feedbackIcons: {
                    // validating: 'glyphicon glyphicon-refresh',
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Trường này không được bỏ trống'
                            },
                            stringLength: {
                                max: 150,
                                message: 'Trường này không được quá dài'
                            }
                        }
                    },
                }
            }); 
        });
    </script>
@stop
