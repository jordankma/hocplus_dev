@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Course Group" }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    <main class="main">

        <nav class="c-breadcrumb">
            <div class="container">
                <ol class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Lớp 1</li>
                </ol>
            </div>
        </nav> <!-- / breadcrumb -->

        <div class="section c-filter">
            <div class="container">
                <div class="inner">
                    <div class="left">
                        <a href="" class="btn btn-filter">Lọc kết quả</a>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Sắp diễn ra</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Đang diễn ra</label>
                        </div>
                        <div class="form-group">
                            <select class="form-control">
                                <option selected="true" disabled="disabled">Theo lớp</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control">
                                <option selected="true" disabled="disabled">Theo Môn</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div> <!-- / left -->
                    <div class="right">
                        <span>Sắp xếp:</span>
                        <div class="form-group">
                            <select class="form-control">
                                <option selected="true" disabled="disabled">Mới nhất</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div> <!-- / right -->
                </div> <!-- / inner -->
            </div> <!-- / container -->
        </div> <!-- / filter -->

        <div class="container container-main">
            <div class="row row-main">

                @include('HOCPLUS-FRONTEND::modules.frontend.course-group._partial._course-group')

                <div class="col-12 col-lg-9 main-right">

                    @include('HOCPLUS-FRONTEND::modules.frontend.course-group._partial._carousel')

                    <section class="row section list-item-course">
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
                            <div class="inner">
                                <div class="img">
                                    <a href="chi-tiet-khoa-hoc.html">
                                        <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/c1.png" alt="">
                                    </a>
                                </div>
                                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 -
                                        Môn Sinh</a></h3>
                                <div class="info">
                                    <div class="info-lecturers">
                                        <div class="lecturers">
                                            <div class="avatar">
                                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                                            </div>
                                            <a class="name-lecturers" href="">Đinh Tiến Nguyện</a>
                                        </div>
                                        <div class="star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="subjects-class">
                                        <div class="subjects">Môn: <span>Sinh</span></div>
                                        <div class="class">Lớp: <span>10, 11, 12</span></div>
                                    </div>
                                    <div class="registration-time">
                                        <a href="" class="btn btn-registration">Đăng ký</a>
                                        <span class="time"><i class="fa fa-pencil"></i> 3 buổi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip">
                                <div class="tooltip-wrappwe">
                                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">Khóa học bồi dưỡng học sinh giỏi lớp 10,
                                            11, 12 - Môn Sinh</a></h3>
                                    <div class="tooltip-info">
                                        <span class="info-time"><i class="fa fa-play"></i> 3 buổi học</span>
                                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp 2</div>
                                    </div>
                                    <div class="tooltip-describe">
                                        <div class="describe-title">Mô tả:</div>
                                        <div class="describe-content">Giải được toàn bộ bài tập ở SGK và SBT Vật lý lớp 8 và giành điểm
                                            số
                                            cao trong các bài thi/kiểm tra trên lớp.
                                            Tổng kết lại kiến thức trọng tâm.</div>
                                    </div>
                                    <a href="" class="btn btn-registration">Đăng ký</a>
                                </div>
                            </div>
                        </figure>
                    </section> <!-- / list item-course -->

                    <nav class="c-navigation">
                        <div class="container">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span>&laquo;</span>
                                    </a>
                                </li>
                                <li class="nav-item"><a class="nav-link active" href="#">1</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">2</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">3</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span>&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav> <!-- / navigation -->

                </div> <!-- / main right -->

            </div> <!-- / row -->
        </div> <!-- / container -->

    </main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
