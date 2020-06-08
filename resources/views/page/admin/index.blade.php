@include('.include.head')

@include('.include.header')

<h1 class="adminTitle">Панель Адміністратора</h1>
<div class="searchAdmin">
    <div class='headerFilter' style="justify-content: center">
        @csrf
        <input type="text" placeholder='Введіть текст' class='searchInAdmin searchQuery'/>
        <button class='searchBtn adminSearchBtn'>Знайти</button>
    </div>
</div>
<div class="adminBody">
    <div class="admin-menu profile-company-menu">
        <h1>Меню</h1>
        <a href='#allCompany' class="active company-menu-item" data-target="AllCompany">Компанії</a>
        <a href='#allWorker' class="company-menu-item" data-target="allWorker">Працівники</a>
        <a href='#allAdvert' class="company-menu-item" data-target="allAdvert">Оголошення</a>
    </div>
    <div class="admin-workspace">
        <div class=" menu-item profile-admin-company" data-target="AllCompany">
                @include('.page.admin.company-item',compact('company'))
        </div>
        <div class=" menu-item profile-all-worker hidden" data-target="allWorker">
                @include('.page.admin.worker-item',compact('worker'))
        </div>
        <div class=" menu-item profile-all-advert hidden" data-target="allAdvert">
                    @include('.include.advert-filter-item',['advert'=>$advert,'admin'=>true])
        </div>
    </div>
</div>
