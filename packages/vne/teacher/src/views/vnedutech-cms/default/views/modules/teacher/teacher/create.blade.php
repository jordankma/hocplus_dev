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
<style>

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
                <!-- errors -->
                <form action="{{ route('vne.teacher.teacher.add') }}" method="POST" class="bf" id="form-add-teacher">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <ul class="nav nav-tabs">
                    <li class=" nav-item active">
                        <a href="#info-required" data-toggle="tab" class="nav-link">Thông tin đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a href="#info" data-toggle="tab" class="nav-link">Thông tin hiện thị</a>
                    </li>
                </ul>
                <div class="tab-content" id="slim1" style="margin-top: 20px">
                    <div class="tab-pane active" id="info-required">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>{{ trans('vne-teacher::language.label.teacher.name') }}</label>
                                <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.name')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-teacher::language.label.teacher.user_name') }}</label>
                                <div class="form-group {{ $errors->first('user_name', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="text" name="user_name" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.user_name')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('user_name', ':message') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
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
                                <label>{{ trans('vne-member::language.label.member.gender') }}</label>
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" checked>Nam</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female">Nữ</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>{{ trans('vne-teacher::language.label.teacher.password') }}</label>
                                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.password')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-teacher::language.label.teacher.conf_password') }}</label>
                                <div class="form-group {{ $errors->first('conf_password', 'has-error') }}">
                                    <div class="form-group">
                                        <input type="password" name="conf_password" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.conf_password')}}">
                                    </div>  
                                    <span class="help-block">{{ $errors->first('conf_password', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="info"> 
                        <div class="row">
                            <div class="col-sm-4">
                                <label>{{ trans('vne-teacher::language.label.teacher.intro') }}</label>
                                <div class="form-group {{ $errors->first('intro', 'has-error') }}">
                                    <div class="form-group">
                                        <textarea name="intro" class="form-control" rows="5"></textarea>
                                        {{-- <input type="text" name="intro" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.intro')}}"> --}}
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
                                <label>{{trans('vne-teacher::language.label.teacher.avatar_index')}}</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> {{trans('vne-teacher::language.label.teacher.choise_avatar_index')}}
                                            </a>
                                        </span>
                                        <input type="text" name="avatar_index" id="thumbnail1" class="form-control">
                                    </div>
                                    <img id="holder1" style="margin-top:15px;max-height:100px;">
                                </div>
                                <label>{{trans('vne-teacher::language.label.teacher.avatar_detail')}}</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> {{trans('vne-teacher::language.label.teacher.choise_avatar_detail')}}
                                            </a>
                                        </span>
                                        <input type="text" name="avatar_detail" id="thumbnail2" class="form-control">
                                    </div>
                                    <img id="holder2" style="margin-top:15px;max-height:100px;">
                                </div>
                                <label>{{ trans('vne-teacher::language.label.teacher.address') }}</label>
                                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" rows="5"></textarea>
                                        {{-- <input type="text" name="address" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.address')}}"> --}}
                                    </div>  
                                    <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
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
                                        <textarea name="workplace" class="form-control" rows="5"></textarea>
                                        {{-- <input type="text" name="workplace" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.workplace')}}"> --}}
                                    </div>  
                                    <span class="help-block">{{ $errors->first('workplace', ':message') }}</span>
                                </div>
                                <label>{{ trans('vne-teacher::language.label.teacher.achievements') }}</label>
                                <div class="form-group {{ $errors->first('achievements', 'has-error') }}">
                                    <div class="form-group">
                                        <textarea name="achievements" class="form-control" rows="5"></textarea>
                                        {{-- <input type="text" name="achievements" class="form-control" placeholder="{{trans('vne-teacher::language.placeholder.teacher.achievements')}}"> --}}
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
                            <!-- /.col-sm-4 -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group col-xs-12">
                            <label for="blog_category" class="">Actions</label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{ trans('vne-teacher::language.buttons.create') }}</button>
                                <a href="{!! route('vne.teacher.teacher.create') !!}"  class="btn btn-danger">{{ trans('vne-teacher::language.buttons.discard') }}</a>
                            </div>
                        </div>
                    </div>
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
            $("#lfm2").filemanager('image', {prefix: domain});

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
