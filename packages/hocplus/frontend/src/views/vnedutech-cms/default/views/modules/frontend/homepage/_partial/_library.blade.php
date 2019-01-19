<section class="section c-library">
    <div class="container">
        <h2 class="headline"><a href="">Thư viện <span>Ảnh, Video</span></a></h2>
        <div class="carousel">
            <div class="inner">
                @foreach($libHome as $item)
                    <div class="item">
                        <div class="img">
                            <a data-fancybox="gallery-library" href="{{ config('site.url_static') . $item->image }}">
                                <img src="{{ config('site.url_static') . $item->image }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> <!-- / library -->