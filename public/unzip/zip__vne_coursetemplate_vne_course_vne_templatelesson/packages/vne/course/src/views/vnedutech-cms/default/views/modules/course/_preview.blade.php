<form class="form-horizontal"  id="form-add-review-course">
    <input type="hidden" id="course_template_id" name="course_template_id" value="{{$courseTemplate->course_template_id}}" >
    <fieldset>
        <!-- Name input-->
        <div class="col-md-8">
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Tên khóa học</label>             
                <div class="col-md-8">                    
                    <input id="template_name" name="template_name" type="text" value="{{old('template_name', isset($courseTemplate) ? $courseTemplate->template_name : '')}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Ảnh đại diện</label>
                <div class="col-md-8 input-group" style="padding-left:15px;">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Chọn ảnh
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="template_avatar" value="{{old('template_avatar', isset($courseTemplate) ? $courseTemplate->template_avatar : '')}}" style="width: 250px;">
                </div>
            </div>
            <div class="form-group" style="display: flex;">
                <label class="col-md-3 control-label" for="name"></label>
                <img id="holder" src="{{$courseTemplate->template_avatar}}" style="margin-top:15px;max-height:100px; margin-left: 15px; display: block;">
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Video giới thiệu</label>
                <div class="col-md-8">
                    <input id="template_video_intro" name="template_video_intro" type="text" value="{{old('template_video_intro', isset($courseTemplate) ? $courseTemplate->template_video_intro : '')}}" class="form-control"></div>
            </div>                        

        </div>
        <div class="col-md-4">
            <!-- Message body -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Giáo viên</label>
                <div class="col-md-8">
                    <select class="form-control" name="teacher" id="teacher">
                        <option value="">Chọn</option>
                        @if(!empty($teachers))                                       
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher['teacher_id']}}" @if($teacher['teacher_id'] == $courseTemplate->teacher_id) selected @endif>{{$teacher['name']}}</option>
                            @endforeach                                        
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Lớp - Môn</label>
                <div class="col-md-8" id='select_class_subject'>
                   <select id="classes" name="classes[]" class="form-control"  >                                                                       
                        @if(!empty($data))
                            @foreach($data as $c => $class)
                                <optgroup label="{{ $class['name'] }}">
                                    @if(!empty($class['subject']))
                                        @foreach($class['subject'] as $s => $subject)
                                            <option value="{{$c . '-' . $s}}" @if($c == $courseTemplate->classes_id  && $s == $courseTemplate->subject_id) selected @endif>{{ $subject['name'] }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            @endforeach
                        @endif                                                                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Nổi bật</label>
                <div class="col-md-8">
                    <label style="margin-right: 10px; cursor: pointer;">
                        <input type="radio" name="is_hot" value="1" class="square" @if($courseTemplate->is_hot == 1) checked @endif /> Có
                    </label>

                    <label style="margin-right: 10px; cursor: pointer;">
                        <input type="radio" name="is_hot" value="0" class="square" @if($courseTemplate->is_hot == 0) checked @endif /> Không                                    
                    </label>                               
                </div>
            </div>
            @if($courseTemplate->template_video_intro)
            <div class="form-group">               
                <div class="col-md-12">
                    <iframe width="auto" height="auto" src="https://www.youtube.com/embed/tgbNymZ7vqY" style="border: none;"></iframe>                    
                </div>
            </div>
            @endif
            
        </div>
                        
        <hr style="width: 900px;">
         <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">                        
                        Nội dung template
                    </h3>                    
                </div>
             <div class="panel-body">
                  <div class="bs-example">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">

                        <li class="active">
                            <a href="#tab_summary" data-toggle="tab">Mô tả</a>
                        </li>
                        <li>
                            <a href="#tab_content" data-toggle="tab">Nội dung khóa học</a>
                        </li>
                        <li>
                            <a href="#tab_target" data-toggle="tab">Mục tiêu khóa học</a>
                        </li>
                        <li>
                            <a href="#tab_request_content" data-toggle="tab">Yêu cầu khóa học</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">                
                        <div class="tab-pane fade active in " id="tab_summary">
                           <div class="form-group">                        
                                <div class="col-md-12">
                                    <textarea class="form-control resize_vertical" id="summary" name="summary" placeholder="Nhập nội mô tả..." rows="5">
                                                    {{old('summary', isset($courseTemplate) ? $courseTemplate->summary : '')}}
                                    </textarea>
                                </div>
                            </div>
                        </div> 
                        <div class="tab-pane fade  " id="tab_content">
                           <div class="form-group">                        
                                <div class="col-md-12">
                                    <textarea class="form-control resize_vertical" id="will_learn" name="will_learn" placeholder="Nhập nội dung khóa học..." rows="5">
                                                    {{old('will_learn', isset($courseTemplate) ? $courseTemplate->will_learn : '')}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab_target">
                           <div class="form-group">                        
                                <div class="col-md-12">
                                    <textarea class="form-control resize_vertical" id="target" name="target" placeholder="Nhập mục tiêu khóa học..." rows="5">
                                       {{old('request_content', isset($courseTemplate) ? $courseTemplate->target : '')}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  " id="tab_request_content">
                           <div class="form-group">                        
                                <div class="col-md-12">
                                    <textarea class="form-control resize_vertical" id="request" name="request_content" placeholder="Nhập yêu cầu khóa học..." rows="5">
                                                    {{old('request_content', isset($courseTemplate) ? $courseTemplate->request_content : '')}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
         </div>
       
        
        <hr style="width: 900px; color: #286090;">        
        <div class="group_lesson">
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">                        
                        Template buổi học
                    </h3>                    
                </div>
                <div class="panel-body">
                    @if($courseTemplate->getTemplateLesson)
                                          
                    <div class="bs-example">
                        <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                            @foreach($courseTemplate->getTemplateLesson as $i => $template)
                            <li class="@if($i == 0) active @endif">
                                <a href="#lesson_{{$i}}" data-toggle="tab" id="tab_name_lesson_{{$i}}">{{$template->name}}</a>
                            </li>
                            @endforeach                                                        
                        </ul>
                        <div id="lessonContent" class="tab-content">
                            @foreach($courseTemplate->getTemplateLesson as $i => $template)
                                @php                                    
                                    $css= $i == 0 ? 'active in' : '';
                                @endphp
                            <div class="tab-pane fade {{$css}} " id="lesson_{{$i}}">
                                <div class='col-md-8'>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="name">Tên buổi học</label>
                                        <div class="col-md-9">
                                            <input id="template_name" name="template_lesson_name[{{$i}}]" type="text" value="{{old('template_lesson_name', !empty($template->name) ? $template->name : '' )}}" class="form-control">
                                            <input type="hidden" name="template_lesson_id[{{$i}}]" id="template_lesson_id" value="{{$template->template_lesson_id}}">
                                        </div>
                                    </div>
                                    <!-- Message body -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="message">Nội dung buổi học</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control resize_vertical" id="lesson_content" name="lesson_content[{{$i}}]" rows="5">{!!$template->content!!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class="form-group" >
                                        <label class="col-md-4 control-label" for="name">Ngày bắt đầu</label>
                                        <div class="col-md-8">
                                            <input id="date_start"  name="lesson_date_start[{{$i}}]" type="text" value="" class="date_start form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                                        <div class="col-md-8">
                                            <label style="margin-right: 10px; cursor: pointer;">
                                                <input type="radio" name="lesson_active[{{$i}}]" value="1" class="square"  @if($template->active == 1) checked @endif /> Có
                                            </label>

                                            <label style="margin-right: 10px; cursor: pointer;">
                                                <input type="radio" name="lesson_active[{{$i}}]" value="0" class="square" @if($template->active == 0) checked @endif /> Không                                    
                                            </label>                               
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Số thứ tự</label>
                                        <div class="col-md-8">
                                            <input class='form-control' type="number" name="lesson_ordinal[{{$i}}]" value="{{$i + 1}}" >                               
                                        </div>
                                    </div>
                                </div>
                                                                                                                                              
                            </div>
                            @endforeach                                                        
                        </div>
                    </div>
                    
                    @endif
                </div>
            </div>
        </div>
        <!-- Form actions -->
        
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">                        
                        Thông tin chi tiết
                    </h3>                    
                </div>
             <div class="panel-body">
                 <div class="col-md-6">
                    <div class="form-group" >
                        <label class="col-md-4 control-label" for="name">Ngày bắt đầu</label>
                        <div class="col-md-8">
                            <span class='form-control' id='preview_course_date_start' disabled></span>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Ngày kết thúc</label>
                        <div class="col-md-8">
                            <span class='form-control' id='preview_course_date_end' disabled></span>
                        </div>
                    </div>                         
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Giới hạn học viên</label>
                        <div class="col-md-4">                            
                            <span class='form-control' id='preview_course_student_limit' disabled></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Thời lượng khóa học</label>
                        <div class="col-md-4">                            
                            <span class='form-control' id='preview_course_time' disabled></span>
                        </div>
                    </div>                        
                </div>
                 <div class="col-md-6">                       
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                        <div class="col-md-2">
                           <span class='form-control' id='preview_course_acitve' disabled></span>                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Giá</label>
                        <div class="col-md-4">                            
                            <span class='form-control' id='preview_course_price' disabled></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Giảm giá(%)</label>
                        <div class="col-md-4">                            
                            <span class='form-control' id='preview_course_disscount' disabled></span>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Ngày hết hạn</label>
                        <div class="col-md-8">                            
                            <span class='form-control' id='preview_course_discount_exp' disabled></span>  
                        </div>
                    </div>
                </div>
             </div>
         </div>
        
    </fieldset>
</form>

<script type="text/javascript">
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

$("#preview .date_start").datetimepicker({format: 'YYYY-MM-DD HH:mm'});

$('#classes').multiselect({
    buttonWidth: '100%',
    nonSelectedText: 'Chọn lớp',
    enableFiltering: true,
});



$('body').on('change', '#teacher', function () {
    let teacher_id = $(this).val();
    $.ajax({
        url: "/admin/vne/coursetemplate/find-class-subject",
        type: 'GET',
        cache: false,
        data: {
            teacher_id: teacher_id
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



</script>