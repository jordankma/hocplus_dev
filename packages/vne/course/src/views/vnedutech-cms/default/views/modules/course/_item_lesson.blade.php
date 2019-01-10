<span style="font-size: 16px; font-weight: bold; color: #666666;"><i>Nhập thời gian bắt đầu các buổi học</i></span>
<div style="margin-top: 20px;"></div>

@if($lessons->items())
    @foreach($lessons->items() as $lesson)
        <div class="form-group">
            <label class="col-md-2 control-label" for="message">{{ $lesson->name}}</label>
            <div class="col-md-2">
                <input id="lesson_date_{{$lesson->template_lesson_id}}" name="lesson_date[]" data-enabletime=true data-time_24hr=true data-timeFormat="H:i" class="form-control lesson_date">                             
            </div>
            
        </div>
    @endforeach
@else
Chưa có buổi học <a href="{{route('vne.templatelesson.create', ['course_template_id' => $courseTemplateId])}}">Click vào đây</a> để tạo buổi học cho template
@endif
