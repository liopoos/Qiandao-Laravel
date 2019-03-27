@if(empty($data))
    <p>无</p>
@endif
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
