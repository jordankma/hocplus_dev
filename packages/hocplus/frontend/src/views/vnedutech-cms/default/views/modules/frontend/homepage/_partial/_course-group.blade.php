<section class="section c-course-group">
    <div class="container">
        <div class="course-group__header">
            <h2 class="headline">
                <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/icon/icon-07.png" alt="">
                <a href="{{ route('hocplus.course.list') }}"><span>Khóa học sắp diễn ra</span></a>
            </h2>
            <div class="filter">
                <div class="form-group">
                    <select class="form-control" id="group-course-filter-classes" onchange="filterCourseComming()">
                        <option value="0" selected="true">Theo lớp</option>
                        @foreach($arrClassesComming as $classes)
                            <option value="{{ $classes['id'] }}">{{ $classes['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" id="group-course-filter-subject" onchange="filterCourseComming()">
                        <option value="0" selected="true">Theo Môn</option>
                        @foreach($arrSubjectComming as $subject)
                            <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="group row" id="boxCourseGroupComming">

            @if (count($listCourseComming) > 0)
                @foreach($listCourseComming as $course)
                    <figure class="col-12 col-md-6 col-lg-3 c-item-course">
                        <div class="inner">
                            <div class="img">
                                <a href="{{ route('hocplus.course.detail',$course->course_id) }}">
                                    <img src="{{ config('site.url_static') . $course->avartar }}" alt="">
                                </a>
                            </div>
                            <h3 class="name"><a href="{{ route('hocplus.course.detail',$course->course_id) }}">{{ $course->name }}</a></h3>
                            <div class="info">
                                <div class="info-lecturers">
                                    <div class="lecturers">
                                        <div class="avatar">
                                            <img src="{{ config('site.url_static') . $course->isTeacher->avatar_index }}" alt="">
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
                                    <div class="subjects">Môn: 
                                        <a href="{{ route('hocplus.course.list', ['subject_id' => $course->isSubject->subject_id])}}"> 
                                            <span>{{ $course->isSubject->name }}</span>
                                        </a>
                                    </div>
                                    <div class="class">Lớp: 
                                        <a href="{{ route('hocplus.course.list', ['classes_id' => $course->isClass->classes_id])}}"> 
                                            <span> {{$course->isClass->name }} </span> 
                                        </a>
                                    </div>
                                </div>
                                <div class="registration-time">
                                    <a href="{{ route("vne.pay.buyCourse",['course_id' => $course->course_id]) }}" class="btn btn-registration">Đăng ký</a>
                                    <span class="time"><i class="fa fa-pencil"></i> {{ count($course->getLesson) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="tooltip">
                            <div class="tooltip-wrappwe">
                                <h3 class="tooltip-name"><a href="{{ route('hocplus.course.detail',$course->course_id) }}">{{ $course->name }}</a></h3>
                                <div class="tooltip-info">
                                    <span class="info-time"><i class="fa fa-play"></i> {{ count($course->getLesson) }}</span>
                                    <div class="info-class"><i class="fa fa-folder-open"></i> 
                                        <a href="{{ route('hocplus.course.list', ['classes_id' => $course->isClass->classes_id])}}"> 
                                            Lớp {{ $course->isClass->name }}
                                        </a>
                                        </div>
                                </div>
                                <div class="tooltip-describe">
                                    <div class="describe-title">Mô tả:</div>
                                    <div class="describe-content">{!! (strlen($course->summary) > 200) ? substr($course->summary, 0, strrpos((substr($course->summary, 0, 250)), ' ')) . '...' : $course->summary !!}</div>
                                </div>
                                <a href="{{ route("vne.pay.buyCourse",['course_id' => $course->course_id]) }}" class="btn btn-registration">Đăng ký</a>
                            </div>
                        </div>
                    </figure>
                @endforeach
            @else
                <h5>Không có khóa học.</h5>
            @endif
        </div>
    </div>
</section> <!-- / course group -->