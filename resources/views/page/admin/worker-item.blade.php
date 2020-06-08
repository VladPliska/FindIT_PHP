@foreach($worker as $v)
    <div class="admin-worker-body">
    <img src="{{$v->img ?? asset('img/user-img.png')}}" class='user-img' alt="">
    <div class="username">{{$v->name}}</div>
    <div class="email">{{$v->email}}</div>
    <div class="experience">{{$v->experience}}</div>
    <a class="changeAccess" data-type="worker" data-action='remove' data-id="{{$v->id}}">Видалити</a>
        @if($v->block)
            <a class="changeAccess" data-type='worker' data-action='unblock' data-id="{{$v->id}}">Розблокувати</a>
        @else
            <a class="changeAccess" data-type='worker' data-action='block' data-id="{{$v->id}}">Заблокувати</a>
        @endif
    </div>
@endforeach
