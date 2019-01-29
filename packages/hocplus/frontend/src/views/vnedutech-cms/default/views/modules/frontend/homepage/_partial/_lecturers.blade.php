<section class="section c-lecturers-group">
    <div class="container">
        <div class="course-group__header">
            <h2 class="headline">
                <a href="">giảng viên <span>VIP</span></a>
            </h2>
            {{--<div class="filter">--}}
                {{--<div class="form-group">--}}
                    {{--<select class="form-control">--}}
                        {{--<option selected="true" disabled="disabled">Theo lớp</option>--}}
                        {{--<option>1</option>--}}
                        {{--<option>2</option>--}}
                        {{--<option>3</option>--}}
                        {{--<option>4</option>--}}
                        {{--<option>5</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<select class="form-control">--}}
                        {{--<option selected="true" disabled="disabled">Theo Môn</option>--}}
                        {{--<option>1</option>--}}
                        {{--<option>2</option>--}}
                        {{--<option>3</option>--}}
                        {{--<option>4</option>--}}
                        {{--<option>5</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="group">
            @foreach($listTeacher as $teacher)
            <figure class="c-item-lecturers">
                <div class="inner">
                    <div class="avatar-certificate">
                        <div class="wrapper">
                            <a href="{{ route('home.teacher.detail',$teacher->teacher_id) }}">
                                <img src="{{ config('site.url_static') . $teacher->avatar_index }}" alt="">
                            </a>
                            <div class="certificate">{{ $teacher->degree }}</div>
                        </div>
                    </div>
                    <h3 class="name"><a href="{{ route('home.teacher.detail',$teacher->teacher_id) }}">{{ $teacher->name }}</a></h3>
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="summary">
                        {{ (strlen($teacher->intro) > 200) ? substr($teacher->intro, 0, strrpos((substr($teacher->intro, 0, 250)), ' ')) . '...' : $teacher->intro }}
                    </div>
                </div>
            </figure>
            @endforeach
        </div>
    </div>
</section> <!-- / lecturers group -->