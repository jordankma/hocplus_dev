<header class="header">

    <section class="c-topbar js-fixed">
        <div class="container">
            <div class="container">
                <div class="inner">
                    <div class="left">
                        <div class="logo">
                            <a href="/"><img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/logo.png" alt=""></a>
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
                                                    <li class="list-item"><a href="list-khoa-hoc.html">
                                                            <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/icon/icon-11.png" alt="">
                                                            {{ $classes->classes_name }}</a></li>
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
                        <a class="btn btn-lecturers" href="">Trở thành giảng viên</a> <!-- / button lecturers -->
                        @if($USER_LOGGED)
                            {{ $USER_LOGGED->email }} |&nbsp;&nbsp;&nbsp;<a href="{{ route('hocplus.frontend.auth.logout') }}">Logout</a>&nbsp;&nbsp;&nbsp;
                        @else
                            <button class="btn btn-user">Đăng nhập</button> <!-- / user -->
                        @endif
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
                        </div> <!-- / notification -->
                    </div> <!-- / right -->
                </div> <!-- / inner -->
            </div> <!-- / container -->
        </div>
    </section> <!-- / Top bar -->

</header> <!-- / Header -->