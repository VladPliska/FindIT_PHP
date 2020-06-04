@include('.include.head')



@include('include.header')

<div class="advert-page">
    <div class="advert-body">
        <div>
            <h2 class="title-advert">{{$advert->title ?? 'title'}}</h2>
            <h3 class="sallary">${{$advert->minsallary ?? 0}} - ${{$advert->maxsallary ?? 1}}</h3>
        </div>
        <a href="/company/{{$company->id}}" class="removeLinkStyle">
            <div class="companyInfo-advert">
                <div>
                    <h2 class="companyName-advert">{{$company->name ?? 'company'}}</h2>
                    <h3 class="city-advert">{{$city->name ?? 'city'}}</h3>
                </div>
                <div>
                    <img src="{{$advert->company->img}}" alt="">
                </div>
            </div>
        </a>
        <div class="sendMail">
            <div>
                <button class="answer">Відповісти</button>
                @if($selected)
                    <i class="fas fa-star star-like addAdvertToFav" data-id="{{$advert->id}}"></i>
                @else
                    <i class="far fa-star star-like addAdvertToFav"  data-id="{{$advert->id}}"></i>
                @endif
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
    @if(count($adverts) != 0)
        <div class='advertEqual'>
            <h2 style="text-align: center">Схожі вакансії</h2>
            @foreach($adverts as $v)
                @include('.include.advert-item',['advert'=>$v])
            @endforeach
            <a href="/all-advert" class="ce">Переглянути більше...</a>
        </div>
    @endif

</div>

</body>
