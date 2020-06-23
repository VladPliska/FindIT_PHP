@if(!empty($forSearch))
    @if(count($data) == 0)
        <h2>Вакансій по вказаним критеріям не знайденно</h2>
    @else
        <h2>Оголошення:</h2>
        @foreach($data as $v)
            <a href="/advert/{{$v->id ?? 1}}">
                <div class='advert advert-filter-item-href'>
                    <h2>{{$v->title ?? 'Title advert'}}</h2>
                    <h3>{{$v->company->name ?? 'name'}}</h3>
                    <h3>{{$v->city->name ?? 'CITY'}}</h3>
                    <span class='description'>
                        {{$v->description ?? 'desc'}}
                </span><br>

                    @if($company != null)
                        <a class='link1' href='javascript:;'>Авторизуйтеся як працівник,для відповіді</a>
                    @elseif($user)
                        <a class='link1' href='/resume/advert/{{$v->id}}'>Відгукнутися</a>
                    @else
                        <a class='link1' href='/login'>Авторизуйтеся для відповіді</a>
                    @endif
                    <h2 class='price'>${{$v->minsallary ?? 0}} - ${{$v->maxsallary ?? 100}}</h2>
                    <img src="{{$v->company != null ? $v->company->img : 'https://picsum.photos/350/200'}}"
                         class='companyImg' alt=""/>
                </div>
            </a>
        @endforeach
    @endif
    @if(!empty($companyData))
        @if(count($companyData) == 0)
            <h2>Жодної компанії не знайдено</h2>
        @else

            <h2>Компанії:</h2>
            <div class="profile-admin-company filter-company-item">
                @foreach($companyData as $v)
                    <a href="/company/{{$v->id}}" class="removeLinkStyle admin-company-item">
                        <img class='company-img' src="{{$v->img}}" alt="company-img">
                        <h2>{{$v->name}}</h2>
                        <h2>{{$v->city->name}}</h2>
                        <h2 class="reit">Рейтинг: {{$v->score ?? 1}}/10</h2>
                    </a>
                @endforeach
            </div>
        @endif
    @endif
@elseif(!empty($admin))
    @foreach($advert as $v)
        <div class="advert-admin-item">

            <a href="/advert/{{$v->id ?? 1}}">
                <div class='advert advert-filter-item-href'>
                    <h2>{{$v->title ?? 'Title advert'}}</h2>
                    <h3>{{$v->company->name ?? 'name'}}</h3>
                    <h3>{{$v->city->name ?? 'CITY'}}</h3>
                    <span class='description'>
                        {{$v->description ?? 'desc'}}
    </span><br>
                    @if($company != null)
                        <a class='link1' href='javascript:;'>Авторизуйтеся як працівник,для відповіді</a>
                    @elseif($user)
                        <a class='link1' href='/resume/advert/{{$v->id}}'>Відгукнутися</a>
                    @else
                        <a class='link1' href='/login'>Авторизуйтеся для відповіді</a>
                    @endif
                    <h2 class='price'>${{$v->minsallary ?? 0}} - ${{$v->maxsallary ?? 100}}</h2>
                    <img src="{{$v->company != null ? $v->company->img : 'https://picsum.photos/350/200'}}"
                         class='companyImg'
                         alt=""/>
                </div>
            </a>


            <a class="changeAccess" data-type="advert" data-action='remove' data-id="{{$v->id}}">Видалити</a>
            @if($v->block)
                <a class="changeAccess" data-type="advert" data-action='unblock' data-id="{{$v->id}}">Розблокувати</a>
            @else
                <a class="changeAccess" data-type="advert" data-action='block' data-id="{{$v->id}}">Заблокувати</a>
            @endif
        </div>
        <br><br>
    @endforeach


@else
    <a href="/advert/{{$advert->id ?? 1}}">
        <div class='advert advert-filter-item-href'>
            <h2>{{$advert->title ?? 'Title advert'}}</h2>
            <h3>{{$advert->company->name ?? 'name'}}</h3>
            <h3>{{$advert->city->name ?? 'CITY'}}</h3>
            <span class='description'>
                        {{$advert->description ?? 'desc'}}
    </span><br>
            @if($company != null)
                <a class='link1' href='javascript:;'>Авторизуйтеся як працівник,для відповіді</a>
            @elseif($user)
                <a class='link1' href='/resume/advert/{{$advert->id}}'>Відгукнутися</a>
            @else
                <a class='link1' href='/login'>Авторизуйтеся для відповіді</a>
            @endif
            <h2 class='price'>${{$advert->minsallary ?? 0}} - ${{$advert->maxsallary ?? 100}}</h2>
            <img src="{{$advert->company != null ? $advert->company->img : 'https://picsum.photos/350/200'}}"
                 class='companyImg'
                 alt=""/>
        </div>
    </a>
@endif
