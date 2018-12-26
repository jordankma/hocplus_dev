<option value="">Chọn</option>
@if(!empty($teachers))
    
    @foreach($teachers as $teacher)
        <option value="{{$teacher->getTeacher->teacher_id}}">{{$teacher->getTeacher->name}}</option>
    @endforeach
@endif

