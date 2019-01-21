<div class="col-12 col-lg-3 main-left">
    <nav class="c-nav-list">
        <div class="title">Danh mục khóa học</div>
        <ul class="list">
            @if(!empty($list_subjects))
            @foreach($list_subjects as $element)
                <li class="list-item">
                    <a href="{{ route('hocplus.course.list', ['subject_id' => $element->subject_id]) }}">
                        <img src="{{ config('site.url_static') .  $element->icon }}" alt=""><span>{{ $element->name}}</span>
                    </a>
                </li>
            @endforeach
            @endif
        </ul>
    </nav> <!-- / nav list -->

    @include('HOCPLUS-COURSEGROUP::modules.frontend.course-group._partial._why')

    @include('HOCPLUS-COURSEGROUP::modules.frontend.course-group._partial._tag')

</div> <!-- / main left -->