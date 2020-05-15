@include('.include.head')
<body>
@include('.include.header')

<div class="profile-page">
    <div>
    <h1>Особиста інформація</h1>
        <div class="leftBlock">
            <img src="https://picsum.photos/350/200" alt="">
            <div class="notChange">
                <h2>{{$data->name}}</h2>
                <h2>{{$data->surname}}</h2>
                <h2>{{$data->email}}</h2>
                <h2>{{$data->phone}}</h2>
            </div>
        </div>
        <h2>Резюме</h2>
        <textarea class="resumeProfile"></textarea>
        <button class="greenBtn saveResume">Зберегти зміни</button>
    </div>
    <div class="centerBlock">
        <h1>Зміна паролю</h1>
        <label for="oldPass">Старий пароль</label>
        <input type="password" id="oldPass"><br>
        <label for="pass">Новий пароль</label>
        <input type="password" id="pass"><br>
        <label for="respass">Повторіть новий пароль</label>
        <input type="password" id="reppass"><br>
        <button class="changePass greenBtn" type="submit">Змінити пароль</button>
    </div>
    <div class="rightBlock">
        <h1>Допоміжні дані</h1>
        <label for="price">Зарплатня($)</label>
        <input type="number" id="price" value="{{$data->sallary}}"><br>
        <label for="exp">Досвід</label>
        <input type="number" id="exp" value="{{$data->experience}}"><br>
        <h2>Місце праці</h2>
        <div class='selectTypeWork'>
            <label for="office">Офіс</label>
            <input type="radio" name="settype" id="office"/>
        </div>
        <div class='selectTypeWork'>
            <label for="home">Дім</label>
            <input type="radio" id="home" name="settype">
        </div>
        <div class="editTechno">
            <h2>Технології</h2>
            <div class="allUseTech">
                @foreach($tech as $v)
                    @include('.include.technology',['data'=>$v])
                @endforeach
            </div>
        </div>
        <button class="greenBtn changeDopInfo">Змінити</button>


    </div>


</div>


</body>
