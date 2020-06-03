@include('.include.head')
<body>
@include('.include.header')

<div class="company-profile-page-parent">
    <div class="profile-company-menu user-menu">
        <h1>Меню</h1>
        <a href='#profileUser' class="active company-menu-item" data-target="profile">Профіль</a>
        <a href='#selectAdvert' class="company-menu-item" data-target="selectAdvert">Вибрані вакансії</a>
        <a href='#anserAdvert' class="company-menu-item" data-target="answerAdvert">Відповіді на вакансії</a>

    </div>
    <div class="company-profile-page-content user-content-profile">
        <div class="profile-page menu-item" data-target="profile">
            <div>
                <h1>Особиста інформація</h1>
                <form action="/chageOneInfo" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="leftBlock">
                        <label for="image">
                            <img src="{{$data->img ?? 'https://picsum.photos/350/200'}}" alt=""
                                 class="user-img changeImg-parent">
                        </label>
                        <input type="file" hidden name="image" id="image" class="changeImg">
                        <div class="notChange">
                            <h2>{{$data->name}}</h2>
                            <h2>{{$data->surname}}</h2>
                            <h2>{{$data->email}}</h2>
                            <h2>{{$data->phone}}</h2>
                        </div>
                    </div>
                    <h2>Резюме</h2>
                    <textarea class="resumeProfile" name="resume">{{$data->resume}}</textarea>
                    <button class="greenBtn saveResume" type="submit">Зберегти зміни</button>
                </form>
            </div>
            <div class="centerBlock">
                <form action='/worker/changePassword' method="POST">
                    @csrf
                    <h1>Зміна паролю</h1>
                    <label for="oldPass">Старий пароль</label>
                    <input type="password" id="oldPass" name='old' required><br>
                    <label for="pass">Новий пароль</label>
                    <input type="password" id="pass" required name="new"><br>
                    <label for="respass">Повторіть новий пароль</label>
                    <input type="password" id="reppass" required name="rep"><br>
                    <button class="changePass greenBtn" type="submit">Змінити пароль</button>
                </form>
            </div>
            <div class="rightBlock">
                <form action="/worker/changeDetail" method="POST">
                    @csrf
                    <h1>Допоміжні дані</h1>
                    <label for="price">Зарплатня($)</label>
                    <input type="number" id="price" name='sallary' value="{{$data->sallary}}" required><br>
                    <label for="exp">Досвід</label>
                    <input type="number" id="exp" name='exp' value="{{$data->experience}}" required><br>
                    <h2>Місце праці</h2>
                    <div class='selectTypeWork'>
                        <label for="office">Офіс</label>
                        <input type="radio" name="settype" id="office" value="office" required {{$data->office ? 'checked' : ''}}/>
                    </div>
                    <div class='selectTypeWork'>
                        <label for="home">Дім</label>
                        <input type="radio" id="home" name="settype" value="home" required {{$data->home ? 'checked' : ''}}>
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
                </form>
            </div>
        </div>
        <div class="selectAdvert menu-item hidden" data-target="selectAdvert"> </div>
        <div class="asnswerAdvert menu-item hidden" data-target="answerAdvert"> </div>
    </div>

</div>

@if(session('err'))
    <h2 class='msg-suc loginErr'>{{session('err')}}</h2>
@elseif(session('succ'))
    <h2 class='msg-suc loginSucc'>{{session('succ')}}</h2>
@endif


</body>
