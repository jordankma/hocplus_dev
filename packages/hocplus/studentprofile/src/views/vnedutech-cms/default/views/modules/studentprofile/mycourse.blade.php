@extends('HOCPLUS-FRONTEND::layouts.frontend')

@section('title', 'Khóa học của tôi')

@section('content')
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
       rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <main class="main ms-main">

      <div class="container">
        <div class="row">
          
          @include('HOCPLUS-STUDENTPROFILE::modules.studentprofile.include.menu_left')

          <div class="col-12 col-md-8 col-lg-9 ms-right">
            <div class="ms-statistics">
              <section class="row money">
                <div class="col-12 col-lg-4 item">
                  <div class="item-inner">
                    <div class="item-icon" style="background: #2a9fff;">
                      <img src="{{'/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/images/icon/general-1.png'}}" alt="">
                    </div>
                    <div class="item-info">
                      <div class="number" style="color: #2a9fff;"><?php echo count($course);?></div>
                      <div class="name">Khóa đang theo học</div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-4 item">
                  <div class="item-inner">
                    <div class="item-icon" style="background: #ea3e4e;">
                      <img src="{{'/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/images/icon/general-2.png'}}" alt="">
                    </div>
                    <div class="item-info">
                      @if ($deposit->deposit>0)
                        <div class="number" style="color: #ea3e4e;">{{number_format($deposit->deposit)}}<span>đ</span></div>
                      @else
                        <div class="number" style="color: #ea3e4e;">0<span>đ</span></div>
                      @endif
                      <div class="name">Ví tiền hiện có</div>
                    </div>
                  </div>
                </div> <!-- / item -->
                <div class="col-12 col-lg-4 item">
                  <div class="item-inner">
                    <div class="item-icon" style="background: #45b949;">
                      <img src="{{'/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/images/icon/general-3.png'}}" alt="">
                    </div>
                    <div class="item-info">
                      @if ($deposit->deposit_rechange>0)
                        <div class="number" style="color: #45b949">{{number_format($deposit->deposit_rechange)}}<span>đ</span></div>
                      @else
                        <div class="number" style="color: #45b949">0<span>đ</span></div>
                      @endif
                      <div class="name">Số tiền đã nạp</div>
                    </div>
                  </div>
                </div> <!-- / item -->
              </section> <!-- / money -->

              <div class="history">
                <div class="headline">
                  <h3 class="title">Khóa học của tôi</h3>
                </div>
                <form class="form-search" action="" method="post">
                  <div class="form-group">
                    <select class="form-control" name="subject_id">
                      <option selected="true" value=''>Môn học</option>
                      @foreach ($subject as $item)
                      @if (isset($params['subject_id']) && $params['subject_id'] == $item->subject_id)
                        <option selected="true"  value="{{$item->subject_id}}">{{$item->name}}</option>
                      @else
                        <option value="{{$item->subject_id}}">{{$item->name}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input class="form-control date" type="text" id="date_from" name="date_from" placeholder="Từ ngày">
                  </div>
                  <div class="form-group">
                    <input class="form-control date" type="text" id="date_to" name="date_to" placeholder="Đến ngày">
                  </div>
                  <div class="form-group">
                    <select class="form-control" name='status'>
                      <option value='0' selected="true">Tình trạng</option>
                      <option <?php if (isset($params['status']) && $params['status']==1) echo "selected";?> value='1'>Chưa diễn ra</option>
                      <option <?php if (isset($params['status']) && $params['status']==2) echo "selected";?> value='2'>Đang diễn ra</option>
                      <option <?php if (isset($params['status']) && $params['status']==3) echo "selected";?> value='3'>Đã kết thúc</option>
                    </select>
                  </div>
                  <div class="form-group search">
                    <input class="form-control" type="search" id="keyword" name="keyword" placeholder="Từ khóa">
                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                  </div>
                </form>
                <div class="list-course js-list-course">
                  <div class="inner">
                    <div class="grid title">
                      <div class="grid-col col-10">STT</div>
                      <div class="grid-col col-40">Tên khóa học</div>
                      <div class="grid-col col-25">Thời gian</div>
                      <div class="grid-col col-20">Số buổi</div>
                    </div>
                    <div class="group-item">
                      <?php $i=1;?>
                      @foreach ($course as $item)
                      <div class="item">
                        <div class="grid">
                          <div class="grid-col col-10"><?php echo $i++;?></div>
                          <div class="grid-col col-40">{{$item->name}}</div>
                          <div class="grid-col col-25">- Bắt đầu: {{date("d/m/Y",intval($item->date_start))}}<br>
                            - Kết thúc: {{date("d/m/Y",intval($item->date_end))}}</div>
                          <div class="grid-col col-20"><span class="btn-detail">Chi tiết <span class="status"></span></span></div>
                        </div>
                        @if (count($course_arr[$item->course_id])>0)
                        <div class="item-detail">
                          <h4 class="detail-title">{{$item->name}}</h4>
                          <div class="info">
                            <div class="grid info-title">
                              <div class="grid-col col-20">Buổi học</div>
                              <div class="grid-col col-25">Ngày</div>
                            </div>
                            <div class="info-group">
                              @foreach ($course_arr[$item->course_id] as $lesson)
                              <div class="grid item-info">
                                <div class="grid-col col-20">{{$lesson->name}}</div>
                                <div class="grid-col col-25">
                                    <?php 
                                        $time_now = time();
                                        $time_line = $lesson->time_line*60;
                                    ?>                                    
                                  - Bắt đầu: {{date("d/m/Y H:i:s",intval($lesson->date_start))}}<br>
                                  - Kết thúc: {{date("d/m/Y H:i:s",intval($lesson->date_start+$time_line))}}</div>

                                    @if($time_now > $lesson->date_start + $time_line )
                                        <div class="grid-col col-30"><a href="{{$lesson->url}}" class="btn btn-cyan">Học lại</a></div>
                                    @elseif($lesson->date_start <= $time_now &&  $time_now <= $lesson->date_start + $time_line) 
                                        <div class="grid-col col-30"><a href="{{ route('hocplus.course.get.stream', ['course_id' => $item->course_id,'lesson_id' => $lesson->lesson_id]) }}" class="btn btn-blue">Vào học</a></div>    
                                    @else 
                                        <div class="grid-col col-30">
                                            <a href="" class="btn btn-red">Buổi học chưa diễn ra</a>
                                        </div>
                                    @endif                                               
                              </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        @endif
                      </div>
                      @endforeach
                    </div>
                  </div>
                <nav class="c-navigation">
                    <div class="container">
                    {{$course->links()}}
                    </div>
                </nav> <!-- / navigation -->  
                </div>
              </div> <!-- / history -->

            </div> <!-- / statistics -->
          </div> <!-- / col-9 -->
        </div>
      </div> <!-- / container -->
    </main> <!-- / main -->
<script type="text/javascript">

    $('.date').datepicker();  

</script>  
@endsection