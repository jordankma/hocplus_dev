@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = trans('vne-member::language.titles.member.create') }}@stop

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
            <div class="the-box no-border">
                <!-- errors -->
                <form action="{{ route('vne.member.member.add') }}" method="POST" class="bf" id="form-add-member">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <ul class="nav nav-tabs">
                    <li class=" nav-item active">
                        <a href="#info-required" data-toggle="tab" class="nav-link">Thông tin chính</a>
                    </li>
                    <li class="nav-item">
                        <a href="#info" data-toggle="tab" class="nav-link">Thông tin thêm</a>
                    </li>
                </ul>
                <div class="tab-content" id="slim1" style="margin-top: 20px">
                    <div class="tab-pane active" id="info-required">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>{{ trans('vne-member::language.label.member.name') }} <span style="color:red">*</span></label>
                                <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.name')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-member::language.label.member.gender') }}</label>
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" checked>Nam</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female">Nữ</label>
                                </div>
                                <label>{{ trans('vne-member::language.label.member.user_name') }} <span style="color:red">*</span></label>
                                <div class="form-group {{ $errors->first('user_name', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="user_name" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.user_name')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('user_name', ':message') }}</span>
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
                            </div>
                            <div class="col-sm-6">
                                <label>{{ trans('vne-member::language.label.member.phone') }} <span style="color:red">*</span></label>
                                <div class="form-group {{ $errors->first('phone', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.phone')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-member::language.label.member.email') }} <span style="color:red">*</span></label>
                                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.email')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-member::language.label.member.type') }}</label>
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="type" value="student" checked>Học sinh</label>
                                    <label class="radio-inline"><input type="radio" name="type" value="parent">Phụ huynh</label>
                                    {{-- <label class="radio-inline"><input type="radio" name="type" value="teacher">Giáo viên</label> --}}
                                </div>
                                <label>{{trans('vne-member::language.label.member.avatar')}}</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> {{trans('vne-member::language.label.member.choise_avatar')}}
                                            </a>
                                        </span>
                                        <input type="text" name="avatar" id="thumbnail1" class="form-control">
                                    </div>
                                    <img id="holder1" style="margin-top:15px;max-height:100px;">
                                </div>   
                            </div>
                            <!-- /.col-sm-8 -->
                            <div class="col-sm-12">
                                <div class="form-group col-xs-12">
                                    <label for="blog_category" class="">Actions</label>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">{{ trans('vne-member::language.buttons.create') }}</button>
                                        <a href="{!! route('vne.member.member.create') !!}"  class="btn btn-danger">{{ trans('vne-member::language.buttons.discard') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="info">  
                        <div class="row">
                            <div class="col-sm-6">
                                <label>{{ trans('vne-member::language.label.member.facebook') }}</label>
                                <div class="form-group {{ $errors->first('facebook', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="facebook" class="form-control" placeholder="{{trans('vne-member::language.placeholder.member.facebook')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('facebook', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-member::language.label.member.intro') }}</label>
                                <div class="form-group {{ $errors->first('intro', 'has-error') }}">
                                    <div class="form-group">
                                        <textarea name="intro" class="form-control" rows="5"></textarea>
                                    </div>  
                                    <span class="help-block">{{ $errors->first('intro', ':message') }}</span>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <label>{{trans('vne-member::language.placeholder.member.birthday') }}</label>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" name="birthday" id="birthday" placeholder="{{trans('vne-member::language.placeholder.member.birthday') }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <label>{{ trans('vne-member::language.label.member.address') }}</label>
                                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" rows="5"></textarea>
                                    </div>  
                                    <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- /.tab-pane -->
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
            var domain = "/admin/laravel-filemanager/";
            $("#lfm1").filemanager('image', {prefix: domain});
            $('#birthday').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $('#form-add-member').bootstrapValidator({
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
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: 'Trường này không được bỏ trống'
                            },
                            regexp: {
                                regexp: '^[a-zA-Z0-9_]+$',
                                message: 'Username chỉ gồm số hoặc chữ'
                            },
                            stringLength: {
                                min: 3,
                                max: 100,
                                message: 'Tên đăng nhập phải từ 3 đến 100 kí tự'
                            },
                            remote: {
                                type: 'get',
                                message: 'Tên đăng nhập đã tồn tại',
                                url: '{{route('vne.member.member.check-username-exist')}}',
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Trường này không được bỏ trống'
                            },
                            stringLength: {
                                min: 1,
                                max: 10,
                                message: 'Số điện thoại không đúng định dạng'
                            },
                            // regexp: {
                            //     regexp: "(09|01[2|6|8|9])+([0-9]{8})",
                            //     message: 'Số điện thoại không đúng định dạng'
                            // },
                            remote: {
                                type: 'get',
                                message: 'Số điện thoại đã tồn tại',
                                url: '{{route('vne.member.member.check-phone-exist')}}',
                            }
                        }
                    },
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
                            regexp: {
                                regexp: "^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$",
                                message: 'Mật khẩu phải chứa 8 ký tự : chứa ít nhất 1 số, 1 chữ viết hoa, 1 chữ viết thường, 1 ký tự đặc biệt'
                            }
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
