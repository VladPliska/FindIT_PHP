<div  class='header'>
    <div class='logo'>
        <img src="/img/white-logo.png" width='100px' height='100px' alt="err"/>
    </div>
{{--    <div class='mobileMenu'><i class="fas fa-ellipsis-v"></i></div>--}}
    <ul>
        <a href='/' class='headerUrl'>Головна</a>
        <a  href='/all-advert' class='headerUrl'>Пропозиції</a>
{{--        <a  href='/news'  class='headerUrl' >Новини</a>--}}
        <a  href='/all-company'  class= 'headerUrl'  >Компанії</a>
        @if($company == null && $user == null)
            <a  href='/login'  class= 'headerUrl'  >Увійти</a>
        @elseif($user)
        @if($user->role == 'admin')
                <a  href='/admin'  class= 'headerUrl'>Admin</a>
            @else
                <a  href='/worker/profile'  class= 'headerUrl'  >Профіль</a>
            @endif
            <a  href='/logout'  class= 'headerUrl'  >Вийти</a>
        @elseif($company)
            <a  href='/company/profile'  class= 'headerUrl'  >Профіль</a>
            <a  href='/logout'  class= 'headerUrl'  >Вийти</a>

        @endif
    </ul>
</div>
