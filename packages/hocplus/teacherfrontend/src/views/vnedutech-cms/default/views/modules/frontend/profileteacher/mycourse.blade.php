@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Khóa học của tôi' }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
<main class="main ml-main">

    <div class="container">
      <div class="row">

        <div class="col-12 col-md-4 col-lg-3 ml-left">
          <div class="ml-info">
            <div class="inner-info">
              <div class="info">
                <a href="" class="btn-modify">Sửa</a>
                <div class="avatar">
                  <img src="images/avatar-02.png" alt="avatar">
                </div>
                <div class="content">
                  <div class="name">Âu Hà My</div>
                  <div class="work">Giảng viên ĐH Hà Nội</div>
                </div>
                <div class="info-class">
                  <div class="degree">
                    <div class="title">Học vị</div>
                    <div class="content">Thạc sỹ</div>
                  </div>
                  <div class="class">
                    <div class="title">Bộ môn giảng dạy</div>
                    <div class="content">Tiếng Anh, Toán</div>
                  </div>
                </div>
              </div>
              <nav class="list">
                <ul class="nav">
                  <li class="nav-item">
                    <a href="quan-ly-giao-vien-bang-thong-tin.html" class="nav-link">
                      <i class="fa fa-dashboard"></i>
                      <span>Bảng thông tin</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="quan-ly-khoa-hoc-cua-toi.html" class="nav-link">
                      <i class="fa fa-briefcase"></i>
                      <span>Khóa học của tôi</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-money"></i>
                      <span>Ví của tôi</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="quan-ly-quan-ly-tai-lieu.html" class="nav-link">
                      <i class="fa fa-folder-open"></i>
                      <span>Quản lý tài liệu</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="quan-ly-quan-ly-de-thi.html" class="nav-link">
                      <i class="fa fa-layers"></i>
                      <span>Quản lý bộ đề</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="quan-ly-cau-hoi.html" class="nav-link">
                      <i class="fa fa-question"></i>
                      <span>Quản lý câu hỏi</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-document-time"></i>
                      <span>Lịch sử học</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="quan-ly-tai-khoa.html" class="nav-link">
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

        <div class="col-12 col-md-8 col-lg-9 ml-right">
          <section class="ml-list js-ml-list">
            <div class="headline">
              <h2 class="title">Khóa học của tôi</h2>
              <a href="quan-ly-khoi-tao-khoa-hoc.html" class="btn">Khởi tạo khóa học</a>
            </div>
            <div class="list">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Tên khóa học</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Sỹ số</th>
                      <th scope="col">Action</th>
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
                      <td>
                        <div class="number">Sỹ số tối đa: 450<br>Sỹ số thực tế: 154</div>
                      </td>
                      <td>
                        <div class="action">
                          <div class="edit">
                            <i class="fa fa-gear"></i>
                            <i class="fa fa-arrow-right"></i>
                            <ul class="list">
                              <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                              <li><a href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                            </ul>
                          </div>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>
                        <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number">Sỹ số tối đa: 450<br>Sỹ số thực tế: 154</div>
                      </td>
                      <td>
                        <div class="action">
                          <div class="edit">
                            <i class="fa fa-gear"></i>
                            <i class="fa fa-arrow-right"></i>
                            <ul class="list">
                              <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                              <li><a href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                            </ul>
                          </div>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>
                        <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number">Sỹ số tối đa: 450<br>Sỹ số thực tế: 154</div>
                      </td>
                      <td>
                        <div class="action">
                          <div class="edit">
                            <i class="fa fa-gear"></i>
                            <i class="fa fa-arrow-right"></i>
                            <ul class="list">
                              <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                              <li><a href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                            </ul>
                          </div>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>
                        <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number">Sỹ số tối đa: 450<br>Sỹ số thực tế: 154</div>
                      </td>
                      <td>
                        <div class="action">
                          <div class="edit">
                            <i class="fa fa-gear"></i>
                            <i class="fa fa-arrow-right"></i>
                            <ul class="list">
                              <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                              <li><a href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                            </ul>
                          </div>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>
                        <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number">Sỹ số tối đa: 450<br>Sỹ số thực tế: 154</div>
                      </td>
                      <td>
                        <div class="action">
                          <div class="edit">
                            <i class="fa fa-gear"></i>
                            <i class="fa fa-arrow-right"></i>
                            <ul class="list">
                              <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                              <li><a href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                            </ul>
                          </div>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td>
                        <div class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</a></div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number">Sỹ số tối đa: 450<br>Sỹ số thực tế: 154</div>
                      </td>
                      <td>
                        <div class="action">
                          <div class="edit">
                            <i class="fa fa-gear"></i>
                            <i class="fa fa-arrow-right"></i>
                            <ul class="list">
                              <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                              <li><a href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                            </ul>
                          </div>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <nav class="c-navigation">
                <div class="container">
                  <ul class="nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span>&laquo;</span>
                        </a>
                      </li> -->
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
            </div>
          </section>
          <section class="section-01 ml-list js-ml-list">
            <div class="headline">
              <h2 class="title">Khóa học đã diễn ra</h2>
            </div>
            <div class="list">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Tên khóa học</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Sỹ số</th>
                      <th scope="col">Thời gian kết thúc</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <div class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10 - Chuyên Sinh</div>
                      </td>
                      <td>
                        <div class="price">1.500.000<span>đ</span></div>
                      </td>
                      <td>
                        <div class="number number-student">25</div>
                      </td>
                      <td>
                        <div class="date">05/01/2019</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <nav class="c-navigation">
                <div class="container">
                  <ul class="nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span>&laquo;</span>
                        </a>
                      </li> -->
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
            </div>
          </section>
        </div> <!-- / col-9 -->

      </div>

    </div> <!-- / container -->

  </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
  
@stop
