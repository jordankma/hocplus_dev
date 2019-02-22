<header class="header">
    <div class="c-topbar">
    <div class="container topbar-container">
        <div class="banner">
        <a href="{{ route('hocplus.get.register.teacher') }}">
            <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/images/logo-header.png' }}" alt="">
        </a>
        </div>
        <div class="my-user">
            @if($USER_LOGGED)
                <div class="user-inner">
                    <div class="avatar">
                    <img src="{{ config('site.url_static') . $USER_LOGGED->avatar_index }}" alt="avatar">
                    </div>
                    <div class="name">{{ ($USER_LOGGED->email != '') ? $USER_LOGGED->email : ($USER_LOGGED->phone != '') ? $USER_LOGGED->email : $USER_LOGGED->user_name }}</div>
                </div>
                <div class="dropdown">
                    <ul class="list">
                    <li class="item"><a href="{{ route('hocplus.get.my.course.teacher') }}"><i class="fa fa-dashboard"></i> <span>Bảng thông
                            tin</span></a></li>
                    <li class="item"><a href="{{ route('hocplus.get.my.course.teacher') }}"><i class="fa fa-briefcase"></i> <span>Khóa học
                            của tôi</span></a></li>
                    <li class="item"><a href="{{ route('hocplus.get.my.course.teacher') }}"><i class="fa fa-gear"></i> <span>Quản lý tài khoản</span></a></li>
                    <li class="item"><a href="{{ route('hocplus.frontend.auth.logout') }}"><i class="fa fa-log-out"></i> <span>Đăng xuất</span></a></li>
                    </ul>
                </div>       
            @else
                <div class="btn-group">
                    <span class="btn btn-registration" data-scroll="#c-register-lecturers">Đăng ký</span>
                    <span class="btn btn-log-in js-btn-log-in">Đăng nhập</span>
                </div>
            @endif
        </div>
    </div>
    </div> <!-- / Topbar -->

    <nav class="c-navbar">
    <div class="container navbar-container">
        <ul class="nav">
        <li class="nav-item active">
            <a href="" class="nav-link"><i class="fa fa-home"></i></a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">Giới thiệu</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">Liên hệ</a>
        </li>
        </ul>
        <div class="info">
        <span class="time"><i class="fa fa-clock"></i> 08:00 - 17:00</span>
        <span class="phone"><i class="fa fa-phone"></i> Hotline: 1900 636 444</span>
        </div>
    </div>
    </nav> <!-- / Navbar -->

</header> <!-- / Header -->