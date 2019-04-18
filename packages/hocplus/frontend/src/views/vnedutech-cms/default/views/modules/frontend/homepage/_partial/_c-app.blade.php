<section class="c-app" style="background-image: url({{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/bg-app.png' }})">
    <div class="container">
        <div class="app-wrapper">
        <h2 class="headline">Tải ứng dụng hocplus</h2>
        <div class="app-inner">
            <div class="app-main">
            <div class="qr">
                <div class="title">Quét mã QR</div>
                <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/qr.png' }}" alt="" style="width: 100px;">
            </div>
            <div class="or"><span>or</span></div>
            <div class="link">
                <div class="link-inner">
                <a href="http://" target="_blank" rel="noopener noreferrer"><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/app-store.png' }}" alt=""></a>
                <a href="http://" target="_blank" rel="noopener noreferrer"><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/google-play.png' }}" alt=""></a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section> <!-- / app -->