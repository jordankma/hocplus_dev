<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Giảng viên {{$teacher->name}}</title>
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
            <li class="breadcrumb-item"><a href="/teacher">Danh sách thầy cô</a></li>
            <li class="breadcrumb-item active">{{$teacher->name}}</li>
          </ol>
        </div>
      </nav> <!-- / breadcrumb -->

      <section class="c-lecturers-detail">
        <div class="container">
          <div class="row inner">
            <div class="col-12 col-md-6 col-lg-4 avatar">
              <div class="img">
                <div class="wrapper">
                  @if ($teacher->avatar_detail)                  
                  <a href=""><img src="{{$teacher->avatar_detail}}" alt=""></a>
                  @else
                  <a href=""><img src="{{$teacher->avatar_index}}" alt=""></a>
                  @endif
                </div>
              </div>
              <a href="" class="btn"><i class="fa fa-rss"></i> Quan tâm</a>
            </div>
            <div class="col-12 col-md-6 col-lg-8 info">
              <div class="headline">
                <h1>{{$teacher->name}}</h1>
                <div class="star">
                      @for ($i=1; $i<= $teacher->rating; $i++)
                        <i class="fa fa-star"></i>
                      @endfor
                </div>
              </div>
              <div class="class">
                <span>Giảng viên các lớp:</span>
                <ol>
                  @foreach ($teach_classes as $class)
                    <li>{{$class->name}}</li>
                  @endforeach
                </ol>
              </div>
              <div class="text">
                {{$teacher->intro}}
              </div>
              <div class="row info-other">
                <div class="col-12 col-md-6 col-lg-5 item">
                  <div class="title"><i class="fa fa-bank"></i> Trường:</div>
                  <div class="content">{{$teacher->workplace}}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 item">
                  <div class="title"><i class="fa fa-suitcase"></i> Kinh nghiệm:</div>
                  <div class="content">{{$teacher->experience}}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 item">
                  <div class="title"><i class="fa fa-book"></i> Bộ môn giảng dạy:</div>
                  @if ($teach_subject)
                  <div class="content">{{$teach_subject->name}}</div>
                  @endif
                </div>
                <div class="col-12 col-md-6 col-lg-5 item">
                  <div class="title"><i class="fa fa-graduation"></i> Học vị:</div>
                  <div class="content">{{$teacher->degree}}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 item">
                  <div class="title"><i class="fa fa-envelope"></i> Email hỗ trợ:</div>
                  <div class="content">{{$teacher->email}}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 item">
                  <div class="title"><i class="fa fa-facebook"></i> Facebook:</div>
                  <div class="content"><a href="{{$teacher->facebook}}">{{$teacher->name}}</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section c-course-group">
        <div class="container">
          <div class="course-group__header">
            <h2 class="headline">
              <a href="#"><span>Khóa học sắp diễn ra</span></a>
            </h2>
          </div>
           <div class="row">
            @if ($courses['will'])
            @foreach ($courses['will'] as $course)
            <figure class="col-12 col-md-6 col-lg-3 c-item-course">
              <div class="inner">
                <div class="img">
                  <a href="/khoa-hoc/{{$course->course_id}}">
                    <img src="{{$course->avartar}}" alt="">
                  </a>
                </div>
                <h3 class="name"><a href="/khoa-hoc/{{$course->course_id}}">{{$course->name}}</a></h3>
                <div class="info">
                  <div class="info-lecturers">
                    <div class="lecturers">
                      <div class="avatar">
                          <img width="25" height="25" src="{{$teachers[$course->course_id]->avatar_index}}" alt="">
                      </div>
                      <a class="name-lecturers" href="">{{$teachers[$course->course_id]->name}}</a>
                    </div>
                    <div class="star">
                      @for ($i=1; $i<= $teachers[$course->course_id]->rating; $i++)
                        <i class="fa fa-star"></i>
                      @endfor
                    </div>
                  </div>
                  <div class="subjects-class">
                    <div class="subjects"><span>{{$subject_classes[$course->course_id]->subject_name}}</span></div>
                    <div class="class"><span>{{$subject_classes[$course->course_id]->class_name}}</span></div>
                  </div>
                  <div class="registration-time">
                    <a href="/buy-course?course_id={{$course->course_id}}" class="btn btn-registration">Đăng ký</a>
                    <span class="time"><i class="fa fa-pencil"></i> {{$course->number_lesson}} buổi</span>
                  </div>
                </div>
              </div>
              <div class="tooltip">
                <div class="tooltip-wrappwe">
                  <h3 class="tooltip-name"><a href="/khoa-hoc/{{$course->course_id}}">{{$course->name}}</a></h3>
                  <div class="tooltip-info">
                    <span class="info-time"><i class="fa fa-play"></i> {{$course->number_lesson}} buổi học</span>
                    <div class="info-class"><i class="fa fa-folder-open"></i> {{$subject_classes[$course->course_id]->class_name}}</div>
                  </div>
                  <div class="tooltip-describe">
                    <div class="describe-title">Mô tả:</div>
                    <div class="describe-content"><?php echo $course->summary;?></div>
                  </div>
                  <a href="/buy-course?course_id={{$course->course_id}}" class="btn btn-registration">Đăng ký</a>
                </div>
              </div>
            </figure>
            @endforeach
            @endif
          </div>
        </div>
      </section> <!-- / course group -->

      <section class="section c-course-group">
        <div class="container">
          <div class="course-group__header">
            <h2 class="headline">
              <a href="#"><span>Khóa học Đang diễn ra</span></a>
            </h2>
          </div>
          <div class="row">
            @foreach ($courses['now'] as $course)
            <figure class="col-12 col-md-6 col-lg-3 c-item-course">
              <div class="inner">
                <div class="img">
                  <a href="/khoa-hoc/{{$course->course_id}}">
                    <img src="{{$course->avartar}}" alt="">
                  </a>
                </div>
                <h3 class="name"><a href="/khoa-hoc/{{$course->course_id}}">{{$course->name}}</a></h3>
                <div class="info">
                  <div class="info-lecturers">
                    <div class="lecturers">
                      <div class="avatar">
                          <img width="25" height="25" src="{{$teachers[$course->course_id]->avatar_index}}" alt="">
                      </div>
                      <a class="name-lecturers" href="">{{$teachers[$course->course_id]->name}}</a>
                    </div>
                    <div class="star">
                      @for ($i=1; $i<= $teachers[$course->course_id]->rating; $i++)
                        <i class="fa fa-star"></i>
                      @endfor
                    </div>
                  </div>
                  <div class="subjects-class">
                    <div class="subjects"><span>{{$subject_classes[$course->course_id]->subject_name}}</span></div>
                    <div class="class"><span>{{$subject_classes[$course->course_id]->class_name}}</span></div>
                  </div>
                  <div class="registration-time">
                    <a href="/buy-course?course_id={{$course->course_id}}" class="btn btn-registration">Đăng ký</a>
                    <span class="time"><i class="fa fa-pencil"></i> {{$course->number_lesson}} buổi</span>
                  </div>
                </div>
              </div>
              <div class="tooltip">
                <div class="tooltip-wrappwe">
                  <h3 class="tooltip-name"><a href="/khoa-hoc/{{$course->course_id}}">{{$course->name}}</a></h3>
                  <div class="tooltip-info">
                    <span class="info-time"><i class="fa fa-play"></i> {{$course->number_lesson}} buổi học</span>
                    <div class="info-class"><i class="fa fa-folder-open"></i> {{$subject_classes[$course->course_id]->class_name}}</div>
                  </div>
                  <div class="tooltip-describe">
                    <div class="describe-title">Mô tả:</div>
                    <div class="describe-content"><?php echo $course->summary;?></div>
                  </div>
                  <a href="/buy-course?course_id={{$course->course_id}}" class="btn btn-registration">Đăng ký</a>
                </div>
              </div>
            </figure>
            @endforeach
          </div>
        </div>
      </section> <!-- / course group -->

      <section class="section c-course-group">
        <div class="container">
          <div class="course-group__header">
            <h2 class="headline">
              <a href="#"><span>Khóa học đã kết thúc</span></a>
            </h2>
          </div>
          <div class="row">
            @foreach ($courses['end'] as $course)
            <figure class="col-12 col-md-6 col-lg-3 c-item-course">
              <div class="inner">
                <div class="img">
                  <a href="/khoa-hoc/{{$course->course_id}}">
                    <img src="{{$course->avartar}}" alt="">
                  </a>
                </div>
                <h3 class="name"><a href="/khoa-hoc/{{$course->course_id}}">{{$course->name}}</a></h3>
                <div class="info">
                  <div class="info-lecturers">
                    <div class="lecturers">
                      <div class="avatar">
                          <img width="25" height="25" src="{{$teachers[$course->course_id]->avatar_index}}" alt="">
                      </div>
                      <a class="name-lecturers" href="">{{$teachers[$course->course_id]->name}}</a>
                    </div>
                    <div class="star">
                      @for ($i=1; $i<= $teachers[$course->course_id]->rating; $i++)
                        <i class="fa fa-star"></i>
                      @endfor
                    </div>
                  </div>
                  <div class="subjects-class">
                    <div class="subjects"><span>{{$subject_classes[$course->course_id]->subject_name}}</span></div>
                    <div class="class"><span>{{$subject_classes[$course->course_id]->class_name}}</span></div>
                  </div>
                  <div class="registration-time">
                    <a href="/buy-course?course_id={{$course->course_id}}" class="btn btn-registration">Đăng ký</a>
                    <span class="time"><i class="fa fa-pencil"></i> {{$course->number_lesson}} buổi</span>
                  </div>
                </div>
              </div>
              <div class="tooltip">
                <div class="tooltip-wrappwe">
                  <h3 class="tooltip-name"><a href="/khoa-hoc/{{$course->course_id}}">{{$course->name}}</a></h3>
                  <div class="tooltip-info">
                    <span class="info-time"><i class="fa fa-play"></i> {{$course->number_lesson}} buổi học</span>
                    <div class="info-class"><i class="fa fa-folder-open"></i> {{$subject_classes[$course->course_id]->class_name}}</div>
                  </div>
                  <div class="tooltip-describe">
                    <div class="describe-title">Mô tả:</div>
                    <div class="describe-content"><?php echo $course->summary;?></div>
                  </div>
                  <a href="/buy-course?course_id={{$course->course_id}}" class="btn btn-registration">Đăng ký</a>
                </div>
              </div>
            </figure>
            @endforeach
          </div>
        </div>
      </section> <!-- / course group -->

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