<div class="calendar">
        <div class="title">Nội dung khóa học:</div>
        <div class="inner">
            <div class="grid top">
                <div class="col-grid-2">Lịch học</div>
                <div class="col-grid-7">Thời gian biểu</div>
                <div class="col-grid-3">Vào lớp</div>
            </div>
            <div class="list">
                @if(!empty($course->getLesson))
                @php $time_now = time(); @endphp
                @foreach($course->getLesson as $element)
                @php 
                    $time_line = $element->time_line*60;
                @endphp
                <div class="grid item">
                    <div class="col-grid-2">{{ $element->name }}</div>
                    <div class="col-grid-7">
                        {{-- <div class="title">Văn học trung đại</div> --}}
                        <div class="info">{!! $element->content !!}</div>
                    </div>
                    @if($time_now > $element->date_start + $time_line )
                        <div class="col-grid-3"><span class="statu statu-cyan" data-lesson-id="{{ $element->lesson_id }}" data-course-id={{ $course->course_id }}>Đã diễn ra</span></div>
                    @elseif($element->date_start <= $time_now &&  $time_now <= $element->date_start + $time_line) 

                        <div class="col-grid-3"><span class="statu statu-blue" data-lesson-id="{{ $element->lesson_id }}" data-course-id={{ $course->course_id }}>Đang diễn ra</span></div>    
                    @else 
                        <div class="col-grid-3">
                            <p><span class="statu statu-red" data-lesson-id="{{ $element->lesson_id }}" data-course-id={{ $course->course_id }}>Sắp diễn ra</span></p>
                            <p>Buổi học sẽ diễn ra sau<br>
                            <b style="color: #d2232f;">{{ floor(($element->date_start - $time_now)/60) .' giờ ' . ($element->date_start - $time_now)%60 . ' phút'  }}</b></p>
                        </div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>