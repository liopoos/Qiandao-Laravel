<ul class="list-group">
    @if(empty($data))
        <p>无</p>
    @else
        @foreach ($data as $item)
            <li class="list-group-item">
                <p>
                    <strong>{{$item['name']}}</strong>:
                    @if($item['is_replace'])
                        <code>{{$item['name']}}</code>
                    @else
                        {{$item['value']}}
                    @endif
                </p>
            </li>
        @endforeach
    @endif
</ul>