@if(!empty($quanHuyen))
    <option selected="true" disabled="disabled">Quận / Huyện</option>
    @foreach($quanHuyen as $item)
        <option value="{{$item['maqh']}}">{{$item['name']}}</option>
    @endforeach
@endif
