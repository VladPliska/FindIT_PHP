@include('.include/head')
<body>
@include('.include/header')

<div class='main  '>
    <div class='content  '>
        <div class='filter  '>
            <div class='find  '>Знайти роботу</div>
            <div class='searchBlock  '>
                <input type="text" placeholder="Введіть назву вакансії"/>
                <select class='type  ' name="" id="">
                    <option value="" selected>IT</option>
                </select>
                <select class='city  ' name="" id="">
                    <option value="" selected>Ужгород</option>
                </select>
                <button name="" id="">Пошук</button>
            </div>
        </div>
        <div class='allItems  '>
            <div class='item  '>
                <div class='img  '>
                    <img src="https://picsum.photos/350/200" alt=""/>
                </div>
                <div class='desc  '>
                    <div class='name  '>Junior Back-end</div>
                    <div class='description' style="height: 100px">Розробка архітектури додатків на всіх етапах, згідно
                        із затвердженим ТЗ.
                        Досвід розробки на Python / Django від півроку. Впевнене знання теоретичних основ програмування
                        на мові Python. Досвід командної комерційної розробки
                    </div>
                    <div class='mobileGetText  '>Read more...</div>
                </div>
                <div class='price'>$300</div>
            </div>
            <div class='item  '>
                <div class='img  '>
                    <img src="https://picsum.photos/350/200" alt=""/>
                </div>
                <div class='desc  '>
                    <div class='name  '>Middle Back-end</div>
                    <div class='description'  style="height: 100px">
                        Розробка нового функціоналу сайту petshop.ru і сайтів-партнерів. Рефакторинг існуючої кодової
                        бази. Впровадження кращих практик розробки. Брати активну участь у всіх ...
                        Закінчено вища технічна. Відмінні навички ООП. Розумієте і прямуєте принципам SOLID в розробці
                        додатків. PHP7, його слабкі і сильні
                    </div>
                    <div class='mobileGetText  '>Read more...</div>

                </div>
                <div class='price  '>$300</div>
            </div>
            <div class='item  '>
                <div class='img  '>
                    <img src="https://picsum.photos/350/200" alt=""/>
                </div>
                <div class='desc  '>
                    <div class='name  '>Senior Back-end</div>
                    <div class='description  ' style="height: 100px">Розробка нових продуктів компанії. Підтримка і розвиток поточної
                        архітектури. Участь в нових проектах і розробці інфраструктурного коду. Написання тестів.
                        Java Core і Concurrency. Глибоке знання SQL. Розуміння принципів роботи розподілених систем.
                        Знання Kotlin буде плюсом
                    </div>
                    <div class='mobileGetText  '>Read more...</div>

                </div>
                <div class='price  '>$300</div>
            </div>
        </div>
    </div>
</div>

</body>
