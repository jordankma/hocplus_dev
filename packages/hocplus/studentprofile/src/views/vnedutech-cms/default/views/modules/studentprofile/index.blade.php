@extends('HOCPLUS-FRONTEND::layouts.frontend')

@section('title', 'Hồ sơ cá nhân')

@section('content')

   <main class="main ms-main">

      <div class="container">
        <div class="row">
            
            @include('HOCPLUS-STUDENTPROFILE::modules.studentprofile.include.menu_left')

          <div class="col-12 col-md-8 col-lg-9 ms-right">  
            <form action="/ho-so-ca-nhan-hoc-sinh" enctype="multipart/form-data" method="post">  
            <div class="ms-user">              
              <div class="headline">Hồ sơ cá nhân</div>
              <div class="user-block">
                @if(session()->has('updateSuccess'))
                <div class="status">
                   <i>Trạng thái! {{ session()->get('updateSuccess') }}</i>
                </div>
                @else
                    <div class="status"><i>Trạng thái! Tài khoản chưa cập nhật thông tin</i></div> 
                @endif                             
                <div class="grid avatar">
                  <div class="grid-25">
                    <div class="avatar-inner">
                      <input type="file" id="image" name="image" accept="image/png, image/jpeg">
                      @if($USER_LOGGED)
                      <div class="img">
                        <img src="{{config('site.url_static').$USER_LOGGED->avatar}}" alt="">
                      </div>
                      @endif
                      <span>Thay Avatar</span>

                    </div>
                  </div>
                </div>
                <div class="grid form-group">
                  <div class="grid-25">
                    <label for="exampleInputManagerName">Họ và tên của bạn</label>
                  </div>
                  @if($USER_LOGGED)
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerName" name="name"
                      value="{{$USER_LOGGED->name}}" placeholder="Vui lòng nhập họ và tên của bạn">
                  </div>
                  @else
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerName" name="name"
                       placeholder="Vui lòng nhập họ và tên của bạn">
                  </div>                  
                  @endif
                </div>
                <div class="grid form-group">
                  <div class="grid-25">
                    <label for="exampleInputManagerSex">Giới tính</label>
                  </div>
                  <div class="grid-75">
                    <div class="grid form-group check">
                      @if($USER_LOGGED)
                      <div class="form-check">
                        @if ($USER_LOGGED->gender == 'male')
                        <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerNam"
                          value="male" checked="checked">
                        <label class="form-check-label" for="exampleInputManagerNam">Nam</label>
                        <span class="checkmark"></span>
                        @else 
                        <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerNam"
                          value="male">
                        <label class="form-check-label" for="exampleInputManagerNam">Nam</label>
                        <span class="checkmark"></span>                        
                        @endif
                      </div>
                      <div class="form-check">
                        @if ($USER_LOGGED->gender == 'female')
                        <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerFemale"
                          value="female" checked='checked'>
                        <label class="form-check-label" for="exampleInputManagerFemale">Nữ</label>
                        <span class="checkmark"></span>
                        @else
                        <input class="form-check-input" type="radio" name="gender" id="exampleInputManagerFemale"
                          value="female">
                        <label class="form-check-label" for="exampleInputManagerFemale">Nữ</label>
                        <span class="checkmark"></span>                        
                        @endif
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadiosSex" id="exampleInputManagerOther"
                          value="option3">
                        <label class="form-check-label" for="exampleInputManagerOther">Khác</label>
                        <span class="checkmark"></span>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="grid form-group">
                  <div class="grid-25">
                    <label for="exampleInputManagerBirthday">Ngày sinh</label>
                  </div>
                  <div class="grid-75">
                    <div class="grid">
                      <div class="grid-30">
                        <select class="form-control" name="day">
                          <option selected="true" disabled="disabled">Ngày</option>
                          @for ($i = 1; $i <= 31; $i++ ) 
                            @if (intval($arr_birth[2]) == $i)
                            <option selected='true'>{{$i}}</option>                         
                            @else
                            <option >{{$i}}</option>
                            @endif
                          @endfor
                        </select>
                      </div>
                      <div class="grid-30">
                        <select class="form-control" name="month">
                          <option selected="true" disabled="disabled">Tháng</option>
                          @for ($i = 1; $i <= 12; $i++ ) 
                            @if (intval($arr_birth[1]) == $i)
                            <option value='{{$i}}' selected='true'>Tháng {{$i}}</option>
                            @else
                            <option value='{{$i}}'>Tháng {{$i}}</option>
                            @endif
                          @endfor
                        </select>
                      </div>
                      <div class="grid-30">
                        <select class="form-control" name="year">
                          <option selected="true" disabled="disabled">Năm</option>
                          @for ($i = 2019; $i >= 1970; $i-- )
                            @if (intval($arr_birth[0]) == $i)
                            <option value='{{$i}}' selected='true'>{{$i}}</option>
                            @else
                            <option value='{{$i}}'>{{$i}}</option>
                            @endif
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="grid form-group">
                  @if($USER_LOGGED)
                  <div class="grid-25">
                    <label for="exampleInputManagerAddress">Địa chỉ</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerAddress" name="address"
                    value="{{$USER_LOGGED->address}}"  placeholder="Vui lòng nhập địa chỉ của bạn">
                  </div>
                  @else
                  <div class="grid-25">
                    <label for="exampleInputManagerAddress">Địa chỉ</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerAddress" name="address"
                    placeholder="Vui lòng nhập địa chỉ của bạn">
                  </div>                  
                  @endif
                </div>
                <div class="grid form-group">
                  @if($USER_LOGGED)
                  <div class="grid-25">
                    <label for="exampleInputManagerPhone">Số điện thoại</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerPhone" name="phone"
                    value="{{$USER_LOGGED->phone}}"  placeholder="Vui lòng nhập số điện thoại của bạn">
                  </div>
                  @else
                  <div class="grid-25">
                    <label for="exampleInputManagerPhone">Số điện thoại</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerPhone" name="phone"
                    placeholder="Vui lòng nhập số điện thoại của bạn">
                  </div>                  
                  @endif
                </div>
                <div class="grid form-group">
                  @if($USER_LOGGED)
                  <div class="grid-25">
                    <label for="exampleInputManagerSchool">Trường học</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerSchool" name="school"
                    value="{{$USER_LOGGED->school}}"  placeholder="Vui lòng nhập tên trường học bạn đang giảng dạy">
                  </div>
                  @else
                  <div class="grid-25">
                    <label for="exampleInputManagerSchool">Trường học</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="text" id="exampleInputManagerSchool" name="school"
                    placeholder="Vui lòng nhập tên trường học bạn đang giảng dạy">
                  </div>                  
                  @endif
                </div>
                <div class="grid form-group">
                  <div class="grid-25">
                    <label for="exampleInputManagerTimeZone">Múi thời gian hiện tại</label>
                  </div>
                  <div class="grid-75">
                    <div class="grid">
                      <div class="grid-70">
                        <select class="form-control" name="exampleInputManagerTimeZone">
                          <option value="">(UTC+07:00) Bangkok, Hanoi, Jakarta</option>
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
            @if($USER_LOGGED)
            <input type="hidden" name="member_id" value="{{$USER_LOGGED->member_id}}">
            @else
            <input type="hidden" name="member_id" value="0">
            @endif
            </form>
            <div class="ms-user">
              <div class="headline">Thay đổi mật khẩu</div>
              <div class="user-block">
                @if (session('error'))
                    <div class="status">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="status">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('hocplus.studentprofile.change-password') }}">
                {{ csrf_field() }}    
                @if($USER_LOGGED)                
                <div class="grid form-group">                 
                  <div class="grid-25">
                    <label for="exampleInputManagerPassword">Mật khẩu hiện tại</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="password" id="exampleInputManagerPassword" name="current-password"
                    placeholder="Vui lòng nhập Mật khẩu hiện tại" required>
                    @if ($errors->has('current-password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('current-password') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>                
                <div class="grid form-group">                   
                  <div class="grid-25">
                    <label for="exampleInputManagerPasswordNew">Mật khẩu mới</label>
                  </div>
                  <div class="grid-75">
                    <input class="form-control" type="password" id="exampleInputManagerPasswordNew" name="new-password"
                           placeholder="Nhập mật khẩu mới" required>
                    @if ($errors->has('new-password'))
                          <span class="help-block">
                          <strong>{{ $errors->first('new-password') }}</strong>
                      </span>
                    @endif                  
                  </div>
                </div>
                <div class="grid form-group">
                  <div class="grid-25">
                    <label for="exampleInputManagerPasswordConfirm">Nhập lại mật khẩu</label>
                  </div>
                  <div class="grid-75">
                    <div class="grid">
                      <div class="grid-70">
                        <input class="form-control" type="password" id="exampleInputManagerPasswordConfirm" name="retype-new-password"
                               placeholder="Nhập mật khẩu mới">
                        @if ($errors->has('retype-new-password'))
                              <span class="help-block">
                              <strong>{{ $errors->first('retype-new-password') }}</strong>
                          </span>
                        @endif                          
                      </div>
                      <div class="grid-30">
                        <button type="submit" class="btn btn-update">Cập nhật</button>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                </form>
              </div> <!-- / block -->
            </div> <!-- / user -->


          </div> <!-- / col-9 -->
        </div>
      </div> <!-- / container -->
    </main> <!-- / main -->

@endsection

