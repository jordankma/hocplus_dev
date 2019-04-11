<div class="col-12 col-md-4 col-lg-3 ms-left">
        <div class="ms-info">
                <div class="inner-info">
                @if($USER_LOGGED)
                  <div class="info">
                    <a href="/ho-so-ca-nhan-hoc-sinh" class="btn-modify">Sửa</a>
                    <div class="avatar">
                      @if($USER_LOGGED->avatar)
                      <img src="{{config('site.url_static').$USER_LOGGED->avatar}}" alt="avatar">
                      @else
                      <img src="#" alt="avatar">
                      @endif
                    </div>
                    <div class="content">
                      <div class="name">{{$USER_LOGGED->name}}</div>
                      <div class="work">{{$USER_LOGGED->school}}</div>
                    </div>
                  </div>
                @endif
                        <nav class="list">
                                <ul class="nav">
                                        <li class="nav-item">
                                                <a href="/bang-thong-tin" class="nav-link">
                                                        <i class="fa fa-dashboard"></i>
                                                        <span>Bảng thông tin</span>
                                                </a>
                                        </li>
                                        <li class="nav-item">
                                                <a href="/quan-ly-hoc-sinh-vi.html" class="nav-link">
                                                        <i class="fa fa-money"></i>
                                                        <span>Ví của tôi</span>
                                                </a>
                                        </li>
                                        <li class="nav-item">
                                                <a href="/khoa-hoc-cua-toi" class="nav-link">
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
                                                <a href="/ho-so-ca-nhan-hoc-sinh" class="nav-link">
                                                        <i class="fa fa-gear"></i>
                                                        <span>Quản lý tài khoản</span>
                                                </a>
                                        </li>
                                        <li class="nav-item">
                                                <a href="/quan-ly-binh-luan" class="nav-link">
                                                        <i class="fa fa-comments"></i>
                                                        <span>Quản lý bình luận</span>
                                                </a>
                                        </li>
                                </ul>
                        </nav>
                </div>
        </div>
</div> <!-- / col-3 -->