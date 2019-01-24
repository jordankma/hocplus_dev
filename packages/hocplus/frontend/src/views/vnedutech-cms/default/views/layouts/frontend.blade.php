<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') | {{ (!empty($SETTING['title'])) ? $SETTING['title'] : 'HOCPLUS' }} @show</title>

    <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/css/jquery.fancybox.min.css' }}"/>
    <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/css/main.min.css' }}"/>

    <!--page css-->
    @yield('header_styles')
    <!--end of page css-->
</head>

<body>

<div id="app">

    @include('HOCPLUS-FRONTEND::includes._header')

    @yield('content')

    @include('HOCPLUS-FRONTEND::includes._footer')

    @include('HOCPLUS-FRONTEND::includes._modal')

</div> <!-- / App -->

<!-- js -->

<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/js/jquery-3.3.1.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/js/jquery.fancybox.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/js/slick.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/js/jquery.multiselect.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/src/js/main.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/script/auth.js' }}"></script>

@yield('footer_scripts')

</body>

</html>