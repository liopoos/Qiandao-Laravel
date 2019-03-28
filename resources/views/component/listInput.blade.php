@if(empty($data))
    <li class="list-group-item">
        <p>无</p>
    </li>
@endif
<input type="hidden" class="form-control" name="{{$prefix}}-Blank">
@foreach ($data as $item)
    <div class="form-group">
        <label>{{$item['name']}}</label>
        @if($item['is_replace'])
            <input type="text" class="form-control" name="{{$prefix}}-{{$item['name']}}"
                   placeholder="需要替换的{{$item['name']}}">
        @else
            <input type="text" class="form-control" value="{{$item['value']}}" disabled="disabled">
        @endif
    </div>
@endforeach
