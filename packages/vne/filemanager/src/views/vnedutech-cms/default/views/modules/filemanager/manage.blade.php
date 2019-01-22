<!DOCTYPE html>
{{--<html lang="{{ app()->getLocale() }}">--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quản lý file - VNE</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    {{--<link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vne/filemanager/css/file-manager.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="height: 800px;">
            <div id="fm"></div>
        </div>
    </div>
</div>

<!-- File manager -->
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
{{--<script href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vne/filemanager/js/file-manager.js') }}"></script>--}}
<script>
    // Helper function to get parameters from the query string.
    // CKEDITOR.replace('editor-id', {filebrowserImageBrowseUrl: '/file-manager/manage'});
    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);

        return (match && match.length > 1) ? match[1] : null;
    }

    // Add callback to file manager
    fm.$store.commit('fm/setFileCallBack', function (fileUrl) {
      // var funcNum = getUrlParam('CKEditorFuncNum');
        localStorage.setItem('file_select', fileUrl);
      // window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
      window.close();
    });
</script>
</body>
</html>

