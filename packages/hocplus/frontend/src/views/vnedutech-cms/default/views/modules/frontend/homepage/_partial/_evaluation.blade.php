<section class="section c-evaluation">
    <div class="container">
        <h2 class="headline">
            <a href="http://">Học sinh nói gì về <span>học plus</span></a>
        </h2>
        <div class="row group">
            @foreach($listEval as $news)
                <figure class="col-12 col-lg-4 c-item-evaluation">
                    <div class="inner">
                        <div class="content">
                            {{ $news->desc }}
                        </div>
                        <div class="info-user">
                            <div class="info">
                                <div class="name">{{ $news->name }}</div>
                                <div class="address">Lê Văn Sỹ, P.12, Q.3</div>
                            </div>
                            <div class="avatar">
                                <div class="wrapper">
                                    <img src="{{ config('site.url_static') . $news->image }}" alt="">
                                    <img src="{{ ($news->image != '' && file_exists(substr($news->image, 1))) ? config('site.url_static') . $news->image : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user_64.png' }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            @endforeach
        </div>
    </div>
</section> <!-- / evaluation -->