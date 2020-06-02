<a href="/advert/{{$advert->id ?? 1}}">
    <div class='advert advert-filter-item-href'>
        <h2>{{$advert->title ?? 'Title advert'}}</h2>
        <h3>{{$company->name ?? 'name'}}</h3>
        <h3>{{$city->name ?? 'CITY'}}</h3>
        <span class='description'>
                        {{$advert->description ?? 'desc'}}
    </span>
        <a class='link1' href='/resume'>Відгукнутися</a>
        <h2 class='price'>${{$advert->minSallary ?? 0}} - ${{$advert->maxsallary ?? 100}}</h2>
        <img src="{{$company != null ? $company->img : 'https://picsum.photos/350/200'}}" class='companyImg' alt=""/>
    </div>
</a>
