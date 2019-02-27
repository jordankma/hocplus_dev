@extends('HOCPLUS-TEACHERFRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Quản lý tài khoản' }}@stop

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

    <div class="container section">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial.profileteacher._ml-info')
        </div> <!-- / col-3 -->

        <div class="col-12 col-md-8 col-lg-9">
          <form action="{{ route('hocplus.post.edit.profile.teacher') }}" method="POST" id="form-update-teacher-1">
          <div class="ml-user js-content-show-hide">
            <div class="headline js-btn-toggle">Hồ sơ cá nhân</div>
            <div class="user-block js-content">
              @if($teacher->update_info == 0)
                <div class="status"><i>Trạng thái! Tài khoản chưa cập nhật thông tin</i></div>
              @endif
              @if(Session::has('error'))
                <div class="status"><i>{{ Session::get('error') }}</i></div>
              @else 
                <div class="status" style="color: green"><i>{{ Session::get('success') }}</i></div>
              @endif
              <div class="grid avatar js-avatar">
                <div class="grid-25">
                  <div class="avatar-inner">
                    <input class="file-upload" type="file" value="{{ $teacher->avatar_detail }}" id="exampleInputManagerAvatar" name="exampleInputManagerAvatar" accept="image/png, image/jpeg">
                    <div class="img">
                      <img class="profile-pic" src="{{ ($teacher->avatar_detail != '') ? config('site.url_static') . $teacher->avatar_detail : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user.png' }}" alt="">
                    </div>
                    <span>Thay Avatar</span>
                  </div>
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerName">Họ và tên của bạn</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" value="{{ $teacher->name }}" type="text" id="exampleInputManagerName" name="name" placeholder="Vui lòng nhập họ và tên của bạn">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerSex">Giới tính</label>
                </div>
                <div class="grid-75">
                  <div class="grid form-group check">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerNam" value="male" @if($teacher->gender == '') checked @endif @if($teacher->gender == 'male') checked @endif value="male">
                      <label class="form-check-label" for="exampleInputManagerNam">Nam</label>
                      <span class="checkmark"></span>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerFemale" value="female" @if($teacher->gender == 'female') checked @endif value="female">
                      <label class="form-check-label" for="exampleInputManagerFemale">Nữ</label>
                      <span class="checkmark"></span>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerOther" value="other" @if($teacher->gender == 'other') checked @endif value="other">
                      <label class="form-check-label" for="exampleInputManagerOther">Khác</label>
                      <span class="checkmark"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerBirthday">Ngày sinh</label>
                  @php 
                    $timestamp = strtotime($teacher->birthday);
                    $day = date('d', $timestamp);
                    $month = date('m', $timestamp);
                    $year = date('Y', $timestamp);
                  @endphp

                </div>
                <div class="grid-75">
                  <div class="grid">
                    <div class="grid-30">
                      <select class="form-control" name="day">
                        <option selected="true" disabled="disabled">Ngày</option>
                        @for( $i=1 ; $i<=31 ; $i++)
                          <option value="{{$i}}" @if($i == $day) selected @endif>{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="grid-30">
                      <select class="form-control" name="month">
                        <option selected="true" disabled="disabled">Tháng</option>
                        @for( $i=1 ; $i<=12 ; $i++)
                          <option value="{{$i}}" @if($i == $month) selected @endif>Tháng {{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="grid-30">
                      <select class="form-control" name="year">
                        <option selected="true" disabled="disabled">Năm</option>
                        @for( $i=1950 ; $i <= 1996 ; $i++)
                          <option value="{{$i}}" @if($i == $year) selected @endif> {{$i}}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerAddress">Địa chỉ</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->address }}" id="exampleInputManagerAddress" name="address" placeholder="Vui lòng nhập địa chỉ của bạn">
                </div>
              </div>
              {{-- <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerPhone">Số điện thoại</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->phone }}" id="exampleInputManagerPhone" name="phone"
                    placeholder="Vui lòng nhập số điện thoại của bạn">
                </div>
              </div> --}}
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerText">Câu nói yêu thích</label>
                </div>
                <div class="grid-75">
                  <textarea class="form-control" rows="6" id="exampleInputManagerText" name="said_like" placeholder="Nhập vào câu nói yêu thích hoặc phương châm giảng dạy của bạn.">{{ $teacher->said_like }}</textarea>
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerSchool">Trường học</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->workplace }}" id="exampleInputManagerSchool" name="workplace" placeholder="Vui lòng nhập tên trường học bạn đang giảng dạy">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerExperience">Kinh nghiệm</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="number" value="{{ $teacher->experience }}" id="exampleInputManagerExperience" name="experience"
                    placeholder="Vui lòng nhập số năm bạn đã tham gia giảng dạy">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerSubjectsClass">Bộ môn giảng dạy, lớp</label>
                </div>
                <div class="grid-75">
                  <div class="form-control-multiselect">
                    <select class="multiselect" name="class_subject[]" multiple="multiple">
                      @if(!empty($list_class))
                      @foreach($list_class as $key => $value)
                          <optgroup label="{{ $value->name }}">
                              @if(!empty($value->getSubject))
                              @foreach($value->getSubject as $key2 => $value2)
                                  <option value="{{$value->classes_id . '-' . $value2->subject_id}}" 
                                      @if(in_array($value->classes_id . '-' . $value2->subject_id, $list_class_subject_arr)) selected @endif>
                                      {{ $value2->name }}
                                  </option>
                              @endforeach
                              @endif
                          </optgroup>
                      @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerPosition">Học vị</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->degree }}"  id="exampleInputManagerPosition" name="degree" placeholder="Vui lòng nhập học hàm, học vị của bạn">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerTimeZone">Múi thời gian hiện tại</label>
                </div>
                <div class="grid-75">
                  <div class="grid">
                    <div class="grid-70">
                        <select name="timezone" id="timezone" class="form-control">
                          @foreach (timezone_identifiers_list() as $timezone)
                              <option value="{{ $timezone }}" {{ $timezone == $teacher->timezone ? ' selected' : '' }}>{{ $timezone }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="grid-30">
                      <button type="submit" class="btn btn-update">Cập nhật</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- / user -->
          <div class="ml-user js-content-show-hide">
            <div class="headline js-btn-toggle">Thông tin tài khoản</div>
            <div class="user-block js-content">
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerCmndBefore">Ảnh CMND (Trước)</label>
                </div>
                <div class="grid-75">
                  <div class="grid">
                    <div class="grid-70">
                      <div class="form-control file">
                        <span>Nhấp vào đây để tải ảnh lên</span>
                        <input type="file" id="exampleInputManagerCmndBefore" name="exampleInputManagerCmndBefore"
                          accept="image/png, image/jpeg">
                      </div>
                    </div>
                    <div class="grid-30">
                      <button type="submit" class="btn btn-update">Cập nhật</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagercmndAfter">Ảnh CMND (Sau)</label>
                </div>
                <div class="grid-75">
                  <div class="grid">
                    <div class="grid-70">
                      <div class="form-control file">
                        <span>Nhấp vào đây để tải ảnh lên</span>
                        <input type="file" id="exampleInputManagercmndAfter" name="exampleInputManagercmndAfter"
                          accept="image/png, image/jpeg">
                      </div>
                    </div>
                    <div class="grid-30">
                      <button type="submit" class="btn btn-update">Cập nhật</button>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- / block -->
          </div> <!-- / user -->

          <div class="ml-user js-content-show-hide">
            <div class="headline js-btn-toggle">Xác thực hình ảnh</div>
            <div class="user-block js-content">
              @if($teacher->update_info == 0)
                <div class="status"><i>Trạng thái! Tài khoản chưa cập nhật thông tin</i></div>
              @endif
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerBank">Tên ngân hàng</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->bank_name }}" id="exampleInputManagerBank" name="bank_name"
                    placeholder="VD: Ngân hàng Techcombank">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerBankAddress">Chi nhánh ngân hàng</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->bank_branch }}" id="exampleInputManagerBankAddress" name="bank_branch"
                    placeholder="VD: Chi nhánh Hà Nội">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerBankName">Tên tài khoản ngân hàng</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="text" value="{{ $teacher->bank_name_account }}" id="exampleInputManagerBankName" name="bank_name_account"
                    placeholder="VD: Nguyễn Văn A">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerBankNumber">Số tài khoản ngân hàng</label>
                </div>
                <div class="grid-75">
                  <div class="grid">
                    <div class="grid-70">
                      <input class="form-control" type="number" value="{{ $teacher->bank_number }}" id="exampleInputManagerBankNumber" name="bank_number"
                        placeholder="VD: 1900251251">
                    </div>
                    <div class="grid-30">
                      <button type="submit" class="btn btn-update">Cập nhật</button>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- / block -->
          </div> <!-- / user -->

          <div class="ml-user js-content-show-hide">
            <div class="headline js-btn-toggle">Thay đổi mật khẩu</div>
            <div class="user-block js-content">
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerPassword">Mật khẩu hiện tại</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="password" id="exampleInputManagerPassword" name="current_pass"
                    placeholder="Vui lòng nhập tên trường học bạn đang giảng dạy">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerPasswordNew">Mật khẩu mới</label>
                </div>
                <div class="grid-75">
                  <input class="form-control" type="password" id="exampleInputManagerPasswordNew" name="password"
                    placeholder="Nhập mật khẩu hiện tại của bạn">
                </div>
              </div>
              <div class="grid form-group">
                <div class="grid-25">
                  <label for="exampleInputManagerPasswordConfirm">Nhập lại mật khẩu</label>
                </div>
                <div class="grid-75">
                  <div class="grid">
                    <div class="grid-70">
                      <input class="form-control" type="password" id="exampleInputManagerPasswordConfirm" name="conf_password"
                        placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="grid-30">
                      <button type="submit" class="btn btn-update">Cập nhật</button>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- / block -->
          </div> <!-- / user -->
          </form>

        </div> <!-- / col-9 -->
      </div>
    </div> <!-- / container -->
  </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
  <script>
    $('#form-update-teacher-1').bootstrapValidator({
      feedbackIcons: {
          // validating: 'glyphicon glyphicon-refresh',
      },
      fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                },
                stringLength: {
                    max: 150,
                    message: 'Trường này không được quá dài'
                }
            }
        },
        address: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        workplace: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        degree: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        experience: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        day: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        month: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        year: {
            validators: {
                notEmpty: {
                    message: 'Trường này bắt buộc'
                }
            }
        },
        password: {
            validators: {
              stringLength: {
                min: 1,
                max: 6,
                message: 'Mật khẩu ít nhất 6 ký tự'
              },
            }
        },
        conf_password: {
            validators: {
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
