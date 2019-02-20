<div class="c-user js-user">
    <div class="exit"></div>
    <div class="user-inner">
      <div class="col-6 left">
        <div class="inner">
          <div class="content">
            <div class="welcome">Chào mừng tới</div>
            <div class="img"><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/images/logo-user-1.png' }}" alt=""></div>
            <div class="text">Hãy cùng Học Plus mang tri thức tới hàng triệu học sinh Việt Nam đồng thời xây dựng và
              củng cố thương hiệu cá nhân cũng như tạo ra một nguồn thu nhập không giới hạn.</div>
          </div>
          <div class="form form-log-in show">
            <form class="teacher" id="form-login-teacher" method="post" action="{{ route('hocplus.frontend.auth.login-teacher') }}">
              <div class="form-group notification" id="login-notification-teacher" style="display: none;">
                  <div class="text" style="color:red">Thông tin đăng nhập không chính xác.
                      <br>Vui lòng kiểm tra lại.</div>
                  <span class="hiddenLabel"></span>
              </div>
              <div class="form-group email">
                  <input class="form-control form-control-user" type="email,phone" id="login-email-teacher" placeholder="Email hoặc số điện thoại">
              </div>
              <div class="form-group password">
                  <input class="form-control form-control-password" type="password" id="login-password-teacher" placeholder="Mật khẩu">
              </div>
              <div class="form-group form-check">
                  <span>
                    <input class="form-check-input" type="checkbox" id="login-remember-teacher">
                    <label class="form-check-label" for="login-remember-teacher">Ghi nhớ mật khẩu</label>
                  </span>
                  <span>
                    <span class="btn-forgot-password">Quên mật khẩu?</span>
                  </span>
              </div>
              <button class="btn btn-log-in" type="submit" id="login-teacher-btn-submit">Đăng nhập</button>
            </form>
          </div>
          <div class="form form-restore-password">
            <form id="form-forgot" method="post" action="{{ route('hocplus.frontend.auth.forgot') }}">
              <div class="title">Lấy lại mật khẩu</div>
              <div class="content">
                Để lấy lại mật khẩu, bạn nhập email hoặc số điện thoại đăng nhập vào ô dưới đây. Sau đó Học Plus sẽ
                gửi
                email hướng dẫn bạn khôi phục mật khẩu
              </div>
              <div class="form-group notification" style="display: none;">
                <div class="text">Một email/tin nhắn chứa nội dung hướng dẫn khởi tạo lại mật khẩu đã được gửi đi.
                  Bạn
                  vui lòng kiểm tra và làm theo hướng dẫn.</div>
                <button class="closed"></button>
              </div>
              <div class="form-group notification" id="forgot-notification-err" style="display: none;">
                <div class="text">Email/số điện thoại không chính xác.
                    <br>Vui lòng kiểm tra lại.</div>
                <span class="hiddenLabel"></span>
              </div>
              <div class="form-group email">
                <input class="form-control form-control-user" type="email,phone" placeholder="Email hoặc số điện thoại">
              </div>
              <button class="btn btn-next" type="submit">Tiếp tục</button>
            </form>
          </div>
          <div class="form form-new-password">
            <form id="form-forgot-password" method="post" action="{{ route('hocplus.frontend.auth.reset', ['resetToken' => $resetToken]) }}">
              <div class="title">Phục hồi mật khẩu</div>
              <div class="content">
                Bạn vừa yêu cầu đặt mật khẩu mới đăng nhập trên Học Plus. Vui lòng nhập mật khẩu mới vào ô bên dưới
                (Nên có chữ in hoa, số hoặc dấu).
              </div>
              <div class="form-group password">
                <input class="form-control form-control-password" type="email,phone" placeholder="Mật khẩu">
              </div>
              <button class="btn btn-finish" type="submit">Hoàn thành</button>
            </form>
            <form class="form form-new-password-1">
              <div class="title">Tạo mới mật khẩu</div>
              <div class="content">
                  Yêu cầu của bạn không được tìm thấy! Vui lòng kiểm tra lại thông tin.
                  <br><br><br><br><br><br><br><br><br><br>
              </div>
            </form>
            <form class="form form-new-password-2">
                <div class="title">Tạo mới mật khẩu</div>
                <div class="content">
                    Yêu cầu của bạn đã hết hạn! Vui lòng gửi lại yêu cầu.
                    <br><br><br><br><br><br><br><br><br>
                </div>
            </form>
          </div>
        </div>
      </div> <!-- / left -->
      <div class="col-6 right">
        <div class="bg">
          <span><img src="images/bg-user.png" alt=""></span>
        </div>

        <div class="content">
          <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/images/logo-user-2.png' }}" alt="">
          <p>Dễ dàng mở lớp, có học sinh ở khắp mọi nơi,<br>không hạn chế về địa lý.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="over-body"></div> <!-- / over body -->