{{--@dump($data)--}}
<div class='technoI' data-id="{{$data->id ?? null}}">
    <input type="hidden" value="{{$data->id ?? null}}"/>
    {{$data->name ?? 'test'}}
</div>
