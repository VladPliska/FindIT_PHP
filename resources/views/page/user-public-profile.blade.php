@include('.include.head')
@include('.include.header')

<div class="profile-public-body">
    <div class="headerInfo">
        <img src="{{$user->img ?? asset('img/user-img.png')}}" alt="">
        <div>
            <h2>{{$user->name . ' '. $user->surname}}</h2>
            <h2>{{$user->email}}</h2>
        </div>
    </div>
    <div class="otherInfo">
        <h2>Досвід:{{$user->experience}} роки</h2>
        <h2>Місце роботи:{{$user->home == true ? 'Дім' : 'Оффіс'}}</h2>
        <h2>Tехнології</h2>
        <div class="allUseTech techReadyUse">
            @foreach($tech as $v)
                @include('.include.technology',['data'=>$v])
            @endforeach
        </div>
        <h2>Резюме:{{$user->resume}}</h2>
    </div>
</div>
