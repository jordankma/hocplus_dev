@extends('HOCPLUS-TEACHERFRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Quản lý tài liệu' }}@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('/vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
    <main class="main ml-main">

        <div class="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-3 ml-left">
                    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial.profileteacher._ml-info')
                </div> <!-- / col-3 -->

                <div class="col-12 col-md-8 col-lg-9 ml-right">
                    <div id="fm"></div>
                </div> <!-- / col-9 -->

            </div>

        </div> <!-- / container -->

    </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('vendor/file-manager/js/teacher-manager.js') }}"></script>
    <script>
        // Add callback to file manager
        fm.$store.commit('fm/setFileCallBack', function (fileUrl) {
            // var funcNum = getUrlParam('CKEditorFuncNum');
            localStorage.setItem('file_select', fileUrl);
            // window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
            window.close();
        });
    </script>
@stop
