@include('include.head')

<body>
{{--@include('include.header')--}}

<div>
    <div class='loginBodyParent'>
        <div class='header_block'>
            <a href='/'>
                <img src="/img/white-logo.png" alt=""/>
            </a>
            <h2>Авторизація</h2>
        </div>
        <form action="/login" method="POST">
            @csrf
            <div class='loginBody'>
                <div class='inputBlock'>
                    <label for="username">Логін або email</label><br/>
                    <input type="text" id='username' name="login"/>
                </div>
                <div class='inputBlock'>
                    <div class='forgotPass'><label
                            for="password">Пароль</label>
                        <a href='/forgotPass'>
                            <span>Забули пароль?</span>
                        </a>
                    </div>
                    <input type="password" id='password' name="pass"/>
                </div>
                <button class='login' type="submit">Увійти</button>
            </div>
        </form>

        <div class='notAcc'>
            <h3>Вперше на сайті? </h3>
            <a href='/signup'>
                <h3 class='createAcc'>Створіть акаунт.</h3>
            </a>
        </div>
    </div>
</div>

</body>
