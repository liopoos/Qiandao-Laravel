<ul class="list-group">
    @if(empty($data))
        <li class="list-group-item">
            <p>无</p>
        </li>
    @else
        @foreach ($data as $item)

            @if($item['is_replace'])
                <li class="list-group-item">
                    <p>
                        <strong style="color: red">{{$item['name']}}</strong>:
                        <strong>{{$replace[$item['name']]}}</strong>
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