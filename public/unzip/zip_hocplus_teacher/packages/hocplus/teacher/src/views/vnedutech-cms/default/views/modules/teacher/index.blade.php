@extends('HOCPLUS-TEACHER::modules.teacher.master')


@section('menu_left')
          <div class="col-12 col-lg-3 main-left">
            <nav class="c-nav-list">
              <div class="title">Danh mục khóa học</div>
              <ul class="list">
                <li class="list-item"><a href=""><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/icon/list1.png" alt=""> <span>Tất cả khóa học</span></a></li>
                @foreach ($subjects as $subject)
                    <li class="list-item"><a href="/danh-sach-khoa-hoc?subject_id={{$subject->subject_id}}"><img src="{{$subject->icon}}" alt=""> <span>{{$subject->name}}</span></a></li>
                @endforeach
              </ul>
            </nav> <!-- / nav list -->

            <div class="c-left-why">
              <div class="item">
                <div class="icon"><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/icon/icon-08.png" alt=""></div>
                <div class="content">
                  <div class="title">4,500 bài giảng</div>
                  <div class="text">Với rất nhiều phương pháp học tập</div>
                </div>
              </div>
              <div class="item">
                <div class="icon"><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/icon/icon-09.png" alt=""></div>
                <div class="content">
                  <div class="title">Được học với các GV hàng đầu</div>
                  <div class="text">Tìm giảng viên phù hợp với bạn</div>
                </div>
              </div>
              <div class="item">
                <div class="icon"><img src="/vendor/vnedutech-cms/default/hocplus/teacher/images/icon/icon-10.png" alt=""></div>
                <div class="content">
                  <div class="title">Truy cập trọn đời</div>
                  <div class="text">
                    Bạn có thể xem lại bất cứ khi nào muốn</div>
                </div>
              </div>
            </div> <!-- / why -->

            <div class="c-tag">
              <div class="title">Môn học được quan tâm</div>
              <ul class="list">
                <li class="item"><a href="http://">môn toán</a></li>
                <li class="item"><a href="http://">môn văn</a></li>
                <li class="item"><a href="http://">môn địa lý</a></li>
                <li class="item"><a href="http://">môn sinh học</a></li>
                <li class="item"><a href="http://">môn vật lý</a></li>
              </ul>
            </div> <!-- / tag -->

          </div> <!-- / main left -->
@endsection          

@section('content')
          <div class="col-12 col-lg-9 main-right">
            <section class="c-list-lecturers">
              <div class="title">Tất cả thầy cô</div>
              <form class="search" action="/teacher" method="post">
                <div class="inner">
                  <select class="form-control-option" name="sort">
                    <option selected="selected" disabled="disabled" value="">Sắp xếp theo</option>
                    <option value="name" <?php if (isset($params['sort']) && $params['sort'] == 'name') echo "selected";?>>Tên</option>
                    <option value="newest" <?php if (isset($params['sort']) && $params['sort'] == 'newest') echo "selected";?>>Mới nhất</option>
                  </select>
                  <div class="form-group form-group-input">
                    <input name="keyword" class="form-control" type="text" placeholder="Nhập tên thầy cô...">
                  </div>
                  <button class="btn" type="submit">Tìm kiếm</button>
                </div>
              </form>
              <div class="list-lecturers">
                @foreach($teachers as $teacher)
                <figure class="c-item-lecturers-01">
                  <div class="wrapper">
                    <div class="avatar">
                      <a href="/teacher/detail/{{$teacher->teacher_id}}-{{$teacher->alias}}">
                        <img src="{{$teacher->avatar_index}}" alt="">
                      </a>
                    </div>
                    <div class="inner">
                      <h3 class="name">{{$teacher->name}}</h3>
                      <div class="info">
                        <span><i class="fa fa-link"></i> {{$courses[$teacher->teacher_id]}} Khóa học</span>
                        <span><i class="fa fa-pencil"></i> {{$lessons[$teacher->teacher_id]}} Bài giảng</span>
                        <span><i class="fa fa-group"></i> {{$students[$teacher->teacher_id]}} Học viên</span>
                      </div>
                      <div class="subjects"><i>{{$teach_subject[$teacher->teacher_id]}}</i></div>
                      <a class="btn" href=""><i class="fa fa-rss"></i> Quan tâm</a>
                    </div>
                  </div>
                </figure> <!-- / item -->
                @endforeach
              </div>  <!-- / list -->
            </section> <!-- / list lecturers -->
            <nav class="c-navigation">
                <div class="container">
                {{$teachers->appends($params)->links()}}
                </div>
            </nav> <!-- / navigation -->          
          </div> <!-- / main right -->          
 @endsection