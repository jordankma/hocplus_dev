<header class="header">

    <section class="c-topbar js-fixed">
        <div class="container">
            <div class="container">
                <div class="inner">
                    <div class="left">
                        <div class="logo">
                            <a href="/"><img style="width: 108px; height: 50px;" src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/logo-header.svg' }}" alt=""></a>
                        </div> <!-- / logo -->
                        <nav class="navbar js-navbar-tab">
                            <span class="title"><i class="fa fa-th"></i> Danh mục</span>
                            <div class="inner">
                                <div class="tab">
                                    <div class="tab-button">
                                        @foreach($subjectClass as $k => $subject)
                                            <div class="item{{ ($k == 0) ? ' active' : '' }}">{{ $subject->subject_name }}</div>
                                        @endforeach
                                    </div>
                                    <div class="tab-body">
                                        @foreach($subjectClass as $k => $subject)
                                            <div class="item{{ ($k == 0) ? ' active' : '' }}">
                                                @if(count($subject->subject_classes) > 0)
                                                <ul class="list">
                                                    @foreach($subject->subject_classes as $k => $classes)
                                                    <li class="list-item">
                                                        <a href="{{ route('hocplus.course.list',['classes_id' => $classes->classes_id,'subject_id' => $subject->subject_id]) }}">
                                                            <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/icon/icon-11.png" alt="">
                                                            {{ $classes->classes_name }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
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
                        <a class="btn btn-lecturers" href="{{ route('hocplus.get.register.teacher') }}">Dành cho giáo viên</a> <!-- / button lecturers -->
                        @if($USER_LOGGED)
                            <div class="my-user">
                                <div class="user-inner">
                                    <div class="avatar">
                                        <img src="{{ ($USER_LOGGED->avatar != '' || file_exists(substr($USER_LOGGED->avatar, 1))) ? config('site.url_static') . $USER_LOGGED->avatar : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user.png' }}" alt="avatar">
                                    </div>
                                    <div class="name">{{ ($USER_LOGGED->name != '') ? $USER_LOGGED->name : (($USER_LOGGED->email != '') ? $USER_LOGGED->email : (($USER_LOGGED->phone != '') ? $USER_LOGGED->phone : (($USER_LOGGED->user_name != '' ? $USER_LOGGED->user_name : 'Student')))) }}</div>
                                </div>
                                <div class="dropdown">
                                    <ul class="list">
                                        <li class="item"><a href="{{ route('hocplus.studentprofile.bang-thong-tin') }}"><i class="fa fa-dashboard"></i> <span>Khóa học của tôi</span></a></li>
                                        <li class="item"><a href="{{ route('hocplus.studentprofile.khoa-hoc-cua-toi') }}"><i class="fa fa-briefcase"></i> <span>Khóa học yêu thích</span></a></li>
                                        <li class="item"><a href="{{ route('hocplus.studentprofile.index') }}"><i class="fa fa-gear"></i> <span>Quản lý tài khoản</span></a></li>
                                        <li class="item"><a href="{{ route('hocplus.frontend.auth.logout') }}"><i class="fa fa-log-out"></i> <span>Đăng xuất</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class=" notification">
                                <div class="icon">
                                    <i class="fa fa-bell"></i>
                                    <span class="number">6</span>
                                    <div class="inner">
                                        <div class="wrapper">
                                            <div class="title">Thông báo</div>
                                            <ol class="list">
                                                <li class="item">
                                                    <a class="item-inner" href="">
                                                        <div class="img"><span><img src="images/c1.png" alt=""></span></div>
                                                        <div class="info">
                                                            <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                                                            <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="item">
                                                    <a class="item-inner" href="">
                                                        <div class="img"><span><img src="images/c1.png" alt=""></span></div>
                                                        <div class="info">
                                                            <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                                                            <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="item">
                                                    <a class="item-inner" href="">
                                                        <div class="img"><span><img src="images/c1.png" alt=""></span></div>
                                                        <div class="info">
                                                            <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                                                            <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="item">
                                                    <a class="item-inner" href="">
                                                        <div class="img"><span><img src="images/c1.png" alt=""></span></div>
                                                        <div class="info">
                                                            <div class="info-title">Khóa học bồi dưỡng môn Sinh sẽ</div>
                                                            <div class="info-date">diễn ra vào 15:00 chiều nay</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="item">
                                                    <a class="item-inner" href="">
                                                        <div class="img"><span><img src="images/c1.png" alt=""></span></div>
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
                            </div> <!-- / notification --> --}}
                        @else
                        <button class="btn btn-user btn-log-in">Đăng nhập</button> <!-- / user -->
                        <button class="btn btn-user btn-registration">Đăng ký</button> <!-- / user -->
                        @endif
                    </div> <!-- / right -->
                </div> <!-- / inner -->
            </div> <!-- / container -->
        </div>
    </section> <!-- / Top bar -->

</header> <!-- / Header -->