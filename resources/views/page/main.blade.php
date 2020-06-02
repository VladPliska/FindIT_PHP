@include('.include/head')
<body>
@include('.include/header')

<div class='main  '>
    <div class='content  '>
        <div class='filter  '>
            <div class='find  '>Знайти роботу</div>
            <div class='searchBlock  '>
                <input type="text" placeholder="Введіть назву вакансії"/>
                <select class='city  ' name="" id="">
                    <option value="0" selected disabled>Виберіть місто</option>
                    @foreach($city as $v)
                        <option value="{{$v->id}}" >{{$v->name}}</option>
                    @endforeach
                </select>
                <button name="" id="">Пошук</button>
            </div>
        </div>
        <div class='allItems'>
            @foreach($advert as $v)
                <a href="/advert/{{$v->id}}">
                    <div class='item'>
                        <div class='img'>
                            <img src="{{$v->company->img}}" alt="" class="user-img"/>
                        </div>
                        <div class='desc'>
                            <div class='name'>{{$v->title}}</div>
                            <div class='description' style="height: 100px">
                                {{$v->description}}
                            </div>
                            <div class='mobileGetText  '>Read more...</div>
                        </div>
                        <div class='price'>{{$v->maxSallary}}$</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

</body>
