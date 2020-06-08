@foreach($worker as $v)
    <div class="admin-worker-body">
    <img src="{{$v->img ?? asset('img/user-img.png')}}" class='user-img' alt="">
    <div class="username">{{$v->name}}</div>
    <div class="email">{{$v->email}}</div>
    <div class="experience">{{$v->experience}}</div>
    <a class="remove" data-type="worker" data-id="{{$v->id}}">Видалити</a>
    <a class="block" data-type='worker' data-id="{{$v->id}}">Блокувати</a>
</div>
@endforeach
