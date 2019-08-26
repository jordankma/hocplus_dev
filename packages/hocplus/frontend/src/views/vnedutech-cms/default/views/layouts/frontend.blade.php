<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') | {{ (!empty($SETTING['title'])) ? $SETTING['title'] : 'HOCPLUS' }} @show</title>
    <link rel="icon" href="{{ (!empty($SETTING['favicon'])) ? config('site.url_static') . $SETTING['favicon'] : '' }}" type="image/png" sizes="64x64">
    <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/css/jquery.fancybox.min.css' }}"/>
    <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/css/main.min.css?time=' . time() }}"/>

    <!--page css-->
    @yield('header_styles')
    <style>
        footer ul{
            list-style: none;
            padding-left: 0px;
        }
        footer ul a{
            text-decoration: none;
            color:#fff;
        }
        .title-accept {
            color: #000000ed;
        }
        .title-accept:hover {
            color:#2a9fff;
        }
    </style>
    <!--end of page css-->
</head>

<body>

<div id="app">
    @if(!$agent->isMobile())
    @include('HOCPLUS-FRONTEND::includes._header')
    @endif
    @yield('content')
    @if(!$agent->isMobile())
    @include('HOCPLUS-FRONTEND::includes._footer')
    @endif
    @include('HOCPLUS-FRONTEND::includes._modal')

</div> <!-- / App -->

<!-- js -->

<script type="text/javascript">var resetToken = '{{ $resetToken }}';</script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/js/jquery-3.3.1.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/js/typeahead.bundle.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/js/jquery.fancybox.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/js/slick.min.js' }}"></script>
{{-- <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/js/jquery.multiselect.js' }}"></script> --}}
{{-- <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js' }}"></script> --}}
@yield('footer_scripts')

<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/student/src/js/main.js?time=' . time() }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/script/auth.js?time=' . time() }}"></script>
<script>
    var routeAddWishList = '{{ route('hocplus.course.add.wishlist') }}';
    var routeStudentProfile = '{{ route('hocplus.studentprofile.index') }}';
    var routeMyCourseStudent = '{{ route('hocplus.studentprofile.bang-thong-tin') }}';
    var routeIndex = '{{ route('hocplus.frontend.index') }}';
    var isLogin = '{{ Session::get("isLogin") }}';
    var isLoginCheck = {{ $isLoginCheck }};
    console.log(isLoginCheck);
    if(isLogin == 'false'){
        $('body').addClass('user-anage-active');
    }

    $(document).ready(function () {
        $('body').on('click','.btn-registration',function(e){
            if(isLoginCheck == 0){
                e.preventDefault();
                $('body').addClass('user-anage-active');
                return false;
            }
        });

        //search
        var course = new Bloodhound({
            remote: {
                url: '/search-course?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });
        // Initialize the Bloodhound suggestion engine
        course.initialize();
        var news = new Bloodhound({
            remote: {
                url: '/search-news?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });
        // Initialize the Bloodhound suggestion engine
        news.initialize();
        // Instantiate the Typeahead UI
        $('.c-topbar .search .form input').typeahead({
                highlight: true
            }, {
                data:4,
                name: 'course',
                displayKey: 'name',
                source: course.ttAdapter(),
                templates: {
                    header: '<h3 class="title-course-search">Khóa học</h3>',
                    suggestion: function (data) {
                                    return  '<div class="list-item">'
                                            + '<a class="item-inner" href="' + data.url + '">'
                                            +    '<div class="img">'
                                            +    '<img src="' + data.image + '" alt="">'
                                            +    '</div>'
                                            +    '<div class="content">'
                                            +    '<h4 class="title">' + data.name + '</h4>'
                                            +    '<span class="price">' + data.price + '</span>'
                                            +    '</div>'
                                            + '</a>'
                                            + '</div>';
                                    // return '<a href="' + data.url + '" class="list-group-item"><li>'
                                    // + '<div class="search-img float-left">'
                                    // + '<img src="' + data.image + '" class="img-responsive img-tt-menu"></div>'
                                    // + '<div class="search-text float-left" style="    width: 230px">'
                                    // + '<span>' + data.name + '</span>'
                                    // + '<p><span class="robo-bold color-red">' + data.price + '</span>đ</p>'
                                    // + '</div>'
                                    // + '<div class="clear-both"></div>'
                                    // + '</li></a>';
                                },
                    //footer : '<button class="btn-sm" type="submit">Xem thêm</button>',
                    // footer: Handlebars.compile('<button class="btn-sm" type="submit">Xem thêm</button>'),
                }
            }, {
                data:4,
                name: 'news',
                displayKey: 'name',
                source: news.ttAdapter(),
                templates: {
                    header: '<h3 class="title-course-search">Tin tức</h3>',
                    suggestion: function (data) {
                                    return  '<div class="list-item">'
                                        + '<a class="item-inner" href="' + data.url + '">'
                                        +    '<div class="img">'
                                        +    '<img src="' + data.image + '" alt="">'
                                        +    '</div>'
                                        +    '<div class="content">'
                                        +    '<h4 class="title">' + data.name + '</h4>'
                                        +    '</div>'
                                        + '</a>'
                                        + '</div>';
                                    // return '<a href="' 
                                    // + data.url 
                                    // + '" class="list-group-item">'
                                    // + '<img src="'
                                    // + data.image
                                    // +'" class="img-tt-menu" style="float: left">' 
                                    // + '<span>'+data.name+'</span>'
                                    // + '</a>';
                                },
                    //footer : '<button class="btn-sm" type="submit">Xem thêm</button>',
                    // footer: Handlebars.compile('<button class="btn-sm" type="submit">Xem thêm</button>'),
                }
            }
        );
        //end search
    });
</script>
<!--Start of Tawk.to Script-->
<script type=“text/javascript”>
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement(“script”),s0=document.getElementsByTagName(“script”)[0];
    s1.async=true;
    s1.src=’https://embed.tawk.to/5cb55899d6e05b735b42c37d/default';
    s1.charset=‘UTF-8’;
    s1.setAttribute(‘crossorigin’,‘*’);
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/coursegroup/src/js/wishlist.js' }}"></script>
</body>
</html>