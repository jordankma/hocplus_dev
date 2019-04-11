<section class="section c-utilities">
        <div class="container">
            <h2 class="headline">tiện ích HocPlus</h2>
            <div class="utilities-main">
            <div class="video">
                <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/pc.png' }}" alt="">
                <a class="btn-video" data-fancybox="gallery-why" href="https://youtu.be/P3emCM9brxg"></a>
            </div> <!-- / video -->
            <ul class="group-item">
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
            </div> <!-- / wrapper -->
        </div> <!-- / container -->
</section> <!-- / utilities -->
@if($ads1Home)
<section class="section main-adv">
    <img src="{{ config('site.url_static') . $ads1Home->image }}" width="100%" height="auto" alt="">
</section> <!-- / adv -->
@endif