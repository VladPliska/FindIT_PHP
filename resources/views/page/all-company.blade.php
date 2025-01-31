@include('.include/head')
<body>
@include('.include/header')
        <h2>Всі компанії</h2>
<div class="allCompanyBody">
    @foreach($companyData as $v)
        <a href="/company/{{$v->id}}" class="removeLinkStyle">
            <div class="companyItem">
            <div>
                <img  class='company-img' src="{{$v->img}}" alt="company-img">
            </div>
            <div>
                <h2>{{$v->name}}</h2>
                <h2>{{$v->city->name}}</h2>
            </div>
            <h2 class="reit">Рейтинг: {{$v->score ?? 1}}/10</h2>
        </div>
        </a>
    @endforeach
    {{$companyData->links()}}
</div>
