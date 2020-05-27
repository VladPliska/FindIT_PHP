@include('.include.head')

<body>
@include('.include.header')
<div class="advert-page">
    <div class="advert-body">
        <div>
            <h2 class="title-advert">{{$advert->title ?? 'title'}}</h2>
            <h3 class="sallary">${{$advert->minSallary ?? 0}} - ${{$advert->maxSallary ?? 1}}</h3>
        </div>
        <div class="companyInfo-advert">
            <div>
                <h2 class="companyName-advert">{{$company->name ?? 'company'}}</h2>
                <h3 class="city-advert">{{$city->name ?? 'city'}}</h3>
            </div>
            <div>
                <img src="/storage/img/{{$company->img}}" alt="">
            </div>

        </div>
        <div class="sendMail">
            <div>
                <button class="answer">Відповісти</button>
                <button>LIKE</button>
            </div>
            <div>
                <h2>Досвід роботи: 1</h2>
                <h2>Робота в офісі: {{$advert->office ? 'Так' : "Ні"}}</h2>
                <h2>Робота віддалено: {{$advert->home ? 'Так' : "Ні"}}</h2>
            </div>
        </div>
        <div class="steckBody-advert">
            <h2>Ключові навички</h2>
            <div class="steck-techno">
                @foreach($tech as $v)
                    @include('.include.technology',['data'=>$v])
                @endforeach
            </div>
        </div>
        <div class="description-advert-page">
            <h1>Опис</h1>
            <h2>{{$advert->description ?? 'test'}}</h2>
        </div>
    </div>
    <div class='advertEqual'>
        @foreach($adverts as $v)
            @include('.include.advert-item',['advert'=>$v])
        @endforeach
    </div>

</div>

</body>
