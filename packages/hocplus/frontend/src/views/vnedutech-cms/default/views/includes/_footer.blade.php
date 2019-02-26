<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-2 block">
                <img src="{{ '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/logo-footer.png' }}" alt="">
            </div>
            <div class="col-12 col-lg-3 block">
                <div class="content">
                    {!! (isset($SETTING['info_footer_1'])) ? $SETTING['info_footer_1'] : '' !!}
                </div>
            </div>
            <div class="col-12 col-lg-4 block">
                <div class="content">
                    {!! (isset($SETTING['info_footer_2'])) ? $SETTING['info_footer_2'] : '' !!}
                </div>
            </div>
            <div class="col-12 col-lg-3 block">
                {!! (isset($SETTING['info_footer_3'])) ? $SETTING['info_footer_3'] : '' !!}
            </div>
            <div class="col-12 block">
                <div class="block-images">
                    <img src="{{ '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/bocongthuong.png' }}" alt="">
                    <img src="{{ '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/DMCA.jpg' }}" alt="">
                </div>
            </div>
        </div>
    </div>
</footer> <!-- / footer -->