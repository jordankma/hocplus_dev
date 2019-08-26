<form class="form-horizontal" action="{{route('vne.course.edit', ['course_id' => $course->course_id])}}" method="post" id="form-add-template-course">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <fieldset>
        <!-- Name input-->
        <div class="col-md-8">
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Tên khóa học</label>
                <div class="col-md-8">
                    <input id="name" name="name" type="text" value="{{old('name', isset($course) ? $course->name : '')}}" class="form-control"></div>
            </div>

            <div class="form-group" >
                <label class="col-md-3 control-label" for="name">Ngày bắt đầu</label>
                <div class="col-md-8">
                    <input id="date_start" name="date_start" type="text" value="{{date('Y-m-d H:i', !empty($course->date_start) ? $course->date_start : time())}}" class="type_date form-control">
                </div>
            </div>    

            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Ngày kết thúc</label>
                <div class="col-md-8">
                    <input id="date_end" name="date_end" value="{{date('Y-m-d H:i', !empty($course->date_end) ? $course->date_end : time())}}" type="text" class="type_date form-control">
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
                    <input id="thumbnail" class="form-control" type="text" name="avartar" value="{{old('avartar', isset($course) ? $course->avartar : '')}}" style="width: 250px;">
                </div>
            </div>
            <div class="form-group" style="display: flex;">
                <label class="col-md-3 control-label" for="name"></label>
                <img id="holder" src="{{$course->avartar}}" style="margin-top:15px;max-height:100px; margin-left: 15px; display: block;">
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Video giới thiệu</label>
                <div class="col-md-8">
                    <input id="template_video_intro" name="video" type="text" value="{{old('video', isset($course) ? $course->video : '')}}" class="form-control"></div>
            </div>
            @if($course->video)
            <div class="form-group">
                <label class="col-md-3 control-label" for="name"></label>
                <div class="col-md-8">
                    <iframe width="auto" height="auto" src="{{$course->video}}" style="border: none;"></iframe>                    
                </div>
            </div>
            @endif

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
                        <option value="{{$teacher['teacher_id']}}" @if($teacher['teacher_id'] == $course->teacher_id) selected @endif>{{$teacher['name']}}</option>
                        @endforeach                                        
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Lớp</label>
                <div class="col-md-8" id='select_class_subject'>
                    <select id="classes" name="classes" class="form-control"  >                                                                       
                        @if(!empty($data))
                        @foreach($data as $c => $class)
                        <optgroup label="{{ $class['name'] }}">
                            @if(!empty($class['subject']))
                            @foreach($class['subject'] as $s => $subject)
                            <option value="{{$c . '-' . $s}}" @if($c == $course->classes_id  && $s == $course->subject_id) selected @endif>{{ $subject['name'] }}</option>
                            @endforeach
                            @endif
                        </optgroup>
                        @endforeach
                        @endif                                                                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Khai giảng</label>
                <div class="col-md-8">
                    <label style="margin-right: 10px; cursor: pointer;">
                        <input type="radio" name="status" value="1" class="square" @if($course->status == 1) checked @endif /> Có
                    </label>

                    <label style="margin-right: 10px; cursor: pointer;">
                        <input type="radio" name="status" value="0" class="square" @if($course->status == 0) checked @endif /> Không                                    
                    </label>                               
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message" style="padding-top: 0px;">Hiển thị</label>
                <div class="col-md-8">
                    <label style="margin-right: 10px; cursor: pointer;">
                        <input type="radio" name="active" value="1" class="square" @if($course->active == 1) checked @endif /> Có
                    </label>

                    <label style="margin-right: 10px; cursor: pointer;">
                        <input type="radio" name="active" value="0" class="square" @if($course->active == 0) checked @endif /> Không                                    
                    </label>                               
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Giới hạn hv</label>
                <div class="col-md-8">
                    <input id="student_limit" name="student_limit" value="{{$course->student_limit}}" type="number" min='0' class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Thời lượng </label>
                <div class="col-md-8">
                    <input id="time" name="time" type="text" value="{{$course->time}}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Giá</label>
                <div class="col-md-8">
                    <input id="price" name="price" min='0' type="number" value="{{$course->price}}" class="form-control">                             
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Giảm giá(%)</label>
                <div class="col-md-8">
                    <input id="discount" name="discount" value="{{$course->discount}}" type="number" class="form-control">                             
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Ngày hết hạn</label>
                <div class="col-md-8">
                    <input id="discount_exp" name="discount_exp" value="{{date('Y-m-d H:s', !empty($course->discount_exp) ? $course->discount_exp : time())}}" type="text" class="form-control">                             
                </div>
            </div>

        </div>
        <hr class="col-md-12">                                                                               
        <div class="col-md-12">
            <!-- Message body -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="message">Mô tả</label>
                <div class="col-md-9">
                    <textarea class="form-control resize_vertical" id="summary" name="summary" placeholder="Nhập mô tả khóa học..." rows="5">
                                                {{old('summary', isset($course) ? $course->summary : '')}}
                    </textarea>
                </div>
            </div>
            <!-- Message body -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="message">Nội dung khóa học</label>
                <div class="col-md-9">
                    <textarea class="form-control resize_vertical" id="will_learn" name="will_learn" placeholder="Nhập nội dung khóa học..." rows="5">
                                                {{old('will_learn', isset($course) ? $course->will_learn : '')}}
                    </textarea>
                </div>
            </div>
            <!-- Message body -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="message">Mục tiêu khóa học</label>
                <div class="col-md-9">
                    <textarea class="form-control resize_vertical" id="target" name="target" placeholder="Nhập mục tiêu khóa học..." rows="5">
                                                {{old('target', isset($course) ? $course->target : '')}}
                    </textarea>
                </div>
            </div>
            <!-- Message body -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="message">Yêu cầu khóa học</label>
                <div class="col-md-9">
                    <textarea class="form-control resize_vertical" id="request" name="request_content" placeholder="Nhập yêu cầu khóa học..." rows="5">
                                                {{old('request_content', isset($course) ? $course->request_content : '')}}
                    </textarea>
                </div>
            </div>
        </div>
        <!-- Form actions -->
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-responsive btn-primary">Cập nhật khóa học</button>
            </div>
        </div>
    </fieldset>
</form>