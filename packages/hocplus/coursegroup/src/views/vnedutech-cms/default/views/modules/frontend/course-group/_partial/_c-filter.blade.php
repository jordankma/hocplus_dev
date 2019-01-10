<div class="section c-filter">
        <div class="container">
            <div class="inner">
                <form action="{{ route('hocplus.course-group') }}" method="GET">
                <div class="left">
                    <a href="" class="btn btn-filter">Lọc kết quả</a>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox1">
                        <label class="form-check-label" for="checkbox1">Sắp diễn ra</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox2">
                        <label class="form-check-label" for="checkbox2">Đang diễn ra</label>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="classes_id">
                            <option selected="true" value="0">Theo lớp</option>
                            @if(!empty($list_classes))
                            @foreach($list_classes as $element)
                                <option value="{{ $element->classes_id }}">{{ $element->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="subject_id">
                            <option selected="true" value="0">Theo Môn</option>
                            @if(!empty($list_subjects))
                            @foreach($list_subjects as $element)
                                <option value="{{ $element->subject_id }}">{{ $element->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div> <!-- / left -->
                </form>
                <div class="right">
                    <span>Sắp xếp:</span>
                    <div class="form-group">
                        <select class="form-control">
                            <option selected="true" disabled="disabled">Mới nhất</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div> <!-- / right -->
            </div> <!-- / inner -->
        </div> <!-- / container -->
    </div> <!-- / filter -->