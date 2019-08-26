@extends('layouts.default')

{{-- Page title --}}
@section('title'){{ $title = 'Sửa khóa học' }}@stop

{{-- page styles --}}
@section('header_styles')
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/css/bootstrap-switch.css' }}" rel="stylesheet" type="text/css"/>
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/css/pages/blog.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vne/coursetemplate/css/coursetemplate.css' }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/vnedutech-cms/default/vendors/iCheck/css/all.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/vnedutech-cms/default/vendors/awesomeBootstrapCheckbox/awesome-bootstrap-checkbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/vnedutech-cms/default/pages/css/radio_checkbox.css')}}">
<link href="{{asset('vendor/vnedutech-cms/default/vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" media="screen" />
<link href="{{asset('vendor/vnedutech-cms/default/pages/css/editor.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendor/vnedutech-cms/default/vendors/daterangepicker/css/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendor/vnedutech-cms/default/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">

<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/css/default.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/css/default.date.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/css/default.time.css' }}" rel="stylesheet" type="text/css">
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/flatpickrCalendar/css/flatpickr.min.css' }}" rel="stylesheet" type="text/css" />
<link href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/airDatepicker/css/datepicker.min.css' }}" rel="stylesheet" type="text/css" />

@stop
<!--end of page css-->


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('vne.coursetemplate.manage') }}">
                <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                {{ trans('adtech-core::labels.home') }}
            </a>
        </li>
        <li class="active"><a href="#">{{ $title }}</a></li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    
    <div class="row">
        <div class="the-box no-border">
            
            <div class="bs-example">
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">

                    <li class="active ">
                        <a href="#course" data-toggle="tab" id="tab_course">Thông tin khóa học</a>
                    </li>
                    <li>
                        <a href="#lesson" data-toggle="tab" id="tab_lesson">Thông tin buổi học</a>
                    </li>

                </ul>
                 <div id="courseContent" class="tab-content">
                    <div class="tab-pane fade active in " id="course">
                        @include('VNE-COURSE::modules.course._edit_info_course', ['course' => $course])
                    </div>
                    <div class="tab-pane fade  " id="lesson">
                        @include('VNE-COURSE::modules.course._edit_lesson_course', ['course' => $course])
                    </div>
                </div>
             </div>
            
                            
        </div>
    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page js -->
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrap-switch/js/bootstrap-switch.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}" type="text/javascript" ></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/ckeditor/js/config.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/vnedutech-cms/default/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/vendor/' . $group_name . '/' . $skin .'/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>

<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/js/picker.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/js/picker.date.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/pickadate/js/picker.time.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/airDatepicker/js/datepicker.min.js' }}" type="text/javascript"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/airDatepicker/js/datepicker.en.js' }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/flatpickrCalendar/js/flatpickr.min.js' }}"></script>

<!--end of page js-->
<script>
// var domain = "/admin/laravel-filemanager/";
// $('#lfm').filemanager('image', {prefix: domain});
flatpickr("#discount_exp", {  dateFormat: 'Y-m-d' });

var check_in = flatpickr("#date_start", {  dateFormat: 'Y-m-d' });
var check_out = flatpickr("#date_end", {  dateFormat: 'Y-m-d' });

$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%'
});
$('textarea#summary').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]

});
$('textarea#will_learn').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]

});
$('textarea#target').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]

});
$('textarea#request').ckeditor({
    height: '150px',
    toolbar: [
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        '',
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
        '',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        //{name: 'insert', items: [ 'Image' ] },
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    ]
});

$('#form-add-template-course').bootstrapValidator({
    feedbackIcons: {
        // validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        price: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        student_limit: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        time: {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
         date_start: {
            validators: {
                notEmpty: {
                    message: ' '
                },
                datetime: {
                    max: 'date_end'
                }
            }
        },
        date_end: {
            validators: {
                notEmpty: {
                    message: ' '
                },
                datetime: {
                    min: 'date_start'
                }
            }
        },
        avartar: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        'classes[]': {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        
        teacher: {
            trigger: 'change keyup',
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
    }
}).on('status.field.bv', function (e, data) {
    data.bv.disableSubmitButtons(false);
});

$('#surveyForm').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        'name[]': {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        'date_start[]': {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        'content[]': {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        'ordinal[]': {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        },
        'time_line[]': {
            validators: {
                notEmpty: {
                    message: ' '
                }
            }
        }
         
    }
})
.on('status.field.bv', function (e, data) {
    data.bv.disableSubmitButtons(false);
});

$('#classes').multiselect({
    buttonWidth: '100%',
    nonSelectedText: 'Chọn lớp',
    enableFiltering: true,
});

flatpickr(".lesson_date_start", { minDate: new Date(), dateFormat: 'd-m-Y'});

$('body').on('change', '#teacher', function () {
    let teacher_id = $(this).val();
    $.ajax({
        url: "/admin/vne/coursetemplate/find-class-subject",
        type: 'GET',
        cache: false,
        data: {
            teacher_id: teacher_id,
            type: 'edit'
        },
        success: function (response) {
            if (response.status == true) {
                $("#select_class_subject").html(response.html);
                $('#classes').multiselect({
                    buttonWidth: '100%',
                    nonSelectedText: 'Chọn lớp',
                    enableFiltering: true,
                });
                
            } else {
                alert(response.msg);
            }
        }
    }, 'json');
});

$('body').on('click', '.btn-save', function(e){    
    let class_subject = $("#classes").val();    
    if(class_subject == null || class_subject == ''){
        alert("Bạn chưa chọn lớp");
        e.preventDefault();
    }        
});
(function ($) {

$.fn.filemanager = function (type, options) {
    type = type || 'file';
    var parent = this;
    this.on('click', function (e) {
        if( $(parent).attr('data-choice') === 'files'){
            type = 'file';
            $("#isIcon").val(1);
        }
        if( $(parent).attr('data-choice') === 'icon'){
            $("#isIcon").val(2);
        }
        var route_prefix = (options && options.prefix) ? options.prefix : '/file-manager/manage';
        localStorage.setItem('target_input', $(this).data('input'));
        localStorage.setItem('target_preview', $(this).data('preview'));
        window.open(route_prefix + '?type=' + type , 'FileManager', 'width=900,height=600');
        if ($("#mutil").val() === 'remove' && $(parent).attr('data-choice') === 'files') {
            return true;
        } else {
            window.SetUrl = function (url, file_path) {
                console.log(url);
                //set the value of the desired input to image url
                var target_input = $('#' + localStorage.getItem('target_input'));
                target_input.val(file_path).trigger('change');

                //set or change the preview image src
                var target_preview = $('#' + localStorage.getItem('target_preview'));
                target_preview.attr('src', url).trigger('change');
            };
            return false;

        }
    });
}

})(jQuery);
$(window).bind('storage', function (e) {
if(e.originalEvent.key == 'select_event'){
    var preview_url = '{{ @$preview_url }}';
    var target_input =   localStorage.getItem('target_input');
    var target_preview =   localStorage.getItem('target_preview');
    var file_select = localStorage.getItem('file_select');
    $('#' + target_input).val('/files/' + file_select);
    $('#' + target_preview).attr("src",preview_url + '/files/' + file_select);
}
});
$('#lfm').filemanager();
// $('#lfm2').filemanager();
</script>
@stop
