<section class="section c-evaluation">
    <div class="container">
        <h2 class="headline">
            <a href="http://">Học sinh nói gì về <span>học plus</span></a>
        </h2>
        <div class="row group">
            @foreach($listNews as $news)
                <figure class="col-12 col-lg-4 c-item-evaluation">
                    <div class="inner">
                        <div class="content">
                            {{ $news->desc }}
                        </div>
                        <div class="info-user">
                            <div class="info">
                                <div class="name">Nguyễn Ngọc Tư</div>
                                <div class="address">Lê Văn Sỹ, P.12, Q.3</div>
                            </div>
                            <div class="avatar">
                                <div class="wrapper">
                                    <img src="{{ $news->image }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            @endforeach
        </div>
    </div>
</section> <!-- / evaluation -->