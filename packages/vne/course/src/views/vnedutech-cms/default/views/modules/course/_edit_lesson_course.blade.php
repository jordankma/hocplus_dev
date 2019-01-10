<form class="form-horizontal" action="{{route('vne.lesson.editList')}}" method="post" id="surveyForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <input type="hidden" name="course_id" value="{{request()->get('course_id')}}" >
    <fieldset >
        @if(!empty($course->getLesson))
            <div class="bs-example">
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                    @foreach($course->getLesson as $i => $lesson)
                    <li class="@if($i == 0) active @endif">
                        <a href="#lesson_{{$i}}" data-toggle="tab" id="tab_name_lesson_{{$i}}">{{$lesson->name}}</a>
                    </li>
                    @endforeach                                                        
                </ul>
                <div id="lessonContent" class="tab-content">
                    @foreach($course->getLesson as $i => $lesson)
                        @php                                    
                            $css= $i == 0 ? 'active in' : '';
                        @endphp
                    <div class="tab-pane fade {{$css}} " id="lesson_{{$i}}">
                        <div class='col-md-8'>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Tên buổi học</label>
                                <div class="col-md-9">
                                    <input name="name[]" type="text" value="{{old('name', !empty($lesson->name) ? $lesson->name : '' )}}" class=" form-control">
                                    <input type="hidden" name="lesson_id[{{$i}}]" id="lesson_id" value="{{$lesson->lesson_id}}">
                                </div>
                            </div>
                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Nội dung buổi học</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" name="content[]" rows="5">{!!$lesson->content!!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class="form-group" >
                                <label class="col-md-4 control-label" for="name">Ngày bắt đầu</label>
                                <div class="col-md-8">
                                    <input  name="date_start[]" type="text" value="{{date('Y-m-d H:i', $lesson->date_start)}}" data-enabletime=true data-time_24hr=true data-timeFormat="H:i" class="lesson_date_start form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                                <div class="col-md-8">
                                    <label style="margin-right: 10px; cursor: pointer;">
                                        <input type="radio" name="active[{{$i}}]" value="1" class="square"  @if($lesson->active == 1) checked @endif /> Có
                                    </label>

                                    <label style="margin-right: 10px; cursor: pointer;">
                                        <input type="radio" name="active[{{$i}}]" value="0" class="square" @if($lesson->active == 0) checked @endif /> Không                                    
                                    </label>                               
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Số thứ tự</label>
                                <div class="col-md-8">
                                    <input class='form-control' type="number" name="ordinal[]" value="{{$lesson->ordinal}}" >                               
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach                                                        
                </div>
            </div>
        @endif       

                

        <!-- Form actions -->
        <div class="form-group">
            <div class="col-md-12 text-center">
                
                <button type="submit" class="btn btn-responsive btn-success">Cập nhật buổi học</button>
            </div>
        </div>
    </fieldset>
</form>