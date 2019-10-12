@extends('HOCPLUS-TEACHERFRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Bảng thông tin' }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
<main class="main">
    <div class="container section">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial.profileteacher._ml-info')
        </div> <!-- / col-3 -->
        <div class="col-12 col-md-8 col-lg-9">
          <div class="ml-statistics">
            <section class="row general-1">
              <div class="col-12 col-lg-4 item">
                <div class="item-inner">
                  <div class="item-icon" style="background: #2a9fff;">
                    <img src="images/icon/general-1.png" alt="">
                  </div>
                  <div class="item-info">
                    <div class="number" style="color: #2a9fff;">0</div>
                    <div class="name">Khóa học đang giảng dạy</div>
                  </div>
                </div>
              </div> <!-- / item -->
              <div class="col-12 col-lg-4 item">
                <div class="item-inner">
                  <div class="item-icon" style="background: #ea3e4e;">
                    <img src="images/icon/general-2.png" alt="">
                  </div>
                  <div class="item-info">
                    <div class="number" style="color: #ea3e4e;">0</div>
                    <div class="name">Giờ giảng dạy</div>
                  </div>
                </div>
              </div> <!-- / item -->
              <div class="col-12 col-lg-4 item">
                <div class="item-inner">
                  <div class="item-icon" style="background: #45b949;">
                    <img src="images/icon/general-3.png" alt="">
                  </div>
                  <div class="item-info">
                    <div class="number" style="color: #45b949">0</div>
                    <div class="name">Người theo dõi</div>
                  </div>
                </div>
              </div> <!-- / item -->
            </section> <!-- / general 1 -->

            <section class="section-general general-2">
              <div class="info">
                <h3 class="title">Thống kê</h3>
                <div class="inner">
                  <div class="general">
                    <span class="name">Tổng doanh thu:</span>
                    <span class="number">0<span class="value">đ</span></span>
                  </div>
                  <div class="general">
                    <span class="name">Doanh thu trung bình:</span>
                    <span class="number">0<span class="value">đ/tháng</span></span>
                  </div>
                </div>
              </div>
              <div class="row group-item">
                <div class="col-12 col-lg-5 item">
                  <div class="item-inner">
                    <div class="item-icon" style="background: #2a9fff;">
                      <img src="images/icon/general-4.png" alt="">
                    </div>
                    <div class="item-info">
                      <div class="number" style="color: #2a9fff;">0</div>
                      <div class="name">Đơn hàng mới</div>
                    </div>
                  </div>
                </div> <!-- / item -->
                <div class="col-12 col-lg-5 item">
                  <div class="item-inner">
                    <div class="item-icon" style="background: #ea3e4e;">
                      <img src="images/icon/general-5.png" alt="">
                    </div>
                    <div class="item-info">
                      <div class="number" style="color: #ea3e4e;">0</div>
                      <div class="name">Học sinh theo học</div>
                    </div>
                  </div>
                </div> <!-- / item -->
              </div>
            </section> <!-- / general 2 -->

            <section class="section-general general-3">

              <div class="charts js-chart">
                <div class="charts-title">
                  <div class="item chart-tab-active" data-chart="#day">Tuần</div>
                  <div class="item" data-chart="#month">Tháng</div>
                  <div class="item" data-chart="#year">Năm</div>
                </div>
                <div class="charts-body">
                  <div class="item chart-body-active" id="day">
                    <canvas></canvas>
                  </div>
                  <div class="item" id="month">
                    <canvas></canvas>
                  </div>
                  <div class="item" id="year">
                    <canvas></canvas>
                  </div>
                </div>
              </div>

              <form class="form-search">
                <div class="form-group">
                  <select class="form-control" id="exampleInputMLClass" name="exampleInputMLClass">
                    <option selected="true" disabled="disabled">Môn học</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" id="exampleInputMLStatus" name="exampleInputMLStatus">
                    <option selected="true" disabled="disabled">Tình trạng</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" id="exampleInputMLPrice" name="exampleInputMLPrice">
                    <option selected="true" disabled="disabled">Khoảng giá</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group search">
                  <input class="form-control" type="search" id="exampleInputMLSearchKeyWord" name="exampleInputMSSearchKeyWord"
                    placeholder="Từ khóa">
                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </div>
              </form> <!-- / form search -->

              <div class="list">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên khóa học</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Học sinh theo học</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>
                          <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                        </td>
                        <td>
                          <div class="price">1.500.000<span>đ</span></div>
                        </td>
                        <td>354 học sinh</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>
                          <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                        </td>
                        <td>
                          <div class="price">1.500.000<span>đ</span></div>
                        </td>
                        <td>354 học sinh</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>
                          <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                        </td>
                        <td>
                          <div class="price">1.500.000<span>đ</span></div>
                        </td>
                        <td>354 học sinh</td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>
                          <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                        </td>
                        <td>
                          <div class="price">1.500.000<span>đ</span></div>
                        </td>
                        <td>354 học sinh</td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>
                          <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                        </td>
                        <td>
                          <div class="price">1.500.000<span>đ</span></div>
                        </td>
                        <td>354 học sinh</td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td>
                          <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                        </td>
                        <td>
                          <div class="price">1.500.000<span>đ</span></div>
                        </td>
                        <td>354 học sinh</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <nav class="c-navigation">
                  <div class="container">
                    <ul class="nav">
                      <li class="nav-item"><a class="nav-link active" href="#">1</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">2</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">3</a></li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span>»</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </nav> <!-- / navigation -->
              </div> <!-- / list -->

            </section> <!-- / general 3 -->

            <section class="section-general general-4">
              <h3 class="title">Lớp học sắp diễn ra</h3>
              <div class="group-item">
                <div class="item status-3">
                  <div class="name">
                    <a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 - Môn Hóa</a>
                  </div>
                  <div class="date">12:24 AM</div>
                </div> <!-- / item -->
                <div class="item status-2">
                  <div class="name">
                    <a href="">Khóa học bồi dưỡng học sinh giỏi lớp 8 - Môn Văn</a>
                  </div>
                  <div class="date">07:00 PM</div>
                </div> <!-- / item -->
                <div class="item status-1">
                  <div class="name">
                    <a href="">Khóa học bồi dưỡng học sinh giỏi lớp 6, 7, 8 - Môn Sinh</a>
                  </div>
                  <div class="date">06/11/2018 08:00 PM</div>
                </div> <!-- / item -->
                <div class="item status-1">
                  <div class="name">
                    <a href="">Khóa học bồi dưỡng học sinh giỏi lớp 7 - Môn Sử</a>
                  </div>
                  <div class="date">07/11/2018 08:00 PM</div>
                </div> <!-- / item -->
                <div class="item status-1">
                  <div class="name">
                    <a href="">Khóa học bồi dưỡng học sinh giỏi lớp 6, 7, 8, 9 - Môn Toán</a>
                  </div>
                  <div class="date">09/11/2018 08:00 PM</div>
                </div> <!-- / item -->
                <div class="item status-1">
                  <div class="name">
                    <a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 - Môn Hóa</a>
                  </div>
                  <div class="date">12:24 AM</div>
                </div> <!-- / item -->
              </div>
            </section> <!-- / general 4 -->

            <section class="section-general general-5">
              <h3 class="title">Những việc cần làm</h3>
              <div class="group-item">
                <div class="item">
                  <div class="name">Chuẩn bị bài giảng khóa học sinh giỏi lớp 8 - Môn Toán</div>
                </div> <!-- / item -->
                <div class="item active">
                  <div class="name">Chuẩn bị bài trắc nghiệm khóa học sinh giỏi lớp 7 - Môn Sinh</div>
                </div> <!-- / item -->
                <div class="item">
                  <div class="name">Chuẩn bị giáo án môn Văn</div>
                </div> <!-- / item -->
                <div class="item">
                  <div class="name">Chuẩn bị bài giảng khóa học sinh giỏi lớp 5 - Môn Toán</div>
                </div> <!-- / item -->
                <div class="item">
                  <div class="name">Chuẩn bị bài giảng khóa học sinh giỏi lớp 5 - Môn Toán</div>
                </div> <!-- / item -->
              </div>
              <div class="function">
                <div class="input">
                  <input type="text" placeholder="Viết thêm việc cần làm">
                </div>
                <div class="btn-group">
                  <a class="btn" href="">Tất cả</a>
                  <a class="btn" href="">Việc cần làm</a>
                  <a class="btn" href="">Xóa việc đã hoàn thành (1)</a>
                </div>
              </div>
            </section> <!-- / general 5 -->

          </div> <!-- / statistics -->
        </div> <!-- / col-9 -->
      </div>
    </div> <!-- / container -->

  </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
@stop
