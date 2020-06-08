<div class="answer-body-user">
    <a href='#' class="advert-body">
        <img class="adwert-img-answer" src="{{$v->company->img}}" alt="">
        <div class="advert-data">
            <div>{{$v->advert->title}}</div>
            <div>{{$v->company->name}}</div>
            <div>{{$v->advert->maxsallary}}</div>
        </div>
    </a>
    <div class="OtherInfo">
        <h2>Статус:{{$v->status}}</h2>
        <h2>Відповідь віправленна: {{date('d-m-Y h:s',strtotime($v->created_at))}}</h2>
        <a href="/answer-show/{{$v->id}}">Переглянути деталі</a>
    </div>
</div>
