<div class="ml-info">
    <div class="inner-info">
        <div class="info">
        <a href="{{ route('hocplus.get.edit.profile.teacher') }}" class="btn-modify">Sửa</a>
        <div class="avatar">
            <img src="{{ ($teacher->avatar_index != '') ? config('site.url_static') . $teacher->avatar_index : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user.png' }}" alt="avatar">
        </div>
        <div class="content">
            <div class="name">{{ $teacher->name }}</div>
            <div class="work">{{ $teacher->address }}</div>
        </div>
        <div class="info-class">
            <div class="degree">
            <div class="title">Học vị</div>
            <div class="content">{{ $teacher->degree }}</div>
            </div>
            <div class="class">
            <div class="title">Lớp giảng dạy</div>
            <div class="content">
                @if(!empty($teacher->getClasses))
                @foreach($teacher->getClasses as $item)
                    @if(isset($item->name)) {{ $item->name . ',' }} @endif
                @endforeach
                @endif
            </div>
            </div>
        </div>
        </div>
        <nav class="list">
        <ul class="nav">
            <li class="nav-item">
            <a href="{{ route('hocplus.get.my.dashboard.teacher') }}" class="nav-link">
                <i class="fa fa-dashboard"></i>
                <span>Bảng thông tin</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ route('hocplus.get.my.course.teacher') }}" class="nav-link">
                <i class="fa fa-briefcase"></i>
                <span>Khóa dạy của tôi</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-money"></i>
                <span>Ví của tôi</span>
            </a>
            </li>
            {{-- <li class="nav-item">
            <a href="{{ route('hocplus.frontend.teacher.document') }}" class="nav-link">
                <i class="fa fa-folder-open"></i>
                <span>Quản lý tài liệu</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ route('teacher.exam.manage') }}" class="nav-link">
                <i class="fa fa-layers"></i>
                <span>Quản lý bộ đề</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ route('vne.question.manage') }}" class="nav-link">
                <i class="fa fa-question"></i>
                <span>Quản lý câu hỏi</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-document-time"></i>
                <span>Lịch sử học</span>
            </a>
            </li> --}}
            <li class="nav-item">
            <a href="{{ route('hocplus.get.edit.profile.teacher') }}" class="nav-link">
                <i class="fa fa-gear"></i>
                <span>Quản lý tài khoản</span>
            </a>
            </li>
            {{-- <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-comments"></i>
                <span>Quản lý bình luận</span>
            </a>
            </li> --}}
        </ul>
        </nav>
    </div>

</div>