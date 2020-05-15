@include('.include.head')

<body>

@include('.include.header')

<div>
    <div class='bodyRegWorker'>
        <h2 class='title'>Створення новго працівника</h2>

        <form action="/signUp" method="POST" class="createUser-form">
            @csrf
            <div class='mainBlock'>
                <div class='userContactInfo'>
                    <div class='inputBlock'>
                        <label for="name">Ім'я</label><br/>
                        <input type="text" id='name' placeholder='Василь' name='name' required/>
                    </div>
                    <div class='inputBlock'>
                        <label for="surname">Прізвище</label><br/>
                        <input type="text" id='surname' placeholder='Пупкін' name='surname' required/>
                    </div>
                    <div class='inputBlock'>
                        <label for="phone">Номер телефону</label><br/>
                        <input type="text" id='phone' placeholder='8 800 555 35 35' name='phone' />
                    </div>
                    <div class='inputBlock'>
                        <label for="email">Email</label><br/>
                        <input type="text" id='email' placeholder='example@gmail.com' name='email' required/>
                    </div>
                </div>
                <div class='webUserInfo'>
                    <div class='inputBlock'>
                        <label for="username">Username,nickname</label><br/>
                        <input type="text" id='username' placeholder='username' name='username' required/>
                    </div>
                    <div class='inputBlock'>
                        <label for="password">Пароль</label><br/>
                        <input type="password" class="passChange" id='password' placeholder='Пароль' name='password' required/>
                    </div>
                    <div class='inputBlock'>
                        <label for="reppas">Повторіть пароль</label><br/>
                        <input type="password" id='reppas' placeholder='Пароль' name='reppass' required/>
                    </div>
                </div>
                <div class='developerInfo'>
                    <div class='inputBlock'>
                        <label for="experience">Досвід(мін. 1 рік)</label><br/>
                        <input type="number" id='experience' placeholder='Досвід' name='experience' required/>
                    </div>
                    <div class='inputBlock'>
                        <label for="sallary">Бажана зарплатня($)</label><br/>
                        <input type="number" id='sallary' placeholder='Зарплатня' name='sallary' required/>
                    </div>
                    <div class='selectTypeWork'>
                        <h2 class='titleType'>Місце праці</h2>
                        <div class='selectTypeItem'>
                            <label for="office">Офіс</label><input id='office' type="radio" value="office" name="selecttype" required/>
                        </div>
                        <div class='selectTypeItem'>
                            <label for="remoute">Дім</label><input id='remoute' type="radio" value="home" name="selecttype" required/>
                        </div>
                    </div>
                    <div>
                        <h2>Технології розробки</h2>
                        <div class='technoBody'>
                            @foreach($data as $v)
                                @include('.include.technology',['data'=>$v])
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <button class='confirmBtn' type="submit">Зареєстуватися</button>
        </form>
    </div>
</div>
</body>
