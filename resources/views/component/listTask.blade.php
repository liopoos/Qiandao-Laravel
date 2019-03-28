<ul class="list-group">
    @if(empty($data))
        <p>无</p>
    @else
        @foreach ($data as $item)

            @if($item['is_replace'])
                <li class="list-group-item list-group-item-danger">
                    <p>
                        <strong>{{$item['name']}}</strong>:
                        {{$replace[$item['name']]}}
                    </p>
                </li>
            @else
                <li class="list-group-item">
                    <p>
                        <strong>{{$item['name']}}</strong>:
                        {{$item['value']}}
                    </p>
                </li>
            @endif
        @endforeach
    @endif
</ul>