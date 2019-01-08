@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Course" }}@stop

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
                    <li class="breadcrumb-item"><a href="#">Lớp 1</a></li>
                    <li class="breadcrumb-item active">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Văn</li>
                </ol>
            </div>
        </nav> <!-- / breadcrumb -->

        <div class="container container-main" style="margin-top: 20px">
            <div class="row row-main">

                <div class="col-12 col-lg-8 main-left">

                    <div class="c-course-detail">
                        <div class="headline">
                            <h1 class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - chuyên văn</h1>
                            <span class="number-evaluate">
                  <span class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                  <span class="number">( 35 )</span>
                </span>
                        </div> <!-- / headline -->
                        <div class="user">
                            <div class="avatar">
                                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/avatar.png" alt="">
                            </div>
                            <div class="name">Nguyễn Bích Diệp</div>
                        </div> <!-- / user -->
                        <div class="media">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/kuZqRn_bhfU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div> <!-- / media -->
                        <div class="feature">
                            <div class="title">Bạn sẽ được học</div>
                            <ol class="list">
                                <li class="item"><i class="fa fa-check"></i> <span>Nắm chắc nội dung cơ bản nhất trong từng tác phẩm</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Kỹ năng học thuộc lòng để học tốt môn Văn</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Học cách ghi nhớ kiến thức bằng sơ đồ tư duy</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Luyện đọc nhanh văn bản</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Học theo đặc trưng của phân môn</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Nghiên cứu kĩ đề thi của những năm gần đây</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Chia ra kiến thức môn văn ra làm 2 phần: Văn xuôi
                      và Thơ</span></li>
                                <li class="item"><i class="fa fa-check"></i> <span>Phương pháp học văn theo từng dạng câu hỏi trong
                      đề</span></li>
                            </ol>
                        </div> <!-- / feature -->
                        <div class="result">
                            <div class="title">Mục tiêu khóa học:</div>
                            <ol class="list">
                                <li class="item">Thứ nhất, hình thành và phát triển năng lực giao tiếp bằng tiếng mẹ đẻ cho học sinh,
                                    rèn luyện cho trẻ em kỹ năng đọc hiểu và viết đúng tiếng Việt, khả năng diễn đạt – cả viết và nói –
                                    những điều mình muốn thể hiện.</li>
                                <li class="item">Thứ hai, bồi dưỡng và phát triển năng lực thẩm mỹ cho học sinh. Hình thành ở trẻ em
                                    một kiểu cảm nhận đặc thù về thế giới, một cách nhìn về sự vật và con người thấm nhuần cảm xúc, đầy
                                    chất tưởng tượng, bay bổng, huyễn hoặc.
                                    Thứ ba, bồi dưỡng tâm hồn và phát triển nhân cách cho học sinh. Tác phẩm văn chương là kết quả của
                                    sự sáng tạo </li>
                                <li class="item">đặc sắc, chứa đựng các giá trị Chân, Thiện, Mỹ. Văn gắn với chữ, chữ gẵn với nghĩa,
                                    tác phẩm văn mang nhiều giá trị, nội dung ý nghĩa khác nhau, vô cùng phong phú. Thông qua việc
                                    giảng dạy tác phẩm, người giáo viên có thể khơi dậy ở học sinh tình yêu đối với cái đẹp, lòng nhân
                                    ái, khát khao lý tưởng cũng như những hiểu biết về thế giới, về xã hội và nhất là về con người.</li>
                            </ol>
                        </div> <!-- / result -->
                        <div class="request">
                            <div class="title">Các yêu cầu khóa học:</div>
                            <ol class="list">
                                <li class="item">Học sinh học nên học đều đặn bài giảng hàng tuần</li>
                                <li class="item">Làm đầy đủ các bài kiểm tra cuối mỗi chuyên đề, học phần để tự đánh giá được năng
                                    lực của bản thân</li>
                                <li class="item">Kết hợp ôn tập lại kiến thức cơ bản trong sách giáo khoa trong quá trình học nếu
                                    chưa nắm vững.</li>
                            </ol>
                        </div> <!-- / request -->
                        <div class="calendar">
                            <div class="title">Nội dung khóa học:</div>
                            <div class="inner">
                                <div class="grid top">
                                    <div class="col-grid-2">Lịch học</div>
                                    <div class="col-grid-7">Thời gian biểu</div>
                                    <div class="col-grid-3">Vào lớp</div>
                                </div>
                                <div class="list">
                                    <div class="grid item">
                                        <div class="col-grid-2">Buổi 1</div>
                                        <div class="col-grid-7">
                                            <div class="title">Văn học trung đại</div>
                                            <div class="info">ừ thế kỉ thứ X đén trước khi hình thành văn học Việt Nam chỉ có văn học dân
                                                gian. Đầu thế
                                                kỉ thứ X đánh dấu sự ra đời của dòng văn học Việt Nam. Văn học còn được gọi là: Văn học
                                                trung đại</div>
                                        </div>
                                        <div class="col-grid-3"><span class="statu statu-cyan">Đã diễn ra</span></div>
                                    </div>
                                    <div class="grid item">
                                        <div class="col-grid-2">Buổi 2</div>
                                        <div class="col-grid-7">
                                            <div class="title">Văn học trung đại</div>
                                            <div class="info">ừ thế kỉ thứ X đén trước khi hình thành văn học Việt Nam chỉ có văn học dân
                                                gian. Đầu thế
                                                kỉ thứ X đánh dấu sự ra đời của dòng văn học Việt Nam. Văn học còn được gọi là: Văn học
                                                trung đại</div>
                                        </div>
                                        <div class="col-grid-3"><span class="statu statu-blue">Đang diễn ra</span></div>
                                    </div>
                                    <div class="grid item">
                                        <div class="col-grid-2">Buổi 3</div>
                                        <div class="col-grid-7">
                                            <div class="title">Văn học trung đại</div>
                                            <div class="info">ừ thế kỉ thứ X đén trước khi hình thành văn học Việt Nam chỉ có văn học dân
                                                gian. Đầu thế
                                                kỉ thứ X đánh dấu sự ra đời của dòng văn học Việt Nam. Văn học còn được gọi là: Văn học
                                                trung đại</div>
                                        </div>
                                        <div class="col-grid-3">
                                            <p><span class="statu statu-red">Sắp diễn ra</span></p>
                                            <p>Buổi học sẽ diễn ra sau<br>
                                                <b style="color: #d2232f;">5 tiếng nữa</b></p>
                                        </div>
                                    </div>
                                    <div class="grid item">
                                        <div class="col-grid-2">Buổi 4</div>
                                        <div class="col-grid-7">
                                            <div class="title">Văn học trung đại</div>
                                            <div class="info">ừ thế kỉ thứ X đén trước khi hình thành văn học Việt Nam chỉ có văn học dân
                                                gian. Đầu thế
                                                kỉ thứ X đánh dấu sự ra đời của dòng văn học Việt Nam. Văn học còn được gọi là: Văn học
                                                trung đại</div>
                                        </div>
                                        <div class="col-grid-3">
                                            <p><span class="statu statu-red">Sắp diễn ra</span></p>
                                            <p>Buổi học sẽ diễn ra sau<br>
                                                <b style="color: #d2232f;">25/11/2018</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- / calendar -->
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_8swg"></div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c0e409afa177bdd"></script>
                        <!-- / end -->

                        @include('HOCPLUS-FRONTEND::modules.frontend.course._partial._evaluate')

                        @include('HOCPLUS-FRONTEND::modules.frontend.course._partial._commit')

                    </div>
                </div> <!-- / main left -->

                <div class="col-12 col-lg-4 main-right">
                    <div class="c-course-info">
                        <div class="price"><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span></div>
                        <div class="info">
                            <ol>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/book.png" alt=""> Môn học: Văn</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/book1.png" alt=""> Khối lớp: 10</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user.png" alt=""> Số buổi: 10 buổi</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/date.png" alt=""> Thời lượng: 2 tiếng</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user1.png" alt=""> Số lượng HS tối đa: 50 người</li>
                                <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user2.png" alt=""> Số lượng HS đã tham gia: 27 người</li>
                            </ol>
                        </div>
                        <a class="btn btn-registration" href="">Đăng ký ngay</a>
                    </div> <!-- / course info -->

                    @include('HOCPLUS-FRONTEND::modules.frontend.course._partial._related')
                </div> <!-- / main right -->

            </div> <!-- / row -->
        </div> <!-- / container -->



    </main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
