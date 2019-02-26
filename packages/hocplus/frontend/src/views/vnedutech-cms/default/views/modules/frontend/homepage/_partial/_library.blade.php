<section class="section c-library">
    <div class="container">
        <h2 class="headline"><a href="">Thư viện <span>Ảnh, Video</span></a></h2>
        <div class="carousel">
            <div class="inner">
                @foreach($libHome as $item)
                    <div class="item">
                        <div class="img">
                            <a data-fancybox="gallery-library" href="{{ ($item->image != '' && file_exists(substr($item->image, 1))) ? config('site.url_static') . $item->image : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/course.jpg' }}">
                                {{--<img src="{{ config('site.url_static') . $item->image }}" alt="">--}}
                                <img src="{{ ($item->image != '' && file_exists(substr($item->image, 1))) ? config('site.url_static') . $item->image : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/course.jpg' }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> <!-- / library -->