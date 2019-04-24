<div class="col-12 col-md-4 col-lg-3 ms-left">
    <div class="ms-info">
        <div class="inner-info">
            <div class="info">
                <a href="" class="btn-modify">Sửa</a>
                <div class="avatar">
                <img src="{{isset(Auth::guard('member')->user()->avatar) ? asset(Auth::guard('member')->user()->avatar) : ''}}" alt="avatar">
                </div>
                <div class="content">
                    <div class="name">{{isset(Auth::guard('member')->user()->name) ? Auth::guard('member')->user()->name : ''}}</div>
                    <div class="work">Trường THPT Hai Bà Trưng</div>
                </div>
            </div>
            <nav class="list">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="quan-ly-hoc-sinh-bang-thong-tin.html" class="nav-link">
                            <i class="fa fa-dashboard"></i>
                            <span>Bảng thông tin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('quan-ly-hoc-sinh-vi.html')}}" class="nav-link">
                            <i class="fa fa-money"></i>
                            <span>Ví của tôi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('khoa-hoc-cua-toi')}}" class="nav-link">
                            <i class="fa fa-heart"></i>
                            <span>Wishlist</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-document-time"></i>
                            <span>Lịch sử học</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('ho-so-ca-nhan-hoc-sinh')}}" class="nav-link">
                            <i class="fa fa-gear"></i>
                            <span>Quản lý tài khoản</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-comments"></i>
                            <span>Quản lý bình luận</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div> <!-- / col-3 -->