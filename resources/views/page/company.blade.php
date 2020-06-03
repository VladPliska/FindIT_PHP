@include('.include/head')
<body>
@include('.include/header')
<div>
    <div class='companyBody'>
        <div class='back'>
            <div class='trek'></div>
            <div class='backBtn'>Back</div>
        </div>
        <div class='reating'>Рейтинг: {{$company->score ?? 1}}/10</div>
        <div class='childCompanyBody'>
            <div class='forGridMainInfo'>
                <div class='blockMainInfo'>
                    <div>
                        <img class='publicCompanyProfileImg' src="{{$company->img}}" alt=""/>
                    </div>
                    <div class='firstInfo'>
                        <h2>Назва:</h2>
                        <h2>{{$company->name}}</h2><br/>
                        <h2>Місто:</h2>
                        <h2>{{$company->city->name}}</h2>
                    </div>
                </div>
                <div class='dopInfo'>
                    <h2>Можливість працювати в офісі:</h2>
                    <h2>{{$company->office ? 'є' : "ні"}}</h2><br/>
                    <h2>Можливість працювати з дому:</h2>
                    <h2>{{$company->home ? 'є' : "ні"}}</h2><br/>
                    <h2>Технології які використовує компанія:</h2>
                    <div class='technology'>
                        @foreach($technology as $v)
                            @include('.include/technology',['data'=>$v])
                        @endforeach
                    </div>
                    <div class='allWorker'>
                        <h2>Всього робітників:</h2>
                        <h2>{{$company->workers}}</h2>
                    </div>
                    <div>
                        <h2 class='descriptionTitle'>Короткі відомості</h2>
                        <h3 class='description'>
                            {{$company->description}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="company-advert-item-new">
                <h2>Вакансії компанії:</h2>
                @foreach($company->advert as $v)
                                        @include('.include.advert-item',['advert' =>$v])
                @endforeach
{{--                    @include('.include.advert-item')--}}
{{--                    @include('.include.advert-item')--}}
                            <a href='/filter'>Показати більше...</a>
            </div>
        </div>

    </div>
</div>
</body>
