@include('.include.head')
<body>
@include('.include.header')
<form action="/resume/advert/{{$advert->id}}" method="POST">
    @csrf
    <div class="answerBody">
        <div class="answerBodyUser">
            <h2>Інформація про працівника</h2>
            <div class="pibUserAnswer">
                <label for="pib">ПІБ</label><br>
                <input type="text" name="pib" id="pib" placeholder="ПІБ" value="{{$user->name .' '.$user->surname}}" required>
            </div>
            <div class="pibUserAnswer">
                <label for="email">Email</label><br>
                <input type="text" name='email' id="email" placeholder="Email" value="{{$user->email}}" required >
            </div>
            <div class="pibUserAnswer">
                <label for="number">Номер телефону</label><br>
                <input type="number" id="number" name='phone' placeholder="38093445123" value="{{$user->phone}}" required>
            </div>
            <div class="pibUserAnswer">
                <label for="price">Бажана зарплатня($)</label><br>
                <input type="number" id="price" name='sallary' placeholder="500" value="{{$user->sallary}}" required>
            </div>
            <div class="pibUserAnswer">
                <label for="resume">Резюме</label><br>
                <textarea id="resume" name='resume' cols="30" rows="10" placeholder="Резюме" required>{{$user->resume}}</textarea>
            </div>

        </div>
        <div class="answerBodyAdvert">
            <h2>Інформація про оголошення</h2>
            <a href="/advert/{{$advert->id}}" class="removeLinkStyle">
                <div class="advertInfoAnswer">
                    <div>
                        <img src="{{$advert->company->img}}" alt="" class="advert-img-answer">
                    </div>
                    <div>
                        <h2>{{$advert->title}}</h2>
                        <h2>{{$advert->maxsallary}} $</h2>
                    </div>
                </div>
            </a>
        </div>
        <input type="text" hidden name='company' value="{{$advert->company->id}}">
        <button class="greenBtn" type="submit">Відгукнутися</button>

    </div>
</form>
