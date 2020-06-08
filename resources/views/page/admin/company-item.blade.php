@foreach($company as $v)
    <a href="/company/{{$v->id}}" class="removeLinkStyle admin-company-item">
        <img class='company-img' src="{{$v->img}}" alt="company-img">
        <h2>{{$v->name}}</h2>
        <h2>{{$v->city->name}}</h2>
        <h2 class="reit">Рейтинг: {{$v->score ?? 1}}/10</h2>
        <h2 class="changeAccess" data-type="company" data-action='remove' data-id="{{$v->id}}">Видалити</h2>
        @if($v->block)
            <h2 class="changeAccess" data-type="company" data-action='unblock' data-id="{{$v->id}}">Розблокувати</h2>
        @else
            <h2 class="changeAccess" data-type="company" data-action='block' data-id="{{$v->id}}">Заблокувати</h2>
        @endif
    </a>
@endforeach
