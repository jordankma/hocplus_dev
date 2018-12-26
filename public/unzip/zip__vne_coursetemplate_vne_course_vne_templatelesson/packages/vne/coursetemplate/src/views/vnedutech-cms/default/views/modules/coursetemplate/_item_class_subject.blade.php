<select id="classes" @if($type == 'edit') name="classes" @else name="classes[]" @endif  class="form-control" @if($type == 'add') multiple="multiple" @endif >
    @if(!empty($data))
        @foreach($data as $c => $class)
            <optgroup label="{{ $class['name'] }}">
                @if(!empty($class['subject']))
                    @foreach($class['subject'] as $s => $subject)
                        <option value="{{$c . '-' . $s}}">{{ $subject['name'] }}</option>
                    @endforeach
                @endif
            </optgroup>
        @endforeach
    @endif
</select>