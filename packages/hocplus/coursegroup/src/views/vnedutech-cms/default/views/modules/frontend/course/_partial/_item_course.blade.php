<figure class="{{ isset($figure_class) ? $figure_class : 'col-12 col-md-6 col-lg-4 c-item-course' }}">
    <div class="inner">
        <div class="img">
            <a href="{{ route('hocplus.course.detail',$course->course_id) }}">
                <img src="{{ ($course->avartar != '' && file_exists(substr($course->avartar, 1))) ? config('site.url_static') . $course->avartar : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/course.jpg' }}" alt="">
            </a>
        </div>
        <h3 class="name"><a href="{{ route('hocplus.course.detail',$course->course_id) }}">{{ $course->name }}</a></h3>
        <div class="info">
            <div class="info-lecturers">
                <div class="lecturers">
                    <div class="avatar">
                            {{-- file_exists(substr($course->isTeacher->avatar_index, 1))) --}}
                        <img src="{{ ($course->isTeacher->avatar_index != '' || file_exists(substr($course->isTeacher->avatar_index, 1)))  ? config('site.url_static') . $course->isTeacher->avatar_index : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user.png' }}" alt="">
                    </div>
                    <a class="name-lecturers" href="{{ route('home.teacher.detail',$course->isTeacher->teacher_id . '-' . $course->isTeacher->alias) }}">{{ $course->isTeacher->name }}</a>
                </div>
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
            <div class="subjects-class">
                <a href="{{ route('hocplus.course.list', ['subject_id' => isset($course->isSubject->subject_id) ? $course->isSubject->subject_id : '']) }}">
                    <div class="subjects"><span>{{ isset($course->isSubject->name) ? $course->isSubject->name : '' }}</span></div>
                </a>
                <a href="{{ route('hocplus.course.list', ['classes_id' => $course->isClass->classes_id])}}">
                    <div class="class"><span>{{ $course->isClass->name }}</span></div>
                </a>
            </div>
            <div class="registration-time">
                @if( !in_array($course->course_id, $list_course_buy) && $is_vip == 0)
                <a href="{{ route("vne.pay.buyCourse",['course_id' => $course->course_id]) }}" class="btn btn-registration">Đăng ký</a>
                {{-- <span class="time"><i class="fa fa-pencil"></i> {{ count($course->getLesson) }}</span> --}}
                <span class="price"></i> {{ number_format($course->price,0,',','.') }}<span>đ</span></span>
                @else 
                <a href="{{ route('hocplus.studentprofile.bang-thong-tin') }}" class="btn btn-manage">Quản lý khóa học</a>
                <span class="price">Đã mua</span>
                @endif
            </div>
        </div>
    </div>
    <div class="tooltip">
        <div class="tooltip-wrappwe">
            <h3 class="tooltip-name">
                <a href="{{ route('hocplus.course.detail',$course->course_id) }}">{{ $course->name }}</a>
                <i class="add-wishlist fa fa-heart @if(in_array($course->course_id, $list_course_wishlist)) active @endif" data-course-id="{{ $course->course_id }}"></i>
            </h3>
            <div class="tooltip-info">
                <span class="info-time"><i class="fa fa-play"></i> {{ count($course->getLesson) }} buổi học  </span>
                <div class="info-class"><i class="fa fa-folder-open"></i>
                <a href="{{ route('hocplus.course.list', ['classes_id' => $course->isClass->classes_id])}}">
                     {{ $course->isClass->name . ','}}
                </a>
                </div>
            </div>
            <div class="tooltip-describe">
                <div class="describe-title">Mô tả:</div>
                <div class="describe-content">{!! (strlen($course->summary) > 200) ? substr($course->summary, 0, strrpos((substr($course->summary, 0, 250)), ' ')) . '...' : $course->summary !!}</div>
            </div>
            @if( !in_array($course->course_id, $list_course_buy) && $is_vip == 0)
            <a href="{{ route("vne.pay.buyCourse",['course_id' => $course->course_id]) }}" class="btn btn-registration">Đăng ký</a>
            @else 
            <span class="price">Đã mua</span>
            @endif
        </div>
    </div>
</figure>