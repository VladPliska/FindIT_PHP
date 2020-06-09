@include('.include.head')
<body>
@include('.include.header')

<div class="company-profile-page-parent">
    <div class="profile-company-menu">
        <h1>Меню</h1>
        <a href='#profileCompany' class="active company-menu-item" data-target="profile">Профіль</a>
        <a href='#advertCompany' class="company-menu-item" data-target="companyAdvert">Вакансії компанії</a>
        <a href='#answerCompanyAdvert' class="company-menu-item" data-target="companyAnswer">Відповіді на вакансії</a>
        <a href='#addCompanyAdvert' class="company-menu-item" id="addAdvertShow" data-target="addAdvert">Додати
            вакансію</a>
    </div>
    <div class="company-profile-page-content">
        <div class=" menu-item profile-info-company " data-target="profile">
            <div class="company-profile-page ">
                <div>
                    <h1>Відомості про компанію</h1>
                    <div class="leftBlockParent">
                        <div class="leftBlock">
                            <input type="file" hidden>
                            <img src="{{$company->img}}" width="350px" height="200px" alt="">
                            <div class="notChange">
                                <label for="">Назва</label>
                                <input type="text" value="{{$company->name}}"><br>
                                <label for="">Місто</label>
                                <input type="text" value="{{$city->name}}"><br>
                                <label for="">Працівники</label>
                                <input type="text" value="{{$company->worker ?? 0}}"><br>
                            </div>
                        </div>
                        <div class="descriptionCompany">
                            <label for="description">Про компанію</label>
                            <textarea name="description" id="description" cols="30"
                                      rows="10">{{$company->description}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="centerBlock">
                    <h1>Додаткова інформація</h1>
                    <h2>Місце праці</h2>
                    <span class='selectTypeWork'>
            <label for="office">Офіс</label>
            <input type="checkbox" name="office" id="office" {{$company->office ? 'checked' : '' }}/>
        </span>
                    <span class='selectTypeWork'>
            <label for="home">Дім</label>
            <input type="checkbox" id="home" name="home" {{$company->home ? 'checked' : '' }}>
        </span>

                    <div class="editTechno">
                        <h2>Технології</h2>
                        <div class="userTechnologyChge">
                            @if(count($technology) == 0)
                                <h2>Вибраних технологій не знайдено</h2>
                            @endif
                            <div class="technoBody techReadyUse">
                                @foreach($technology as $v)
                                    @include('.include.technology',['data'=>$v])
                                @endforeach
                            </div>
                            <form action="/userChangeTechnology" method="POST" class="formChageTech">
                                @csrf
                                <div class="allUseTech techReadyUse hidden">

                                </div>
                            </form>
                            <br>
                            <button class="changeTechnology greenBtn">Редагувати технології</button>
                            <button class="cancelChangeTechn  grayBtn hidden">Скасувати</button>
                        </div>

                    </div>
                </div>
            </div>
            <button class="greenBtn saveChangeCompanyProfile" type="submit">Зберегти</button>
        </div>
        <div class=" menu-item profile-add-advert hidden" data-target="addAdvert">
            @include('.page.add-advert',['company'=>$company,'city'=>$allCity])
        </div>
        <div class=" menu-item profile-company-advert hidden" data-target="companyAdvert">
            @foreach($advert as $v)
                @include('.include.advert-filter-item',['advert'=> $v,'company'=>$company,'city'=>$city])
            @endforeach
        </div>
        <div class=" menu-item profile-answer-advert hidden" data-target="companyAnswer">
            @foreach($companyAnswerAdvert as $v)
                    <div class="answer-body-user">
                        <a href='/advert/{{$v->advert_id}}' class="advert-body">
                            <img class="adwert-img-answer" src="{{$v->company->img}}" alt="">
                            <div class="advert-data">
                                <div>{{$v->advert->title}}</div>
                                <div class="">{{$v->company->name}}</div>
                                <div>{{$v->advert->maxsallary}}$</div>
                            </div>
                        </a>
                        <div class="OtherInfo">
                            <h2>Статус:{{$v->status}}</h2>
                            <h2>Відповідь віправленна: {{date('d-m-Y h:s',strtotime($v->created_at))}}</h2>
                            <a href="/answer-show/{{$v->id}}">Переглянути деталі</a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
</body>
