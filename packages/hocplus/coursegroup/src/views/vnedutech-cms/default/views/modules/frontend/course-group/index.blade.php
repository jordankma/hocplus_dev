@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Danh sách khóa học" }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    <main class="main">
        <nav class="c-breadcrumb">
            <div class="container">
                <ol class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Lớp 1</li>
                </ol>
            </div>
        </nav> <!-- / breadcrumb -->

        @include('HOCPLUS-COURSEGROUP::modules.frontend.course-group._partial._c-filter')

        <div class="container container-main">
            <div class="row row-main">

                @include('HOCPLUS-COURSEGROUP::modules.frontend.course-group._partial._course-group')

                <div class="col-12 col-lg-9 main-right">

                    @include('HOCPLUS-COURSEGROUP::modules.frontend.course-group._partial._carousel')

                    @include('HOCPLUS-COURSEGROUP::modules.frontend.course-group._partial._list-item-course')

                </div> <!-- / main right -->

            </div> <!-- / row -->
        </div> <!-- / container -->

    </main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $('body').on('change','#sort',function(){
                console.log('1');
            });
        });
    </script>
@stop
