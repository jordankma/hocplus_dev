<div class="section c-filter">
        <div class="container">
            <div class="inner">
                <form action="{{ route('hocplus.course.list') }}" method="GET">
                <div class="left">
                    <button class="btn btn-filter" type="submit">Lọc kết quả</button>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox1" name="course_early" 
                        @if(isset($params['course_early']) && $params['course_early'] == 'on') checked @endif>
                        <label class="form-check-label" for="checkbox1">Sắp khai giảng</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox2" name="course_now"
                        @if(isset($params['course_now']) && $params['course_now'] == 'on') checked @endif>
                        <label class="form-check-label" for="checkbox2">Đang diễn ra</label>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="classes_id" id="classes">
                            <option selected="true" value="0">Theo lớp</option>
                            @if(!empty($list_classes))
                            @foreach($list_classes as $element)
                                <option value="{{ $element->classes_id }}" 
                                @if(isset($params['classes_id']) && $params['classes_id'] == $element->classes_id ) selected @endif>
                                    {{ $element->name }}
                                </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="subject_id" id="subject">
                            <option value="0">Theo Môn</option>
                            @if(!empty($list_subjects))
                            @foreach($list_subjects as $element)
                                <option value="{{ $element->subject_id }}"
                                @if(isset($params['subject_id']) && $params['subject_id'] == $element->subject_id ) selected @endif>
                                    {{ $element->name }}
                                </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div> <!-- / left -->
                </form>
                <div class="right">
                    <span>Sắp xếp:</span>
                    <div class="form-group">
                        <select class="form-control" id="sort" name="sort">
                            <option>Chọn kiểu</option>
                            <option value="new"  @if(isset($params['sort']) && $params['sort'] == 'new') selected @endif>Mới nhất</option>
                            <option value="old" @if(isset($params['sort']) && $params['sort'] == 'old') selected @endif>Cũ nhất</option>
                            <option value="price_up" @if(isset($params['sort']) && $params['sort'] == 'price_up') selected @endif>Giá từ thấp đến cao</option>
                            <option value="price_down" @if(isset($params['sort']) && $params['sort'] == 'price_down') selected @endif>Giá từ cao đến thấp</option>
                        </select>
                    </div>
                </div> <!-- / right -->
            </div> <!-- / inner -->
        </div> <!-- / container -->
    </div> <!-- / filter -->