<section class="section c-news-section">
    <div class="container">
        <h2 class="headline"><a href="{{ route('hocplus.news.index') }}">Tin tức</a></h2>
        <div class="row group">
            @foreach($listNews as $news)
            <figure class="col-12 col-lg-4 c-item-new">
                <div class="inner">
                    <div class="img">
                        <a href="{{ route('hocplus.news.detail', $news->news_id . '-' . $news->title_alias ) }}">
                            {{--<img src="{{ config('site.url_static') . $news->image }}" alt="">--}}
                            <img src="{{ ($news->image != '' || file_exists(substr($news->image, 1))) ? config('site.url_static') . $news->image : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/course.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <h3 class="title"><a href="{{ route('hocplus.news.detail', $news->news_id . '-' . $news->title_alias) }}">{{ $news->title }}</a></h3>
                        <div class="summary">
                            {{ $news->desc }}
                        </div>
                    </div>
                    <a class="btn-more" href="{{ route('hocplus.news.index') }}">Xem thêm</a>
                </div>
            </figure>
            @endforeach
        </div>
    </div>
</section> <!-- / news section -->