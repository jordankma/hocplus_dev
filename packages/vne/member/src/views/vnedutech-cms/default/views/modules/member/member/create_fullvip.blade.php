@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Thêm mới tài khoản fullvip' }}@stop

{{-- page styles --}}
@section('header_styles')
    <link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/css/bootstrap-switch.css' }}" rel="stylesheet" type="text/css"/>
    <link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/css/pages/blog.css' }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
    <link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
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
            <div class="the-box no-border col-sm-4">
                <!-- errors -->
                <form action="{{ route('vne.member.member.add.fullvip') }}" method="POST" class="bf" id="form-add-member">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                
                <label>{{ trans('vne-member::language.label.member.email') }} <span style="color:red">*</span></label>
                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.email')}}">
                    </div>  
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                </div>
                <label>{{ trans('vne-member::language.label.member.password') }} <span style="color:red">*</span></label>
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.password')}}">
                    </div>  
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                </div>
                <label>{{ trans('vne-member::language.label.member.conf_password') }} <span style="color:red">*</span></label>
                <div class="form-group {{ $errors->first('conf_password', 'has-error') }}">
                    <div class="form-group">
                        <input type="password" name="conf_password" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.conf_password')}}">
                    </div>  
                    <span class="help-block">{{ $errors->first('conf_password', ':message') }}</span>
                </div>
                <div class="form-group">
                    <label for="blog_category" class="">Actions</label>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ trans('vne-member::language.buttons.create') }}</button>
                        <a href="{!! route('vne.member.member.create.fullvip') !!}"  class="btn btn-danger">{{ trans('vne-member::language.buttons.discard') }}</a>
                    </div>
                </div>
                <!-- /.tab-content -->
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
    <script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!--end of page js-->
    <script>
        $(function () {
            $("[name='permission_locked']").bootstrapSwitch();
        })
        $(document).ready(function () {
            $('#form-add-member').bootstrapValidator({
                feedbackIcons: {
                    // validating: 'glyphicon glyphicon-refresh',
                },
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Trường này không được bỏ trống'
                            },
                            emailAddress: {
                                message: 'Email không đúng định dạng'
                            },
                            remote: {
                                type: 'get',
                                message: 'Email đã tồn tại',
                                url: '{{route('vne.member.member.check-email-exist')}}',
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Trường này không được bỏ trống'
                            },
                            // regexp: {
                            //     regexp: "^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$",
                            //     message: 'Mật khẩu phải chứa 8 ký tự : chứa ít nhất 1 số, 1 chữ viết hoa, 1 chữ viết thường, 1 ký tự đặc biệt'
                            // }
                        }
                    },
                    conf_password: {
                        validators: {
                            notEmpty: {
                                message: 'Trường này không được bỏ trống'
                            },
                            identical: {
                                field: 'password',
                                message: 'Mật khẩu không khớp nhau'
                            }
                        }
                    }
                }
            }); 
        });
    </script>
@stop
