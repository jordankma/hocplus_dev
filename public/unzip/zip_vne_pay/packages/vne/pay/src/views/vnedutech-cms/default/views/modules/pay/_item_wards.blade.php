@if(!empty($xaPhuong))
    <option selected="true" disabled="disabled">Xã / Phường</option>
    @foreach($xaPhuong as $item)
        <option value="{{$item['xaid']}}">{{$item['name']}}</option>
    @endforeach
@endif
