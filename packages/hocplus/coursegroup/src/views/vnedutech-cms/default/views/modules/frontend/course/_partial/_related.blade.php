<div class="c-related-courses">
    <h3 class="title">Các khóa học liên quan</h3>
    <ol class="list">
        @if(!empty($list_course_relate))
        @foreach($list_course_relate as $element)
        <li class="item">
            <div class="img">
                <a href="{{ route('hocplus.course.detail',$element->course_id) }}">
                    <img src="
                    {{ $element->avartar != '' ? config('site.url_static') . $element->avartar  : 
                     config('site.url_static') . '/vendor/vnedutech-cms/default/hocplus/frontend/src/images/c7.png' }}
                    " alt="">
                </a>
            </div>
            <div class="inner">
            <h4 class="title">
                <a href="{{ route('hocplus.course.detail',$element->course_id) }}">{{ $element->name }}</a> 
            </h4>
                <div class="price">
                    <img src="{{ config('site.url_static') . '/vendor/vnedutech-cms/default/hocplus/frontend/src/images/tag.png' }}" alt=""> 
                    <span>{{ $element->price }}<small> đ</small></span>
                </div>
            </div>
        </li>
        @endforeach
        @else 
            <p>Khóa học hiện không có khóa học liên quan</p>
        @endif
    </ol>
</div> <!-- / related courses -->