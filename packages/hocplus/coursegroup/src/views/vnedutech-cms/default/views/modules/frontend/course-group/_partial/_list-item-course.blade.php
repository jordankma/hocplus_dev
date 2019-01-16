@if(!empty($listCourse))
<section class="row section list-item-course">
        @foreach($listCourse as $course)
        <figure class="col-12 col-md-6 col-lg-4 c-item-course">
            <div class="inner">
                <div class="img">
                    <a href="chi-tiet-khoa-hoc.html">
                        <img src="{{ config('site.url_static') . $course->avartar }}" alt="">
                    </a>
                </div>
                <h3 class="name"><a href="chi-tiet-khoa-hoc.html">{{ $course->name }}</a></h3>
                <div class="info">
                    <div class="info-lecturers">
                        <div class="lecturers">
                            <div class="avatar">
                                <img src="{{ config('site.url_static') . $course->isTeacher->avatar_index }}" alt="">
                            </div>
                            <a class="name-lecturers" href="">{{ $course->isTeacher->name }}</a>
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
                        <div class="subjects">Môn: <span>{{ $course->isSubject->name }}</span></div>
                        <div class="class">Lớp: <span>{{ $course->isClass->name }}</span></div>
                    </div>
                    <div class="registration-time">
                        <a href="" class="btn btn-registration">Đăng ký</a>
                        <span class="time"><i class="fa fa-pencil"></i> {{ count($course->getLesson) }}</span>
                    </div>
                </div>
            </div>
            <div class="tooltip">
                <div class="tooltip-wrappwe">
                    <h3 class="tooltip-name"><a href="chi-tiet-khoa-hoc.html">{{ $course->name }}</a></h3>
                    <div class="tooltip-info">
                        <span class="info-time"><i class="fa fa-play"></i> {{ count($course->getLesson) }}</span>
                        <div class="info-class"><i class="fa fa-folder-open"></i> Lớp {{ $course->isClass->name }}</div>
                    </div>
                    <div class="tooltip-describe">
                        <div class="describe-title">Mô tả:</div>
                        <div class="describe-content">{!! (strlen($course->summary) > 200) ? substr($course->summary, 0, strrpos((substr($course->summary, 0, 250)), ' ')) . '...' : $course->summary !!}</div>
                    </div>
                    <a href="" class="btn btn-registration">Đăng ký</a>
                </div>
            </div>
        </figure>
    @endforeach
</section> <!-- / list item-course -->
<nav class="c-navigation">
    <div class="container">
        {{$listCourse->appends($params)->links()}}
    </div>
</nav> <!-- / navigation -->
@else 
    <p>HIỆN CHƯA CÓ KHÓA HỌC</p>
@endif