@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Đăng ký giảng viên' }}@stop

{{-- page level styles --}}
@section('header_styles')
  <style>
    .help-block{
      color: red;
    }
    .has-error input {
      border: 1px solid #a94442;
    }
    .has-success input {
      border: 1px solid #00bc8c;
    }
  </style>
@stop

{{-- Page content --}}
@section('content')
<main class="main">
    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial._c-hero-mini')

    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial._c-reason')

    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial._c-targe')

    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial._c-about-lecturers')

    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial._c-register-lecturers')

  </main> <!-- / main -->    
@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
  <script>
    var notify = '{{ Session::get("success") }}' + '{{ Session::get("error") }}' ;
    console.log($('.c-register-lecturers').offset().top);
    if(notify != ''){
        $('body').scrollTop($('.c-register-lecturers').offset());
    }
    $('#form-register-teacher').bootstrapValidator({
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
                      url: '{{route('vne.teacher.teacher.check-phone-exist')}}',
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
                      url: '{{route('vne.teacher.teacher.check-email-exist')}}',
                  }
              }
          },
          password: {
              validators: {
                  notEmpty: {
                      message: 'Trường này không được bỏ trống'
                  }
                //   regexp: {
                //       regexp: "^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$",
                //       message: 'Mật khẩu phải chứa 8 ký tự : chứa ít nhất 1 số, 1 chữ viết hoa, 1 chữ viết thường, 1 ký tự đặc biệt'
                //   }
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
  </script>
@stop
