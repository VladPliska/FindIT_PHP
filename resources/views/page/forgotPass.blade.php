@include('.include.head')

<body>

{{--    @include('.include.header')--}}
    <div class="forgot-pass-body">
        <div class='header_block'>
            <a href='/'>
                <img src="img/white-logo.png" alt=""/>
            </a>
            <h2>Відновлення паролю</h2>
        </div>
        <div class='forgotBody'>
            <label for="email">Email</label><br/>
            <input type="text" id='email' placeholder='example@gmail.com'/>
            <button class='btnSend'>Надіслати повідомлення</button>
        </div>
    </div>

</body>
