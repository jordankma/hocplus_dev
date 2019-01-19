<section class="section c-why">
    <div class="container">
        <div class="wrapper">
            <ul class="list">

                @foreach($whyHome as $item)
                <li class="item">
                    <div class="icon">
                        <img src="{{ config('site.url_static') . $item->image }}" alt="">
                    </div>
                    <div class="content">
                        <h3 class="title">{{ $item->name }}</h3>
                        <div class="info">{{ $item->desc }}</div>
                    </div>
                </li>
                @endforeach
            </ul> <!-- / list -->
            <div class="device">
                <div class="item ipad">
                    <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/ipad.png" alt="">
                </div>
                <div class="item pc video">
                    <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/pc.png" alt="">
                    <a class="btn-video" data-fancybox="gallery-why" href="https://youtu.be/m3i5LKUTAj4"></a>
                </div>
                <div class="item iphone">
                    <img src="/vendor/vnedutech-cms/default/hocplus/frontend/images/iphone.png" alt="">
                </div>
            </div> <!-- / video -->
        </div> <!-- / wrapper -->
    </div> <!-- / container -->
</section> <!-- / why -->

@if($ads1Home)
<section class="section main-adv">
    <img src="{{ config('site.url_static') . $ads1Home->image }}" width="100%" height="auto" alt="">
</section> <!-- / adv -->
@endif