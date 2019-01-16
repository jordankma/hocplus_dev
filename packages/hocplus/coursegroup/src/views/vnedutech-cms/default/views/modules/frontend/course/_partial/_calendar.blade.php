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
                <div class="grid item">
                    <div class="col-grid-2">{{ $element->name }}</div>
                    <div class="col-grid-7">
                        {{-- <div class="title">Văn học trung đại</div> --}}
                        <div class="info">{!! $element->content !!}</div>
                    </div>
                    @if($time_now > $element->date_start)
                    <div class="col-grid-3"><span class="statu statu-cyan">Đã diễn ra</span></div>
                    @elseif() 
                    @else 
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>