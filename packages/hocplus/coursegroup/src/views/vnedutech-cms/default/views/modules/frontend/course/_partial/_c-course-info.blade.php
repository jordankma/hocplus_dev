<div class="c-course-info">
    <div class="price"><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/tag.png" alt=""> <span>
    	{{ number_format($course->price,0,',','.').'đ' }}<small></small></span></div>
    <div class="info">
        <ol>
            <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/book.png" alt="">
                {{ isset($course->isSubject->name) ? $course->isSubject->name : '' }}
            </li>
            <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/book1.png" alt=""> 
                Khối lớp: {{ isset($course->isClass->name) ? $course->isClass->name : '' }}
            </li>
            <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user.png" alt=""> 
                Số buổi: {{ isset($course->getLesson) ? count($course->getLesson) : '0' }} buổi
            </li>
            <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/date.png" alt=""> 
                Thời lượng: {{ $course->time }} tiếng
            </li>
            <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user1.png" alt=""> 
                Số lượng HS tối đa: {{ $course->student_limit }} người
            </li>
            <li><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/user2.png" alt=""> 
                Số lượng HS đã tham gia: {{ $course->student_register }} người
            </li>
        </ol>
    </div>
    @if(!$is_register)
    @if($course->student_register < $course->student_limit)   
    <a class="btn btn-registration" href="{{ route("vne.pay.buyCourse",['course_id' => $course->course_id]) }}">Đăng ký ngay</a>
    @else 
    <a class="btn btn-registration" href="#">Khóa học đã đủ học sinh</a>
    @endif
    @else 

    @endif
</div> <!-- / course info -->