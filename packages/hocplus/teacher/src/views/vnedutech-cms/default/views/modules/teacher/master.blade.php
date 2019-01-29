<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Học plus</title>

  <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/css/main.min.css' }}"/>

</head>

<body>

  <div id="app">

    <header class="header">

      <section class="c-topbar">
        <div class="container">
          <div class="inner">
            <div class="left">
              <div class="logo">
                <a href="#"><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/logo.png" alt=""></a>
              </div> <!-- / logo -->
              <nav class="navbar js-navbar-tab">
                <span class="title"><i class="fa fa-th"></i> Danh mục</span>
                <div class="inner">
                  <div class="tab">
                    <div class="tab-button">
                      @foreach ($subjects as $subject)
                        <div class="item active">{{$subject->name}}</div>
                      @endforeach
                    </div>
                    <div class="tab-body">
                      @foreach ($subjects as $k => $subject)
                      <div class="item <?php if ($k == 0) { echo 'active'; } ?>">
                        <ul class="list">
                          @if ($subject->getClass()) 
                          @foreach ($subject->getClass() as $class)
                          <li class="list-item">
                              <a href="/danh-sach-khoa-hoc?subject_id={{$subject->subject_id}}&classes_id={{$class->classes_id}}"><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/icon/icon-11.png" alt="">
                                  {{$class->name}}
                              </a>
                          </li>
                          @endforeach
                          @endif
                        </ul>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </nav> <!-- / navbar -->
            </div> <!-- / left -->
            <div class="right">
              <div class="search">
                <form class="form">
                  <input type="text" placeholder="Tìm kiếm...">
                  <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div> <!-- / search -->
              <a class="btn btn-lecturers" href="">Trở thành giảng viên</a> <!-- / button lecturers -->
              <button class="btn btn-user">Đăng nhập</button> <!-- / user -->
              <div class=" notification">
                <div class="icon">
                  <i class="fa fa-bell"></i>
                  <span class="number">6</span>
                  <div class="inner">
                    <div class="wrapper">
                      <div class="title">Thông báo</div>
                      <ol class="list">
                        <li class="item">
                          <a class="item-inner" href="">
                            <div class="img"><span><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/c1.png" alt=""></span></div>
                            <div class="info">
                              <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                              <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                            </div>
                          </a>
                        </li>
                        <li class="item">
                          <a class="item-inner" href="">
                            <div class="img"><span><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/c1.png" alt=""></span></div>
                            <div class="info">
                              <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                              <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                            </div>
                          </a>
                        </li>
                        <li class="item">
                          <a class="item-inner" href="">
                            <div class="img"><span><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/c1.png" alt=""></span></div>
                            <div class="info">
                              <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                              <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                            </div>
                          </a>
                        </li>
                        <li class="item">
                          <a class="item-inner" href="">
                            <div class="img"><span><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/c1.png" alt=""></span></div>
                            <div class="info">
                              <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                              <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                            </div>
                          </a>
                        </li>
                        <li class="item">
                          <a class="item-inner" href="">
                            <div class="img"><span><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/c1.png" alt=""></span></div>
                            <div class="info">
                              <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                              <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                            </div>
                          </a>
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div> <!-- / notification -->
            </div> <!-- / right -->

          </div> <!-- / inner -->
        </div> <!-- / container -->
      </section> <!-- / Top bar -->

    </header> <!-- / Header -->

    <main class="main">

      <nav class="c-breadcrumb">
        <div class="container">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách thầy cô</li>
          </ol>
        </div>
      </nav> <!-- / breadcrumb -->
      <form action="/teacher" method="post">
      <div class="section c-filter">
        <div class="container">
          <div class="inner">
            <div class="left">
              <input type="submit" class="btn btn-filter" value="Lọc kết quả">
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="upcomming" <?php if (isset($params['upcomming'])) echo "checked" ?>>
                <label class="form-check-label" >Sắp diễn ra</label>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="incomming" <?php if (isset($params['incomming'])) echo "checked" ?>>
                <label class="form-check-label">Đang diễn ra</label>
              </div>
              <div class="form-group">
                <select class="form-control" name="byclass">
                  <option selected="true" disabled="disabled">Theo lớp</option>
                  @foreach ($classes as $class)
                    <?php if (isset($params['byclass'])) { ?>
                    <option value="{{$class->classes_id}}" <?php if ($params['byclass'] == $class->classes_id) { echo " selected "; }?>>{{$class->name}}</option>
                    <?php } else { ?>
                    <option value="{{$class->classes_id}}">{{$class->name}}</option>                    
                    <?php } ?>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" name="bysubject">
                  <option selected="true" disabled="disabled">Theo Môn</option>
                  @foreach ($subjects as $subject)
                    <?php if (isset($params['bysubject'])) { ?>
                    <option value="{{$subject->subject_id}}" <?php if ($params['bysubject'] == $subject->subject_id) { echo " selected "; }?>>{{$subject->name}}</option>
                    <?php } else { ?>
                    <option value="{{$subject->subject_id}}">{{$subject->name}}</option>                    
                    <?php } ?>
                  @endforeach
                </select>
              </div>
            </div> <!-- / left -->
          </div> <!-- / inner -->
        </div> <!-- / container -->
      </div> <!-- / filter -->
      </form>
      <div class="container container-main">
        <div class="row row-main">
          @yield('menu_left')
          
          @yield('content')

        </div> <!-- / row -->
      </div> <!-- / container -->

    </main>

    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-2 block">
            <img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/logo-footer.png" alt="">
            <br>
            <br>
            <img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/bocongthuong.png" alt="">
          </div>
          <div class="col-12 col-lg-4 block">
            <div class="content">
              Hệ thống đào tạo trực tuyến Học Plus - Cùng bạn vươn xa. Học online qua video bài giảng, học hỏi những kỹ
              năng mới trực tuyến để làm chủ tương lai của bạn.
            </div>
          </div>
          <div class="col-12 col-lg-4 block">
            <div class="content">
              <h4 class="title">Thông tin liên hệ</h4>
              <p><b><i class="fa fa-location"></i> Địa chỉ: </b> 25T1 Hoàng Đạo Thúy, Trung Hòa, Cầu Giấy</p>
              <p><b><i class="fa fa-phone"></i> Điện thoại: </b> <b>1900 636 444 - 024 7301 0288</b></p>
              <p><b><i class="fa fa-envelope"></i> Email: </b> contact@vnedutech.vn</p>
            </div>
          </div>
          <div class="col-12 col-lg-2 block">
            <div class="block-item">
              <h4 class="title">Forum Học Plus</h4>
            </div>
            <div class="block-item">
              <h4 class="title">Tải về</h4>
              <a class="btn-app" href=""><img src="/vendor/vnedutech-cms/default/hocplus/teacher/src/images/store.png" alt=""></a>
              <a class="btn-app" href=""><img src="/vendor/vnedutech-cms/default/hocplus/teacher/src/images/goole.png" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <div class="c-user js-user">
      <div class="exit"></div>
      <div class="inner">
        <div class="left">
          <div class="bg">
            <span><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/bg-user.png" alt=""></span>
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

            <form v-if="logIn && !restorePassword" class="form form-log-in">
              <div class="title">Đăng nhập</div>
              <div class="form-group notification">
                <div class="text">Mật khẩu của bạn đã được cập nhật.
                  <br>Đăng nhập để tiếp tục học.</div>
                <button class="closed"></button>
              </div>
              <div class="form-group email">
                <input class="form-control " type="email,phone" placeholder="Email hoặc số điện thoại">
              </div>
              <div class="form-group password">
                <input class="form-control" type="password" placeholder="Mật khẩu">
              </div>
              <div class="form-group form-check">
                <span>
                  <input class="form-check-input" type="checkbox">
                  <label class="form-check-label">Ghi nhớ mật khẩu</label>
                </span>
                <span>
                  <span v-on:click="btnForgotPassword" class="btn-forgot-password">Quên mật khẩu?</span>
                </span>
              </div>
              <button class="btn" type="submit">Đăng nhập</button>
            </form>

            <form v-if="register && !restorePassword" class="form form-register">
              <div class="title">Đăng ký</div>
              <div class="form-group email">
                <input class="form-control " type="email,phone" placeholder="Email hoặc số điện thoại">
              </div>
              <div class="form-group password">
                <input class="form-control" type="password" placeholder="Mật khẩu">
              </div>
              <div class="form-group password">
                <input class="form-control" type="password" placeholder="Xác nhận mật khẩu">
              </div>
              <div class="form-group phone">
                <input class="form-control" type="email,phone" placeholder="Xác thực bằng Email hoặc SĐT">
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

  </div> <!-- / App -->

  <!-- js -->

<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/js/vue.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/js/app.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/js/jquery-3.3.1.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/js/jquery.fancybox.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/js/slick.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacher/src/js/main.js' }}"></script>  

</body>

</html>