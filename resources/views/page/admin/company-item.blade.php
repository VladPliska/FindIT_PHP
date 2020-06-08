@foreach($company as $v)
    <a href="/company/{{$v->id}}" class="removeLinkStyle admin-company-item">
    <img class='company-img' src="{{$v->img}}" alt="company-img">
    <h2>{{$v->name}}</h2>
    <h2>{{$v->city->name}}</h2>
    <h2 class="reit">Рейтинг: {{$v->score ?? 1}}/10</h2>
    <h2 class="remove" data-type="company" data-id="{{$v->id}}">Видалити</h2>
    <h2 class="block" data-type="company" data-id="{{$v->id}}">Заблокувати</h2>
</a>
@endforeach
