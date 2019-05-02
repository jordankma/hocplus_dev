@extends('HOCPLUS-FRONTEND::layouts.frontend')

@section('title', 'Đánh giá')

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

          <div class="col-12 col-lg-8 main-left">

            <div class="c-detail">
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
                  <img src="images/avatar.png" alt="">
                </div>
                <div class="name">Nguyễn Bích Diệp</div>
              </div> <!-- / user -->
              <div class="media">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/kuZqRn_bhfU" frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div> <!-- / media -->
              <div class="feature">
                <div class="title">Bạn sẽ được học</div>
                <ol class="list">
                  <li class="item"><i class="fa fa-check"></i> <span>Nắm chắc nội dung cơ bản nhất trong từng tác
                      phẩm</span></li>
                  <li class="item"><i class="fa fa-check"></i> <span>Kỹ năng học thuộc lòng để học tốt môn Văn</span>
                  </li>
                  <li class="item"><i class="fa fa-check"></i> <span>Học cách ghi nhớ kiến thức bằng sơ đồ tư duy</span>
                  </li>
                  <li class="item"><i class="fa fa-check"></i> <span>Luyện đọc nhanh văn bản</span></li>
                  <li class="item"><i class="fa fa-check"></i> <span>Học theo đặc trưng của phân môn</span></li>
                  <li class="item"><i class="fa fa-check"></i> <span>Nghiên cứu kĩ đề thi của những năm gần đây</span>
                  </li>
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
              <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c0e409afa177bdd">
              </script>
              <!-- / end -->
              <div class="evaluate">
                <div class="btn-evaluate">
                  <span class="text">Đánh giá</span>
                  <span class="stars js-stars" data-modal="#modal-stars">
                    <i class="fa fa-star star rating" id="rating1" data-value="1"></i>
                    <i class="fa fa-star star rating" id="rating2" data-value="2"></i>
                    <i class="fa fa-star star rating" id="rating3" data-value="3"></i>
                    <i class="fa fa-star star rating" id="rating4" data-value="4"></i>
                    <i class="fa fa-star star rating" id="rating5" data-value="5"></i>
                  </span>
                </div>
                <div class="row inner">
                  <div class="col-12 col-md-3 left">
                    <div class="inner">
                      <div class="number">{{$rate}}</div>
                      <div class="star">
                        @for ($i=1; $i<= round($rate); $i++)
                        <i class="fa fa-star active"></i>
                        @endfor
                        @for ($i=round($rate)+1; $i<=5; $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                      </div>
                    </div>
                  </div>
                  <div class="col-7 col-md-6 center">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: {{$stars[5]}}%"></div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: {{$stars[4]}}%"></div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: {{$stars[3]}}%"></div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: {{$stars[2]}}%"></div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: {{$stars[1]}}%"></div>
                    </div>
                  </div>
                  <div class="col-5 col-md-3 right">
                    <div class="statistic">
                      <div class="star">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                      </div>
                      <div class="number">{{$stars[5]}}%</div>
                    </div>
                    <div class="statistic">
                      <div class="star">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <div class="number">{{$stars[4]}}%</div>
                    </div>
                    <div class="statistic">
                      <div class="star">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <div class="number">{{$stars[3]}}%</div>
                    </div>
                    <div class="statistic">
                      <div class="star">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <div class="number">{{$stars[2]}}%</div>
                    </div>
                    <div class="statistic">
                      <div class="star">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <div class="number">{{$stars[1]}}%</div>
                    </div>
                  </div>
                </div><!-- / inner -->
              </div> <!-- / evaluate -->
              <div class="form-commit">
                <div class="title">Bình luận</div>
                <p>Địa chỉ Email của bạn sẽ không được công khai.</p>
                <form class="row form">
                  <div class="col-12 col-md-6 form-group">
                    <input type="name" class="form-control" placeholder="Họ tên">
                  </div>
                  <div class="col-12 col-md-6 form-group">
                    <input type="email" class="form-control" placeholder="Địa chỉ email">
                  </div>
                  <div class="col-12 form-group">
                    <textarea class="form-control" rows="8" placeholder="Bình luận"></textarea>
                  </div>
                  <div class="col-12 submit">
                    <div class="inner">
                      <div class="star">
                        <span><b>Đánh giá của bạn:</b></span>
                        <span class="group-fa">
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                        </span>
                      </div>
                      <button type="submit" class="btn btn-red">Đăng</button>
                    </div>
                  </div>
                </form>
              </div> <!-- / form commit -->
              <div class="user-commit">
                <ol class="list">
                  <li class="item">
                    <div class="avatar">
                      <div class="img">
                        <img src="images/c16.png" alt="">
                      </div>
                    </div>
                    <div class="info">
                      <div class="top">
                        <div class="name-date">
                          <span class="name"><b>Nguyễn Phước Huynh</b></span> - <span class="date">10:25 - 26 tháng 9,
                            2017</span>
                        </div>
                        <div class="star">
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                        </div>
                      </div>
                      <div class="content">
                        Khóa học này rất bổ ích, nhờ nó mà giờ kiến thức của em vững hơn nhiều, em cũng đã theo kịp bài
                        học trên lớp rồi. Cảm ơn chị rất nhiều.
                      </div>
                      <div class="prefer"><i class="fa fa-thumbs"></i> <span>2 Thích</span></div>
                    </div>
                  </li>
                  <li class="item">
                    <div class="avatar">
                      <div class="img">
                        <img src="images/c16.png" alt="">
                      </div>
                    </div>
                    <div class="info">
                      <div class="top">
                        <div class="name-date">
                          <span class="name"><b>Nguyễn Phước Huynh</b></span> - <span class="date">10:25 - 26 tháng 9,
                            2017</span>
                        </div>
                        <div class="star">
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                        </div>
                      </div>
                      <div class="content">
                        Khóa học này rất bổ ích, nhờ nó mà giờ kiến thức của em vững hơn nhiều, em cũng đã theo kịp bài
                        học trên lớp rồi. Cảm ơn chị rất nhiều.
                      </div>
                      <div class="prefer"><i class="fa fa-thumbs"></i> <span>2 Thích</span></div>
                    </div>
                  </li>
                </ol>
              </div> <!-- / user commit -->
            </div>

          </div> <!-- / main left -->

          <div class="col-12 col-lg-4 main-right">
            <div class="c-course-info">
              <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span></div>
              <div class="info">
                <ol>
                  <li><img src="src/images/book.png" alt=""> Môn học: Văn</li>
                  <li><img src="src/images/book1.png" alt=""> Khối lớp: 10</li>
                  <li><img src="src/images/user.png" alt=""> Số buổi: 10 buổi</li>
                  <li><img src="src/images/date.png" alt=""> Thời lượng: 2 tiếng</li>
                  <li><img src="src/images/user1.png" alt=""> Số lượng HS tối đa: 50 người</li>
                  <li><img src="src/images/user2.png" alt=""> Số lượng HS đã tham gia: 27 người</li>
                </ol>
              </div>
              <a class="btn btn-registration" href="mua-khoa-hoc.html">Đăng ký ngay</a>
            </div> <!-- / course info -->

            <div class="c-related-courses">
              <h3 class="title">Các khóa học liên quan</h3>
              <ol class="list">
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
                <li class="item">
                  <div class="img">
                    <a href=""><img src="images/c7.png" alt=""></a>
                  </div>
                  <div class="inner">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><img src="src/images/tag.png" alt=""> <span>1.000.000<small>đ</small></span>
                    </div>
                  </div>
                </li>
              </ol>
            </div> <!-- / related courses -->
          </div> <!-- / main right -->

        </div> <!-- / row -->
      </div> <!-- / container -->

    <!-- Modal -->
    <div class="modal" id="modal-stars">
      <div class="modal-exit"></div>
      <div class="modal-inner" id="show_modal_result">          
      </div>
    </div>

    </main> <!-- / main -->
   <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var rate; 
        $('.rating').click(function(){
            rate= $(this).data('value'); 
            $.ajax('/rate/submit', {
                    type: 'POST',  // http method
                    data: { 
                        rate: rate, 
                        course_id: {{$course_id}},
                        member_id: {{$member_id}},
                    },  // data to submit
                    success: function (data, status, xhr) {
                        var data= jQuery.parseJSON(data);
                        var rated = data.rate;
                        var i;
                        if (rated > 0) {
                            for (i=1; i<=rated; i++) {
                                $('#rating'+i).addClass('active');
                            }
                        }
                        if (data.result==2) {
                            $('#show_modal_result').html('Bạn phải đăng nhập mới được đánh giá');
                        }
                        else
                        if (data.result==0) {
                            $('#show_modal_result').html('Bạn đã đánh giá rồi');
                        }
                        else
                        if (data.result==1) {
                            $('#show_modal_result').html('Cảm ơn bạn đã đánh giá');
                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                            //$('p').append('Error: ' + errorMessage);
                    }
            });           
         });
         
    });
</script>


@endsection
 