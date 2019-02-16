<header class="header">
    <div class="c-topbar">
    <div class="container topbar-container">
        <div class="banner">
        <a href="{{ route('hocplus.frontend.index') }}">
            <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/logo-header.png' }}" alt="">
        </a>
        </div>
        <div class="btn-group">
        @if($USER_LOGGED)
            <a href="{{ route('hocplus.get.my.course.teacher') }}">
                {{ ($USER_LOGGED->email != '') ? $USER_LOGGED->email : ($USER_LOGGED->phone != '') ? $USER_LOGGED->email : $USER_LOGGED->user_name }}&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ route('hocplus.frontend.auth.logout') }}">Logout</a>&nbsp;&nbsp;&nbsp;    
            </a>        
        @else
            <span class="btn btn-registration" data-scroll="#c-register-lecturers">Đăng ký</span>
            <span class="btn btn-log-in js-btn-log-in">Đăng nhập</span>
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