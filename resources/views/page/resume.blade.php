@include('.include.head')
<body>
@include('.include.header')

@if(empty($companyCheck))
    <form action="/resume/advert/{{$advert->id}}" method="POST">
        @csrf
        <div class="answerBody">
            <div class="answerBodyUser">
                <h2>Інформація про працівника</h2>
                <div class="pibUserAnswer">
                    <label for="pib">ПІБ</label><br>
                    <input type="text" name="pib" id="pib" placeholder="ПІБ" value="{{$user->name .' '.$user->surname}}"
                           required>
                </div>
                <div class="pibUserAnswer">
                    <label for="email">Email</label><br>
                    <input type="text" name='email' id="email" placeholder="Email" value="{{$user->email}}" required>
                </div>
                <div class="pibUserAnswer">
                    <label for="number">Номер телефону</label><br>
                    <input type="number" id="number" name='phone' placeholder="38093445123" value="{{$user->phone}}"
                           required>
                </div>
                <div class="pibUserAnswer">
                    <label for="price">Бажана зарплатня($)</label><br>
                    <input type="number" id="price" name='sallary' placeholder="500" value="{{$user->sallary}}"
                           required>
                </div>
                <div class="pibUserAnswer">
                    <label for="resume">Резюме</label><br>
                    <textarea id="resume" name='resume' cols="30" rows="10" placeholder="Резюме"
                              required>{{$user->resume}}</textarea>
                </div>

            </div>
            <div class="answerBodyAdvert">
                <h2>Інформація про оголошення</h2>
                <input type="text" hidden value="{{$advert->id}}" name="advert_id">
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
@else
    <div class="answerBody">
        <div class="answerBodyUser">
            <h2>Інформація про працівника</h2>
            <div class="pibUserAnswer">
                <label for="pib">ПІБ: </label>
                <a href="/public/worker/profile/{{$answer->user_id}}"><h2>{{$answer->fullname}}</h2></a>
            </div>
            <div class="pibUserAnswer">
                <label for="email">Email: </label>
                <h2>{{$answer->email}}</h2>
            </div>
            <div class="pibUserAnswer">
                <label for="number">Номер телефону: </label>
                <h2>{{$answer->phone}}</h2>
            </div>
            <div class="pibUserAnswer">
                <label for="price">Бажана зарплатня($): </label>
                <h2 id="price">{{$answer->sallary}}</h2>
            </div>
            <div class="pibUserAnswer">
                <label for="resume">Резюме: </label>
                <h2 id="resume" class="userResumeAnswer">{{$answer->resume}}</h2>
            </div>
        </div>
        <div class="answerBodyAdvert">
            <h2>Інформація про оголошення</h2>
            <input type="text" hidden value="{{$answer->advert->id}}" name="advert_id">
            <a href="/advert/{{$answer->advert->id}}" class="removeLinkStyle">
                <div class="advertInfoAnswer">
                    <div>
                        <img src="{{$answer->advert->company->img}}" alt="" class="advert-img-answer">
                    </div>
                    <div>
                        <h2>{{$answer->advert->title}}</h2>
                        <h2>{{$answer->advert->maxsallary}} $</h2>
                    </div>
                </div>
            </a><br>
            <div class="statusBlock">
                @if($company != null)
                    <form action="/changeStatus" method="POST">
                        @csrf
                        <label for="changeStatus">Змінити статус відповіді:</label>

                        <select class='changeStatusAnswer' name="status" id="changeStatus">
                            @if($answer->status)
                                <option value="{{$answer->status}}" selected disabled>{{$answer->status}}</option>
                            @endif
                            <option value="Прочитано">Прочитано</option>
                            <option value="Відхилено">Відхилено</option>
                            <option value="На розгляді">На розгляді</option>
                            <option value="Схваленно">Схваленно</option>
                        </select>
                        <input type="text" hidden name="id" value="{{$answer->id}}">
                        <button class="greenBtn" type="submit">Змінити статус</button>
                    </form>
                @else
                    <div class="pibUserAnswer">
                        <label for="resume" style="font-size: 30px;text-align: left">Cтатус:</label>
                        <h2>{{$answer->status}}</h2>
                    </div>
                @endif

            </div>

        </div>

    </div>
    <br>
    @if($answer->status == 'Схваленно')
        <h2>Чат</h2>
        <div class="chatBody">
            <div class="messageAll">
                @foreach($message as $v)
                    @include('.include.message-item',compact('v'))
                @endforeach
            </div>
            <div class="sendBlock">
                <textarea name="messageText" id="messageText" cols="15" rows="4"
                          placeholder="Введіть текст повідомлення"></textarea>
                <input type="text" hidden value="{{$answer->advert->id}}" name='advertID'>
                <i class="fas fa-paper-plane sendMessage"></i>
            </div>
        </div>
@endif

@endif
