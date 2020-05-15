{{--@include('.include.head')--}}
<form action="/addAdvert" method="post" id="create-advert">
    @csrf
    @if($errors->any())
        <h2 class="err">{{$errors->first()}}</h2>
    @endif
    @if(session('succ'))
        <h2 class="suc">{{session('succ')}}</h2>
    @endif
    <div>
        <div class='addAdvert'>
            <div class='mainInfo'>
                {{--            <img src="https://picsum.photos/350/200" alt="" height='200px' class='addImg'/>--}}
                <div class='content'>
                    <div class='contentContainer'>
                        <label for="advert-title" class="advert-name-title">Вкажіть назву вакансії</label><br/>
                        <input type="text" id='advert-title' required name='title' class='advertName'/>
                    </div>
                    <div class='company'>
                        <label for="companyName">
                            <h2>Вкажіть назву компанії</h2>
                        </label>
                        <input type="text" id='' value="{{$company->name ?? $data->name}}" disabled/>
                        <input type="hidden" id='companyName' value="{{$company->id ?? $data->id}}" disabled/>
                    </div>
                    <div class='selectTypeWork'>
                        <h2>Вкажіть місце роботи</h2>
                        <div class='selectTypeItem'>
                            <label for="officeType">Офіс</label><input id='officeType' value="office" type="radio"  required name="selecttype"/>
                        </div>
                        <div class='selectTypeItem'>
                            <label for="remoute">Віддалено</label><input id='remoute' type="radio" value="home" required name="selecttype"/>
                        </div>
                    </div>
                    <div class='selectCity'>
                        <h2>Виберіть місто:</h2>
                        <select name="city" id="" required>
                            <option value="0"  selected disabled>Виберіть місто</option>
                            <option value="1">Ужгород</option>
                            <option value="2">Виноградів</option>
                        </select>
                    </div>
                    <div class='price-add-advert'>
                        <h2>Зарплатня($):</h2>
                        <label for="minPrice">від</label>
                        <input type="number" id='minPrice' name="min" required/>
                        <label for="maxPrice">до</label>
                        <input type="number" id='maxPrice' name="max" required/>
                    </div>
                    <div class='contentContainer'>
                        <label for="advert-desc" class="advert-name-title">Додайте опис вакансії</label><br/>
                        <textarea id='advert-desc' name='description' required class='advertDescription' ></textarea>

                    </div>
                </div>
            </div>

            <div class='languages'>
                <div class='skills'>
                    <h1>Вкажіть рівень знань</h1>
                    <input name='setSkill' value='1' required type="radio" id='intern'/><label for="intern">Intern</label><br/>
                    <input name='setSkill' value='2' required type="radio" id='junior'/><label for="junior">Junior</label><br/>
                    <input name='setSkill' value='3' required type="radio" id='middle'/><label for="middle">Middle</label><br/>
                    <input name='setSkill' value='4' required type="radio" id='senior'/><label for="senior">Senior</label><br/>
                </div>
                <h1 class='typeTitle'>Виберіть технології розробки:</h1>
                <div class='technoBody'>
                    @foreach($technology as $v)
                        @include('.include.technology',['data' => $v])
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <div>
        <button class='addAdvertBtn' type="submit">
            Додати вакансію
        </button>
    </div>

</form>
