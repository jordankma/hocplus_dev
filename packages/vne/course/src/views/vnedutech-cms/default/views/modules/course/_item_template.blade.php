@if(!empty($templates))
    @foreach($templates as $i => $val)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td><img src='{{$val['template_avatar']}}' width="50px"></td>
        <td>{{$val['template_name']}}</td>
        <td>{{$val->isClass->name}}</td>
        <td>{{$val->isSubject->name}}</td>
        <td>{{$val->isTeacher->name}}</td>
        <td>
            <span class="label label-sm label-info btn-add-template" style="cursor: pointer;" template-id="{{$val['course_template_id']}}" template-name="{{$val['template_name']}}">Chọn</span>
        </td>
    </tr>
    @endforeach
@endif