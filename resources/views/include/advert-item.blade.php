<div class='advertBody'>
    <div class='advertImg'>
        <img src="https://picsum.photos/150/100" alt=""/>
    </div>
    <div class='advertInfo'>
        <div>
            <h2>{{$advert->title ?? 'title'}}</h2>
            <h2>Company</h2>
            <span>Steck</span>
        </div>
    </div>
    <div class='advertPrice'>
        <h2>${{$advert->maxSallary ?? 200}}</h2>
    </div>
</div>
