<div class="c-user js-user">
    <div class="exit"></div>
    <div class="inner">
        <div class="left">
            <div class="bg">
                <span><img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/bg-user.png" alt=""></span>
            </div>
            <div class="wrapper">

                <div v-if="!logIn" class="content content-log-in">
                    <strong>Bạn đã có<br>tài khoản Học Plus?</strong>
                    <p>Học Plus - Website hàng đầu về giáo dục<br>trực tuyến tại Việt Nam</p>
                    <span v-on:click="btnLogIn" class="btn">Đăng nhập</span>
                </div>

                <div v-if="!register" class="content content-register">
                    <strong>Bạn chưa có<br>tài khoản Học Plus?</strong>
                    <p>Học Plus - Website hàng đầu về giáo dục<br>trực tuyến tại Việt Nam</p>
                    <span v-on:click="btnRegister" class="btn">Đăng ký</span>
                </div>

            </div>
        </div>
        <div class="right">
            <div class="right-inner">

                <form v-if="logIn && !restorePassword" class="form form-log-in" id="form-login" method="post" action="{{route('hocplus.frontend.auth.login')}}">
                    <div class="title">Đăng nhập</div>
                    <div class="form-group notification" id="login-notification" style="display: none">
                        <div class="text">Thông tin đăng nhập không đúng.
                            <br>Vui lòng kiểm tra lại.</div>
                        <button class="closed"></button>
                    </div>

                    <div class="form-group email">
                        <input class="form-control" type="email,phone" name="email" id="login-email" placeholder="Email hoặc số điện thoại">
                    </div>
                    <div class="form-group password">
                        <input class="form-control" type="password" name="password" id="login-password" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group form-check">
                <span>
                  <input class="form-check-input" type="checkbox" name="remember" id="login-remember">
                  <label class="form-check-label" for="login-remember">Ghi nhớ mật khẩu</label>
                </span>
                        <span>
                  <span v-on:click="btnForgotPassword" class="btn-forgot-password">Quên mật khẩu?</span>
                </span>
                    </div>
                    <button class="btn" type="submit">Đăng nhập</button>
                </form>

                <form v-if="register && !restorePassword" class="form form-register" method="post" id="form-register" action="{{route('hocplus.frontend.auth.register')}}">
                    <div class="title">Đăng ký</div>
                    <div class="form-group email">
                        <input class="form-control" type="email,phone" name="email" id="register-email" placeholder="Email hoặc số điện thoại">
                    </div>
                    <div class="form-group password">
                        <input class="form-control" type="password" name="password" id="register-password" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group password">
                        <input class="form-control" type="password" name="confirmPassword" id="register-confirm-password" placeholder="Xác nhận mật khẩu">
                    </div>
                    <div class="form-group phone">
                        <input class="form-control" type="email,phone" name="email_confirm" id="register-email-confirm" placeholder="Xác thực bằng Email hoặc SĐT">
                    </div>
                    <button class="btn" type="submit">Đăng ký</button>
                </form>

                <form v-if="restorePassword" class="form form-restore-password">
                    <div class="title">Lấy lại mật khẩu</div>
                    <div class="content">
                        Để lấy lại mật khẩu, bạn nhập email hoặc số điện thoại đăng nhập vào ô dưới đây. Sau đó Học Plus sẽ gửi
                        email hướng dẫn bạn khôi phục mật khẩu
                    </div>
                    <div class="form-group notification">
                        <div class="text">Một email/tin nhắn chứa nội dung hướng dẫn khởi tạo lại mật khẩu đã được gửi đi. Bạn
                            vui lòng kiểm tra và làm theo hướng dẫn.</div>
                        <button class="closed"></button>
                    </div>
                    <div class="form-group email">
                        <input class="form-control " type="email,phone" placeholder="Email hoặc số điện thoại">
                    </div>
                    <button class="btn" type="submit">Tiếp tục</button>
                </form>

                <form class="form form-new-password" style="display: none;">
                    <div class="title">Phục hồi mật khẩu</div>
                    <div class="content">
                        Bạn vừa yêu cầu đặt mật khẩu mới đăng nhập trên Học Plus. Vui lòng nhập mật khẩu mới vào ô bên dưới
                        (Nên có chữ in hoa, số hoặc dấu).
                    </div>
                    <div class="form-group password">
                        <input class="form-control " type="email,phone" placeholder="Mật khẩu">
                    </div>
                    <button class="btn" type="submit">Hoàn thành</button>
                </form>

                <div v-if="otherUser" class="other">
                    <p>- Hoặc -</p>
                    <a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> <span>Đăng ký bằng facebook</span></a>
                    <a href="" class="btn btn-goole"><i class="fa fa-google"></i> <span>Đăng ký bằng google</span></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="over-body"></div> <!-- / over body -->