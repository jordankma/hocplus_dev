<header class="header">
    <div class="c-topbar">
    <div class="container topbar-container">
        <div class="banner">
        <a href="{{ route('hocplus.frontend.index') }}">
            <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/images/logo-header.svg' }}" alt="">
        </a>
        </div>
        <div class="my-user">
            @if($TEACHER_LOGGED)
                <div class="user-inner">
                    <div class="avatar">
                    <img src="{{ ($TEACHER_LOGGED->avatar_index != '' || file_exists(substr($TEACHER_LOGGED->avatar_index, 1))) ? config('site.url_static') . $TEACHER_LOGGED->avatar_index : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user.png' }}" alt="avatar">
                    </div>
                    <div class="name">{{ ($TEACHER_LOGGED->name != '') ? $TEACHER_LOGGED->name : (($TEACHER_LOGGED->email != '') ? $TEACHER_LOGGED->email : (($TEACHER_LOGGED->phone != '') ? $TEACHER_LOGGED->phone : (($TEACHER_LOGGED->user_name != '' ? $TEACHER_LOGGED->user_name : 'Teacher')))) }}</div>
                </div>
                <div class="dropdown">
                    <ul class="list">
                    <li class="item"><a href="{{ route('hocplus.get.my.course.teacher') }}"><i class="fa fa-dashboard"></i> <span>Bảng thông tin</span></a></li>
                    <li class="item"><a href="{{ route('hocplus.get.my.course.teacher') }}"><i class="fa fa-briefcase"></i> <span>Khóa dạy của tôi</span></a></li>
                    <li class="item"><a href="{{ route('hocplus.get.edit.profile.teacher') }}"><i class="fa fa-gear"></i> <span>Quản lý tài khoản</span></a></li>
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
            <a href="{{ route('hocplus.frontend.index') }}" class="nav-link"><i class="fa fa-home"></i></a>
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
        <span class="phone"><i class="fa fa-phone"></i> Hotline: {{ (!empty($SETTING['phone'])) ? $SETTING['phone'] : '' }} </span>
        </div>
    </div>
    </nav> <!-- / Navbar -->

</header> <!-- / Header -->