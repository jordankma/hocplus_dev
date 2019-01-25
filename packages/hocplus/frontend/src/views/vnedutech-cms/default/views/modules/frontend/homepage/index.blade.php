@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Homepage" }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    @include('HOCPLUS-FRONTEND::includes._hero')

    <main class="main">

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._why')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._course-run-group')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._course-group')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._lecturers')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._news-section')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._evaluation')

        @include('HOCPLUS-FRONTEND::modules.frontend.homepage._partial._library')

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
