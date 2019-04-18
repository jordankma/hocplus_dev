@if(!Auth::guard('teacher')->check())
<section class="section c-register-lecturers">
  <div class="container">
    <div class="headline">
      <h2 class="title">Đăng ký trở thành giáo viên</h2>
      @if(Session::has('success'))
        <h3 style="color:teal">{{ Session::get('success') }}</h3>
      @elseif(Session::has('error'))
        <h3 style="color:tomato">{{ Session::get('error') }}</h3>
      @endif
    </div>
    <div class="row form-wrapper">
      <div class="col-12 col-lg-10">
        <form class="row form" action="{{ route('hocplus.post.register.teacher')}}" method="post" id="form-register-teacher">
          <div class="col-12 col-md-6 form-group">
            <input type="mane" name="name" class="form-control" id="exampleInputNameRL" placeholder="Họ và tên">
          </div>
          <div class="col-12 col-md-6 form-group">
            <input type="email" name="email" class="form-control" id="exampleInputEmailRL" placeholder="Email">
          </div>
          <div class="col-12 col-md-6 form-group">
            <input type="password" name="password" class="form-control" id="exampleInputPasswordRL" placeholder="Mật khẩu">
          </div>
          <div class="col-12 col-md-6 form-group">
            <input type="phone" name="phone" class="form-control" id="exampleInputphoneRL" placeholder="Số điện thoại">
          </div>
          <div class="col-12 col-md-6 form-group">
            <input type="password" name="conf_password" class="form-control" id="exampleInputPasswordConfirmRL" placeholder="Xác nhận mật khẩu">
          </div>
          <div class="col-12 col-md-6 form-group">
            <input type="address" name="address" class="form-control" id="exampleInputAddressRL" placeholder="Trường học bạn đang giảng dạy">
          </div>
          <div class="col-12 form-group form-select">
            <div class="form-select__wrapper">
              <select class="form-control multiselect" name="class_subject[]" multiple="multiple">
                @if(!empty($list_class))
                @foreach($list_class as $key => $value)
                    <optgroup label="{{ $value->name }}">
                        @if(!empty($value->getSubject))
                        @foreach($value->getSubject as $key2 => $value2)
                            <option value="{{ $value->classes_id . '-' . $value2->subject_id }}">{{ $value2->name }}</option>
                        @endforeach
                        @endif
                    </optgroup>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-12 col-md-12 form-group form-check">
            <input type="checkbox" name="try_create_course" class="form-check-input" id="exampleCheck">
            <label class="form-check-label" for="exampleCheck">Tick nếu bạn muốn tạo khóa học thử nghiệm</label>
          </div>
          <div class="col-12 col-md-12 form-group form-check">
            <p style="font-size: 13px; color: #000000a8;margin: 0 auto;">Bằng cách nhấp vào đăng ký, bạn đồng ý với 
              <a href="http://hocplus.vn/news/detail/45-dieu-khoan-su-dung-hocplus" style="text-decoration: none;color: #000000ed;">Điều khoản sử dụng và chính sách bảo mật </a> của chúng tôi
            </p>
          </div>
          <div class="col-12 form-group form-btn"><button type="submit" class="btn">Đăng ký giảng dạy</button></div>
        </form>
      </div>
    </div>
  </div> <!-- / container -->
</section> <!-- / register lecturers -->
@endif