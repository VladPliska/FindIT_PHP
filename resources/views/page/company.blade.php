@include('.include/head')
<body>
@include('.include/header')
<div>
    <div class='companyBody'>
        <div class='back'>
            <div class='trek'></div>
            <div class='backBtn'>Back</div>
        </div>
        <div class='reating'>Рейтинг: 4.5/10</div>
        <div class='childCompanyBody'>
            <div class='forGridMainInfo'>
                <div class='blockMainInfo'>
                    <div>
                        <img src="https://picsum.photos/350/200" alt=""/>
                    </div>
                    <div class='firstInfo'>
                        <h2>Назва:</h2>
                        <h2>FindIT</h2><br/>
                        <h2>Місто:</h2>
                        <h2>Ужгород</h2>
                    </div>
                </div>
                <div class='dopInfo'>
                    <h2>Можливість працювати в офісі:</h2>
                    <h2>є</h2><br/>
                    <h2>Можливість працювати з дому:</h2>
                    <h2>є</h2><br>
                    <h2>Технології які використовує компанія:</h2>
                    <div class='technology'>
{{--                      @include('.include/technology')--}}
                    </div>
                    <div class='allWorker'>
                        <h2>Всього робітників:</h2>
                        <h2>200</h2>
                    </div>
                    <div>
                        <h2 class='descriptionTitle'>Короткі відомості</h2>
                        <h3 class='description'>Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic typesetting, remaining essentially unchanged. It was popularised in the
                            1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                            recently with desktop publishing software like Aldus PageMaker including versions of
                            Lorem Ipsum.
                        </h3>
                    </div>
                </div>
            </div>
            <div class="company-advert-item-new">
                <h2>Вакансії компанії:</h2>
                    @include('.include.advert-item')
                    @include('.include.advert-item')
                    @include('.include.advert-item')
                            <a href='/filter'>Показати більше...</a>
            </div>
        </div>

    </div>
</div>
</body>
