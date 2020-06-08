@if(!empty($forSearch))
    @if(count($data) == 0)
        <h2>Вакансій по вказаним критеріям не знайденно</h2>
    @else
        @foreach($data as $v)
            <a href="/advert/{{$v->id ?? 1}}">
                <div class='advert advert-filter-item-href'>
                    <h2>{{$v->title ?? 'Title advert'}}</h2>
                    <h3>{{$v->company->name ?? 'name'}}</h3>
                    <h3>{{$v->city->name ?? 'CITY'}}</h3>
                    <span class='description'>
                        {{$v->description ?? 'desc'}}
    </span> @if($company != null)
                        <a class='link1' href='javascript:;'>Авторизуйтеся як працівник,для відповіді</a>
                    @else
                        <a class='link1' href='/resume/advert/{{$v->id}}'>Відгукнутися</a>
                    @endif
                    <h2 class='price'>${{$v->minsallary ?? 0}} - ${{$v->maxsallary ?? 100}}</h2>
                    <img src="{{$v->company != null ? $v->company->img : 'https://picsum.photos/350/200'}}"
                         class='companyImg' alt=""/>
                </div>
            </a>
        @endforeach
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
                    @else
                        <a class='link1' href='/resume/advert/{{$v->id}}'>Відгукнутися</a>
                    @endif
                    <h2 class='price'>${{$v->minsallary ?? 0}} - ${{$v->maxsallary ?? 100}}</h2>
                    <img src="{{$v->company != null ? $v->company->img : 'https://picsum.photos/350/200'}}"
                         class='companyImg'
                         alt=""/>
                </div>
            </a>

            <a class="remove" data-type="advert" data-id="{{$v->id}}">Видалити</a>
            <a class="block" data-type="advert" data-id="{{$v->id}}">Заблокувати</a>
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
            @else
                <a class='link1' href='/resume/advert/{{$advert->id}}'>Відгукнутися</a>
            @endif
            <h2 class='price'>${{$advert->minsallary ?? 0}} - ${{$advert->maxsallary ?? 100}}</h2>
            <img src="{{$advert->company != null ? $advert->company->img : 'https://picsum.photos/350/200'}}"
                 class='companyImg'
                 alt=""/>
        </div>
    </a>
@endif
