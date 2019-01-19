<section class="c-hero">
    <div class="backgrounb">
        <img src="{{ config('site.url_static') . $bannerHome->image }}" alt="">
    </div> <!-- / backgrounb -->
    <div class="container">
        <div class="content">
            <h3 class="title">{{ $bannerHome->name }}</h3>
            <div class="summary">{{ $bannerHome->desc }}</div>
        </div> <!-- / content -->
        <div class="button-group">
            <div class="row">
                <div class="col-md-4">
                    <a href="#" class="btn btn-red"><span>Lựa chọn giảng viên <i class="fa fa-arrow-right"></i></span><img
                                src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/icon-01.png" alt=""></a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn btn-blue"><span>Các khóa học HOT <i class="fa fa-arrow-right"></i></span><img
                                src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/icon-02.png" alt=""></a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn btn-white"><span>Tư vấn online <i class="fa fa-arrow-right"></i></span><img src="/vendor/vnedutech-cms/default/hocplus/frontend/src/images/icon-03.png"
                                                                                                                       alt=""></a>
                </div>
            </div>
        </div> <!-- / button group -->
    </div> <!-- / container -->
</section> <!-- / hero -->