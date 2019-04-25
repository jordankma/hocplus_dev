<div class="c-user js-user">
    <div class="exit"></div>
    <div class="inner">
        <div class="left">
            <div class="bg">
                <span><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/bg-user.png' }}" alt=""></span>
            </div>
            <div class="wrapper">

                <div class="content content-log-in">
                    <strong>Bạn đã có<br>tài khoản Học Plus?</strong>
                    <p>Học Plus - Website hàng đầu về giáo dục<br>trực tuyến tại Việt Nam</p>
                    <span class="btn">Đăng nhập</span>
                </div>

                <div class="content content-register show">
                    <strong>Bạn chưa có<br>tài khoản Học Plus?</strong>
                    <p>Học Plus - Website hàng đầu về giáo dục<br>trực tuyến tại Việt Nam</p>
                    <span class="btn">Đăng ký</span>
                </div>

            </div>
        </div>
        <div class="right">
            <div class="right-inner">

                <div class="form form-log-in show" style="padding-top: 0px">
                    {{--<div class="tabs">--}}
                        {{--<div class="tabs-item tabs-parents-student tabs-active">Phụ huynh/học sinh</div>--}}
                        {{--<div class="tabs-item tabs-teacher">Giáo viên</div>--}}
                    {{--</div>--}}
                    {{-- <strong style="font-size: 20px; color: #152b75">Học sinh</strong> --}}
                    <form class="parents-student show" id="form-login" method="post" action="{{ route('hocplus.frontend.auth.login') }}">
                        <div class="form-group notification" id="login-notification" style="display: none;">
                            <div class="text">Thông tin đăng nhập không chính xác hoặc tài khoản chưa kích hoạt.
                                <br>Vui lòng kiểm tra lại.</div>
                            <span class="hiddenLabel"></span>
                        </div>
                        <div class="form-group notification" id="register-notification-done" style="display: none;">
                            <div class="text" id="forgot-notification-text">Chúc mừng bạn đã đăng ký tài khoản thành công. Mời bạn kiểm tra mail để kích hoạt trước khi đăng nhập!</div>
                            {{-- <button class="hiddenLabel"></button> --}}
                        </div>
                        <div class="form-group email">
                            <input class="form-control " type="email,phone" id="login-email" placeholder="Email hoặc số điện thoại">
                        </div>
                        <div class="form-group password">
                            <input class="form-control" type="password" id="login-password" placeholder="Mật khẩu">
                        </div>
                        <div class="form-group form-check">
                            <span>
                              <input class="form-check-input" type="checkbox" id="login-remember">
                              <label class="form-check-label" for="login-remember">Ghi nhớ mật khẩu</label>
                            </span>
                            <span><span class="btn-forgot-password">Quên mật khẩu?</span></span>
                        </div>
                        <button class="btn" type="submit" id="login-btn-submit">Đăng nhập</button>
                    </form>
                    {{--<form class="teacher" id="form-login-teacher" method="post" action="{{ route('hocplus.frontend.auth.login-teacher') }}">--}}
                        {{--<div class="form-group notification" id="login-notification-teacher" style="display: none;">--}}
                            {{--<div class="text">Thông tin đăng nhập không chính xác.--}}
                                {{--<br>Vui lòng kiểm tra lại.</div>--}}
                            {{--<span class="hiddenLabel"></span>--}}
                        {{--</div>--}}
                        {{--<div class="form-group email">--}}
                            {{--<input class="form-control " type="email,phone" id="login-email-teacher" placeholder="Email hoặc số điện thoại">--}}
                        {{--</div>--}}
                        {{--<div class="form-group password">--}}
                            {{--<input class="form-control" type="password" id="login-password-teacher" placeholder="Mật khẩu">--}}
                        {{--</div>--}}
                        {{--<div class="form-group form-check">--}}
                            {{--<span>--}}
                              {{--<input class="form-check-input" type="checkbox" id="login-remember-teacher">--}}
                              {{--<label class="form-check-label" for="login-remember-teacher">Ghi nhớ mật khẩu</label>--}}
                            {{--</span>--}}
                            {{--<span>--}}
                              {{--<span class="btn-forgot-password">Quên mật khẩu?</span>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        {{--<button class="btn" type="submit" id="login-teacher-btn-submit">Đăng nhập</button>--}}
                    {{--</form>--}}
                </div>

                <form class="form form-register" id="form-register" method="post" action="{{ route('hocplus.frontend.auth.register') }}">
                    <div class="title">Đăng ký</div>
                    <div class="form-group notification" id="register-notification" style="display: none;">
                        <div class="text" id="register-notification-text"></div>
                        <span class="hiddenLabel"></span>
                    </div>
                    <div class="form-group email">
                        <input class="form-control " type="email,phone" id="register-email" placeholder="Email hoặc số điện thoại">
                    </div>
                    <div class="form-group password">
                        <input class="form-control" type="password" id="register-password" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group password">
                        <input class="form-control" type="password" id="register-confirm-password" placeholder="Xác nhận mật khẩu">
                    </div>
                    <div class="form-group phone">
                        <input class="form-control" type="email,phone" id="register-email-confirm" placeholder="Xác thực bằng Email hoặc SĐT">
                    </div>
                    {{-- <div class="form-group check">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="student"
                                   checked>
                            <label class="form-check-label" for="exampleRadios1">Học sinh</label>
                            <span class="checkmark"></span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="parent">
                            <label class="form-check-label" for="exampleRadios2">Phụ huynh</label>
                            <span class="checkmark"></span>
                        </div>
                    </div> --}}
                    <p style="font-size: 13px; color: #000000a8;">Bằng cách nhấp vào đăng ký, bạn đồng ý với 
                        <a href="http://hocplus.vn/news/detail/45-dieu-khoan-su-dung-hocplus" style="text-decoration: none;color: #000000ed;">Điều khoản sử dụng và chính sách bảo mật </a> của chúng tôi
                    </p>
                    <button class="btn" type="submit" id="register-btn-submit">Đăng ký</button>
                </form>

                <form class="form form-restore-password" id="form-forgot" method="post" action="{{ route('hocplus.frontend.auth.forgot') }}">
                    <div class="title">Tạo mới mật khẩu</div>
                    <div class="content">
                        Để tạo mới mật khẩu, bạn nhập email hoặc số điện thoại đăng nhập vào ô dưới đây. Sau đó Học Plus sẽ gửi
                        hướng dẫn bạn tạo mới mật khẩu
                    </div>
                    <div class="form-group notification" id="forgot-notification" style="display: none;">
                        <div class="text" id="forgot-notification-text">Một email/tin nhắn chứa nội dung hướng dẫn tạo mới mật khẩu đã được gửi đi. Bạn
                            vui lòng kiểm tra và làm theo hướng dẫn.</div>
                        <button class="hiddenLabel"></button>
                    </div>
                    <div class="form-group notification" id="forgot-notification-err" style="display: none;">
                        <div class="text">Email/số điện thoại không chính xác.
                            <br>Vui lòng kiểm tra lại.</div>
                        <span class="hiddenLabel"></span>
                    </div>
                    <div class="form-group email">
                        <input class="form-control" type="email,phone" id="forgot-email" placeholder="Email hoặc số điện thoại">
                    </div>
                    <button class="btn" type="submit" id="forgot-btn-submit">Tiếp tục</button>
                </form>

                <form class="form form-new-password" id="form-forgot-password" method="post" action="{{ route('hocplus.frontend.auth.reset', ['resetToken' => $resetToken]) }}">
                    <div class="title">Tạo mới mật khẩu</div>
                    <div class="content">
                        Bạn vừa yêu cầu đặt mật khẩu mới đăng nhập trên Học Plus. Vui lòng nhập mật khẩu mới vào ô bên dưới
                        (Nên có chữ in hoa, số hoặc dấu).
                    </div>
                    <div class="form-group notification" id="forgot-password-notification" style="display: none;">
                        <div class="text" id="forgot-notification-text">Tạo mới mật khẩu thành công. Mời bạn đăng nhập.</div>
                        <button class="hiddenLabel"></button>
                    </div>
                    <div class="form-group notification" id="forgot-password-notification-err" style="display: none;">
                        <div class="text">Tạo mới mật khẩu không thành thành công.
                            <br>Vui lòng kiểm tra lại.</div>
                        <span class="hiddenLabel"></span>
                    </div>
                    <div class="form-group password">
                        <input class="form-control " type="password" id="forgot-password-new" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group password">
                        <input class="form-control " type="password" id="forgot-password-renew" placeholder="Xác nhận mật khẩu">
                    </div>
                    <button class="btn" type="submit" id="reset-btn-submit">Hoàn thành</button>
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

                {{-- <div class="other show">
                    <p>- Hoặc -</p>
                    <a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> <span>Đăng ký bằng facebook</span></a>
                </div> --}}

            </div>
        </div>
    </div>
</div>
<div class="over-body"></div> <!-- / over body -->

<div class="c-slideout js-slideout">
    <div class="inner">
        <div class="group-btn">
            <a href="" class="btn btn-lecturers">Trở thành giáo viên</a>
            <button class="btn btn-user">Đăng nhập</button>
        </div>
        <nav class="slideout-navbar">
            <ul class="nav">
                <li class="nav-item">
                    <a href="" class="nav-link">Môn Toán</a>
                    <ul>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 3</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 4</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 5</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 6</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 7</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 8</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 9</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 10</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 11</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 12</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Môn Văn</a>
                    <ul>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 3</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 4</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 5</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 6</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 7</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 8</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 9</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 10</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 11</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 12</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Môn Anh</a>
                    <ul>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 3</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 4</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 5</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 6</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 7</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 8</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 9</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 10</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 11</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 12</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Môn Lý</a>
                    <ul>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 3</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 4</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 5</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 6</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 7</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 8</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 9</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 10</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 11</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 12</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Môn Hóa</a>
                    <ul>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 3</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 4</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 5</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 6</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 7</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 8</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 9</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 10</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 11</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 12</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Môn Sinh</a>
                    <ul>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 3</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 4</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 5</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 6</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 7</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 8</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 9</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 10</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 11</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Lớp 12</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div> <!-- / slideout -->