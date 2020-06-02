@include('.include.head')
<body>
@include('.include.header')

<div class="company-profile-page-parent">
    <div class="profile-company-menu">
        <h1>Меню</h1>
        <a href='#profileCompany' class="active company-menu-item" data-target="profile">Профіль</a>
        <a href='#advertCompany' class="company-menu-item" data-target="companyAdvert">Вакансії компанії</a>
        <a href='#answerCompanyAdvert' class="company-menu-item">Відповіді на вакансії</a>
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
                            <textarea name="description" id="description" cols="30" rows="10">{{$company->description}}</textarea>
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

                    <div>
                        <h2>Технології</h2>
                        <div class="technoBody">
                            {{--                @dd($technology)--}}
                            @foreach($technology as $v)
                                @include('.include.technology',['data'=>$v])
                            @endforeach
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
    </div>
</div>
</body>
