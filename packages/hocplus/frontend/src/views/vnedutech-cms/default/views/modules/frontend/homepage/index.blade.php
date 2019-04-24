@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Hocplus - Trang học trực tuyến uy tín nhất hiện nay" }}@stop

{{-- page level styles --}}
@section('header_styles')
    <style>
        footer ul{
            list-style: none;
            padding-left: 0px;
        }
        footer ul a{
            text-decoration: none;
            color:#fff;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    

    <main class="main">
        @include('HOCPLUS-FRONTEND::includes._hero')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._c-foundation')

        {{-- @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._why') --}}
        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._c-utilities')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._course-run-group')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._course-group')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._lecturers')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._news-section')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._evaluation')

        {{-- @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._library') --}}
        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._c-app')

        @include('HOCPLUS-CONTACT::modules.contact.advice')

    </main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        var resetToken = '{{ $resetToken }}';
        var resetTokenEmail = '{{ $resetTokenEmail }}';
        var routeApigetCourse = '{{ route('hocplus.frontend.api.getCourse') }}';
        var routeApigetCourseRun = '{{ route('hocplus.frontend.api.getCourseRun') }}';
    </script>
    <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/script/homepage.js' }}"></script>
@stop
