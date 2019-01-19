<div class="c-user js-user">
    <div class="exit"></div>
    <div class="inner">
        <div class="left">
            <div class="bg">
                <span><img src="images/bg-user.png" alt=""></span>
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

                <form class="form form-log-in show" id="form-login" method="post" action="{{ route('hocplus.frontend.auth.login') }}">
                    <div class="title">Đăng nhập</div>
                    <div class="form-group notification" id="login-notification" style="display: none;">
                        <div class="text">Thông tin đăng nhập không chính xác.
                            <br>Vui lòng kiểm tra lại.</div>
                        <span class="closed"></span>
                    </div>
                    <div class="form-group email">
                        <input class="form-control" type="email,phone" id="login-email" placeholder="Email hoặc số điện thoại">
                    </div>
                    <div class="form-group password">
                        <input class="form-control" type="password" id="login-password" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group form-check">
                <span>
                  <input class="form-check-input" type="checkbox" id="login-remember">
                  <label class="form-check-label" for="login-remember">Ghi nhớ mật khẩu</label>
                </span>
                        <span>
                  <span class="btn-forgot-password">Quên mật khẩu?</span>
                </span>
                    </div>
                    <button class="btn" type="submit">Đăng nhập</button>
                </form>

                <form class="form form-register" id="form-register" method="post" action="{{ route('hocplus.frontend.auth.register') }}">
                    <div class="title">Đăng ký</div>
                    <div class="form-group notification" id="register-notification" style="display: none;">
                        <div class="text" id="register-notification-text"></div>
                        <span class="closed"></span>
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
                    <button class="btn" type="submit">Đăng ký</button>
                </form>

                <form class="form form-restore-password">
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

                <form class="form form-new-password">
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

                <div class="other show">
                    <p>- Hoặc -</p>
                    <a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> <span>Đăng ký bằng facebook</span></a>
                    <a href="" class="btn btn-goole"><i class="fa fa-google"></i> <span>Đăng ký bằng google</span></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="over-body"></div> <!-- / over body -->

<div class="c-slideout js-slideout">
    <div class="inner">
        <div class="group-btn">
            <a href="" class="btn btn-lecturers">Trở thành giảng viên</a>
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