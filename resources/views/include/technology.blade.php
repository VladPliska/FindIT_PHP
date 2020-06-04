@if(empty($userChange))
    <div class='technoI' data-id="{{$data->id ?? null}}">
        <input type="hidden" value="{{$data->id ?? null}}"/>
        {{$data->name ?? 'test'}}
    </div>
@elseif($userChange=true)
        @foreach($tech as $data)
{{--            @foreach($userTech as $v)--}}
{{--                @if($data->id == $v)--}}
{{--                    <div class='technoI active' data-id="{{$data->id ?? null}}">--}}
{{--                        <input type="hidden" value="{{$data->id ?? null}}" name=Technology[] />--}}
{{--                        {{$data->name ?? 'test'}}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
            <div class='technoI ' data-id="{{$data->id ?? null}}">
                <input type="hidden" value="{{$data->id ?? null}}"/>
                {{$data->name ?? 'test'}}
            </div>
        @endforeach
@endif
