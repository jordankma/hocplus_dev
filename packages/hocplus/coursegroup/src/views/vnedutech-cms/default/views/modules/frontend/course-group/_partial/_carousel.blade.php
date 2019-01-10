<section class="c-carousel">
    <div class="inner">
        @if(!empty($list_banners))
        @foreach($list_banners as $element)
            <div class="item">
                <div class="img">
                    <a href="{{ $element->link }}">
                        <img src="{{ config('site.url_static') . $element->image }}" alt="">
                    </a>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</section> <!-- / carousel -->