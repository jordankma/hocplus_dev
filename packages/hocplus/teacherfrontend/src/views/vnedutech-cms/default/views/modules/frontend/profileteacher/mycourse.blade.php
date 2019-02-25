@extends('HOCPLUS-TEACHERFRONTEND::layouts.frontend')

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
          @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial.profileteacher._ml-info')
      </div> <!-- / col-3 -->
      <div class="col-12 col-md-8 col-lg-9 ml-right">
        <section class="ml-list js-ml-list">
          <div class="headline">
            <h2 class="title">Khóa học của tôi</h2>
            <a href="{{ route('hocplus.frontend.create-course.step1') }}" class="btn">Khởi tạo khóa học</a>
          </div>
          {{-- <div class="list">
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
                  @if(!empty($courses))
                  @foreach($courses as $element)
                  <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>
                      <div class="title"><a href="{{ route('hocplus.course.detail',$element->course_id) }}">{{ $element->name }}</a></div>
                    </td>
                    <td>
                      <div class="price">{{ $element->price }}<span>đ</span></div>
                    </td>
                    <td>
                      <div class="number">Sỹ số tối đa: {{ $element->student_limit }}<br>Sỹ số thực tế: {{ $element->student_register }}</div>
                    </td>
                    <td>
                      <div class="action">
                        <div class="edit">
                          <i class="fa fa-gear"></i>
                          <i class="fa fa-arrow-right"></i>
                          <ul class="list">
                            <li><a href="" class="edit-course" data-course-id="{{ $element->course_id }}"><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                            <li><a class="btn-delete js-btn-delete" href="" data-course-id="{{ $element->course_id }}"><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                          </ul>
                        </div>
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
            <nav class="c-navigation">
              <div class="container"> 
              </div>
            </nav> <!-- / navigation -->
          </div> --}}
          <div class="list-course js-list-course">
            <div class="inner">
              <div class="grid title">
                <div class="grid-col col-07">STT</div>
                <div class="grid-col col-30">Tên khóa học</div>
                <div class="grid-col col-15">Giá</div>
                <div class="grid-col col-20">Sỹ số</div>
                <div class="grid-col col-13">Số buổi</div>
                <div class="grid-col col-15">Action</div>
              </div>
              <div class="group-item">
                @if(!empty($courses))
                @foreach($courses as $element)
                <div class="item">
                  <div class="grid">
                  <div class="grid-col col-07"> {{ $loop->index+1 }}</div>
                    <div class="grid-col col-30">
                      <div class="name"><a href="#">{{ $element->name }}</a></div>
                    </div>
                    <div class="grid-col col-15">
                      <div class="price">{{ $element->price }}<span>đ</span></div>
                    </div>
                    <div class="grid-col col-20">Sỹ số tối đa: {{ $element->student_limit }}<br>Sỹ số thực tế: {{ $element->student_register }}</div>
                    <div class="grid-col col-13"><span class="btn-detail">Chi tiết <span class="status"></span></span></div>
                    <div class="grid-col col-15">
                      <div class="action">
                        <div class="edit">
                          <i class="fa fa-gear"></i>
                          <i class="fa fa-arrow-right"></i>
                          <ul class="list">
                            <li><a href=""><i class="fa fa-pencil"></i><span>Sửa</span></a></li>
                            <li><a class="btn-delete js-btn-delete" href=""><i class="fa fa-trash"></i><span>Xóa</span></a></li>
                          </ul>
                        </div>
                        {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                      </div>
                    </div>
                  </div>
                  <div class="item-detail">
                    <h4 class="detail-title">{{ $element->name }}</h4>
                    <div class="info">
                      <div class="grid info-title">
                        <div class="grid-col col-20">Buổi học</div>
                        <div class="grid-col col-25">Ngày</div>
                      </div>
                      <div class="info-group">
                        @if(!empty($element->getLesson))
                        @foreach($element->getLesson as $element2)
                        <div class="grid item-info">
                          <div class="grid-col col-20">{{ $element2->name }}</div>
                          @php 
                            // $epoch1 = $element2->date_start != 'null' ? $element2->date_start : 0;
                            // $date_start = new DateTime("@$epoch1");
                            // $epoch2 = $element2->date_end != 'null' ? $element2->date_end : 0;
                            // $date_end = new DateTime("@$epoch2");
                            $time_now = time();
                            $time_line = $element2->time_line != 'null' ? $element2->time_line : 0;
                            $date_start = (int) $element2->date_start;
                            $date_end = $date_start + $time_line * 60;
                          @endphp
                          <div class="grid-col col-25"><b>{{ date('d-m-Y', $date_start) }}</b><br>
                            - Bắt đầu: {{ date('H:i', $date_start) }}<br>
                            {{-- - Kết thúc: {{ $date_end->format('H:i') }} --}}
                          </div>
                            @if($date_start > $time_now)
                              <div class="grid-col col-30"><a href="" class="btn btn-red">Buổi học chưa diễn ra</a></div>
                            @elseif($date_end < $time_now)
                              <div class="grid-col col-30"><a href="" class="btn btn-cyan">Buổi học kết thúc</a></div>
                            @else
                              <div class="grid-col col-30"><a href="{{ route('hocplus.get.stream.teacher',['lesson_id' => $element2->lesson_id ,'course_id' => $element->course_id ,]) }}" class="btn btn-blue">Vào dạy</a></div>
                            @endif
                        </div>
                        @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
              </div>

              <nav class="c-navigation">
                <div class="container">
                  {{ $courses->links() }}
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
                  @if(!empty($courses_end))
                  @foreach($courses_end as $element)
                  <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>
                      <div class="title">{{ $element->name }}</div>
                    </td>
                    <td>
                      <div class="price">{{ $element->price }}<span>đ</span></div>
                    </td>
                    <td>
                      <div class="number number-student">{{ $element->student_register }}</div>
                    </td>
                    <td>
                      <div class="date">
                        @php 
                          $epoch = $element->date_end;
                          $dt = new DateTime("@$epoch");
                          echo $dt->format('d-m-Y');
                        @endphp
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @else
                    <p>Hiện chưa có khóa học đang diễn ra</p>
                  @endif
                </tbody>
              </table>
            </div>
            <nav class="c-navigation">
              <div class="container">
                {{ $courses_end->links() }}  
              </div>
            </nav> <!-- / navigation -->
          </div>
        </section>
      </div> <!-- / col-9 -->

    </div>

  </div> <!-- / container -->

</main> <!-- / main -->
<!-- Thông báo xóa 1 khóa học -->
<div class="notification-delete">
  <div class="content">Bạn có Đồng ý xóa khóa học không?</div>
  <div class="btn-group">
    <button class="btn btn-yes">Đồng ý</button>
    <button class="btn btn-no">Hủy</button>
  </div>
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
