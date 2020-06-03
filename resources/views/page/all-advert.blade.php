@include('.include/head')
<body>
@include('.include/header')

<div>
    <div class='allAdvertBody  '>
        <div class='leftFilter  '>
            <div class='cityBody '>
                <h2>Місто</h2>
                @foreach($allCity as $v)
                    <div class='cityItem' data-id="{{$v->id}}">
                        <span>{{$v->name}}</span><span>{{$v->advert}}</span>
                    </div>
                @endforeach
            </div>
            <div class='typeWorkSpace'>
                <h2>Можливість праці з</h2>
                <div>
                    <label for="office">Офісу</label>
                    <input type="radio" id='office' name='workspace' class='workspace' value="office"/>
                </div>
                <div>
                    <label for="home">Дому</label>
                    <input type="radio" id='home' name='workspace' class="workspace" value="home"/>
                </div>

            </div>
            <div class='skills-filter'>
                <h2>Рівень знань</h2>
                <div>
                    <label for="intern">Intern</label>
                    <input type="radio" id='intern' name="level" class="level" value="1"/>
                </div>
                <div>
                    <label for="jun">Junior</label>
                    <input type="radio" id='jun' name="level"class="level" value="2"/>
                </div>
                <div>
                    <label for="middle">Middle</label>
                    <input type="radio" id='middle' name="level" class="level" value="3"/>
                </div>
                <div>
                    <label for="senior">Senior</label>
                    <input type="radio" id='senior' name="level" class="level" value="4"/>
                </div>
            </div>
            <div class='sallary  '>
                <h2>Зарплатня</h2>
                <div class='selectFilterPrice' data-val="300">
                    <span>від $300</span>
                </div>
                <div class='selectFilterPrice' data-val="600">
                    <span>від $600</span>
                </div>
                <div class='selectFilterPrice' data-val="1000">
                    <span>від $1000</span>
                </div>
                <div class='selectFilterPrice' data-val="1500">
                    <span>від $1500</span>
                </div>
                <div class='selectFilterPrice' data-val="2500">
                    <span>від $2500</span>
                </div>
            </div>
        </div>
        <div class='forGrid'>
            <div class='headerFilter'>
                <input type="text" placeholder='Назва компанії,вакансія' class='searchQuery  '/>
                <button class='searchBtn filterStart'>Знайти</button>
                <div class="queryFilter">
                    <label for="checkFilter">Фільтрувати?</label>
                    <input type="checkbox" id="checkFilter" name="filterOn">
                </div>
            </div>
            <div class='resultBody  '>
                <h2>Результати пошуку:</h2>
                <div class="forSearchBody" style="position: relative">
                    @foreach($advert as $v)
                        @include('.include/advert-filter-item',['advert'=>$v])
                    @endforeach
                </div>
                {{$advert->links()}}

            </div>
        </div>
    </div>
</div>
