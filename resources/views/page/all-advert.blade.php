@include('.include/head')
<body>
@include('.include/header')

</body>

<div>
    <div class='allAdvertBody  '>
        <div class='leftFilter  '>
            <div class='cityBody  '>
                <h2>Місто</h2>
                <div class='cityItem  '>
                    <span>Ужгород</span><span>5</span>
                </div>
                <div class='cityItem  '>
                    <span>Київ</span><span>15</span>
                </div>
                <div class='cityItem  '>
                    <span>Виноградів</span><span>25</span>
                </div>
                <div class='cityItem  '>
                    <span>Житомир</span><span>35</span>
                </div>
            </div>
            <div class='typeWorkSpace  '>
                <h2>Можливість праці з</h2>
                <div>
                    <label for="office">Офісу</label>
                    <input type="radio" id='office' name='workspace'/>
                </div>
                <div>
                    <label for="home">Дому</label>
                    <input type="radio" id='home' name='workspace'/>
                </div>

            </div>
            <div class='skills-filter'>
                <h2>Рівень знань</h2>
                <div>
                    <label for="intern">Intern</label>
                    <input type="checkbox" id='intern'/>
                </div>
                <div>
                    <label for="jun">Junior</label>
                    <input type="checkbox" id='jun'/>
                </div>
                <div>
                    <label for="middle">Middle</label>
                    <input type="checkbox" id='middle'/>
                </div>
                <div>
                    <label for="senior">Senior</label>
                    <input type="checkbox" id='senior'/>
                </div>
            </div>
            <div class='sallary  '>
                <h2>Зарплатня</h2>
                <div>
                    <span>від $300</span><span>200</span>
                </div>
                <div>
                    <span>від $600</span><span>500</span>
                </div>
                <div>
                    <span>від $1000</span><span>500</span>
                </div>
                <div>
                    <span>від $1500</span><span>500</span>
                </div>
                <div>
                    <span>від $2500</span><span>500</span>
                </div>
            </div>
        </div>
        <div class='forGrid  '>
            <div class='headerFilter  '>
                <input type="text" placeholder='Назва компанії,вакансія' class='searchQuery  '/>
                <button class='searchBtn  '>Знайти</button>
            </div>
            <div class='resultBody  '>
                <h2>Результати пошуку:</h2>
                @foreach($advert as $v)
                    @include('.include/advert-filter-item',['advert'=>$v])
                @endforeach
            </div>
        </div>
    </div>
</div>
