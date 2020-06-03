<a href="/advert/{{$advert->id}}">
    <div class='advertBody'>
        <div class='advertImg'>
            <img src="{{$advert->company->img}}" alt="" class="recomendVacancy"/>
        </div>
        <div class='advertInfo'>
            <div>
                <h2>{{$advert->title ?? 'title'}}</h2>
                <h2>{{$advert->company->name}}</h2>
            </div>
        </div>
        <div class='advertPrice'>
            <h2>${{$advert->maxsallary ?? 200}}</h2>
        </div>
    </div>
</a>
