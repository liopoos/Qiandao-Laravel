<ul class="list-group">
    @if(empty($data))
        <li class="list-group-item">
            <p>无</p>
        </li>
    @else
        @foreach ($data as $item)
            <li class="list-group-item">
                <p>
                    <strong>{{$item['name']}}</strong>:
                    @if($item['is_replace'])
                        <kbd>{{$item['name']}}</kbd>
                    @else
                        {{$item['value']}}
                    @endif
                </p>
            </li>
        @endforeach
    @endif
</ul>