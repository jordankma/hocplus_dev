<div class="col-12 col-lg-3 main-left">
    <nav class="c-nav-list">
        <div class="title">Danh mục khóa học</div>
        <ul class="list">
            @if(!empty($list_subjects))
            @foreach($list_subjects as $element)
                <li class="list-item">
                    <a href="">
                    @php $key = $loop->index+1 @endphp
                    <img src="{{ config('site.url_static') .  $element->icon }}" alt=""> 
                        <span>{{ $element->name}}</span>
                    </a>
                </li>
            @endforeach
            @endif
        </ul>
    </nav> <!-- / nav list -->

    @include('HOCPLUS-FRONTEND::modules.frontend.course-group._partial._why')

    @include('HOCPLUS-FRONTEND::modules.frontend.course-group._partial._tag')

</div> <!-- / main left -->