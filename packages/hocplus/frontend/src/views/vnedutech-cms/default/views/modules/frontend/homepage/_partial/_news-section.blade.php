<section class="section c-news-section">
    <div class="container">
        <h2 class="headline"><a href="">Tin tức</a></h2>
        <div class="row group">
            @foreach($listNews as $news)
            <figure class="col-12 col-lg-4 c-item-new">
                <div class="inner">
                    <div class="img">
                        <a href="">
                            <img src="{{ config('site.url_static') . $news->image }}" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <h3 class="title"><a href="http://">{{ $news->title }}</a></h3>
                        <div class="summary">
                            {{ $news->desc }}
                        </div>
                    </div>
                    <a class="btn-more" href="">Xem thêm</a>
                </div>
            </figure>
            @endforeach
        </div>
    </div>
</section> <!-- / news section -->