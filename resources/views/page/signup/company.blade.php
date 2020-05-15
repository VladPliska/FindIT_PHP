@include('.include.head')

<body>

@include('.include.header')

<div>
    <h2 class='companyTitle'>Реєстрація компанії</h2>
    <form action="/companySignUp"  method="POST" enctype="multipart/form-data" >
        @csrf
        <div class='body'>
            <div class="grid-company-reg">
                <div>
                    <h2 class="mainImgTitle">Інформація про компанію</h2>
                    <h2>Головне зображення</h2>
                    <label for="imgChange" class="addImg-reg-company">
                        <img  src="https://picsum.photos/350/200" alt=""/>
                    </label>
                    <input type="file" hidden  id="imgChange" name="image" accept="image/* ">
                    <div class='inputBlock'>
                        <label for="name">Назва компанії</label><br/>
                        <input type="text" id='name' name="name" required/>
                    </div>
                    <div class='inputBlock'>
                        <label for="city">Місто</label><br/>
                        <select required name="city" id="city">
                            <option value="0" selected disabled>Виберіть місто</option>
                            @foreach($city as $v)
                                <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='workSpaceBody'>
                        <h2 class='workSpace'>Місця праці</h2>
                        <label for="ofice">Офіс</label>
                        <input type="checkBox" id='ofice' name="office"/> <br/>
                        <label for="home">Дім</label>
                        <input type="checkBox" id='home' name="home"/>
                    </div>
                    <div class='allWorker'>
                        <label for="worker">Працівників в команді</label><br/>
                        <input type="number" id='worker' name="wokers"/>
                    </div>
                </div>
                <div>
                    <h2 class="mainImgTitle">Додаткова інформація</h2>
                    <label for="email">Email</label><br>
                    <input type="text" id="email" required name="email"> <br>
                    <label for="pass">Пароль</label><br>
                    <input type="password" id="pass" required name="password"><br>
                    <label for="reppass">Повторіть пароль</label><br>
                    <input type="password" id="reppass" required name="reppass"><br>
                    <div>
                        <h2>Стек технологій</h2>
                        <div class='techSteck'>
                            @foreach($technology as $v)
                                @include('.include.technology',['data'=>$v])
                            @endforeach
                        </div>
                    </div>
                    <label for='descriptionCompany'>Про компанію</label><br/><br>
                    <textarea required name="description" id="descriptionCompany" cols="30" rows="10"></textarea>
                </div>
            </div>
            <button class='btnSubmit regCompany' type="submit">Зареєструвати компанію</button>
        </div>
    </form>
</div>

</body>
