'use strict';

$('.confirmBtn').on('click', function (e) {
    let pass = $('#password')[0].value;
    let reppass = $('#reppas')[0].value;

    // alert(pass);
    if (pass !== reppass) {
        alert('Паролі не співпадають')
    } else {
        $('.createUser-form').submit();
    }
});


const getCity = () => {
    $.ajax({
        method: "POST",
        url: '/getCity',
        success: function (res) {
            return res;
        }
    })
}


$(document).on('click', '.regCompany', function (e) {
    let data = $('#city')[0].value;
    let pass = $('input[name=password]').val();
    let reppass = $('input[name=reppass]').val();
    let email = $('input[name=email]').val();
    let img = $('#imgChange')[0].files;
    console.log(img)
    if (!img.length) {
        alert('Виберіть головне зображення компанії');
        e.preventDefault();
        return;
    }

    $.ajax({
        'method': 'GET',
        'url': '/checkEmail',
        data: {'email': email},
        success: function (res) {
            if (res.company > 0) {
                alert('Email вже використовується!');
                e.preventDefault();
            }
        }
    })
    if (data == 0) {
        alert('Виберіть місто!!!');
        e.preventDefault();
        return;
    }
    console.log(pass, reppass);
    if (pass !== reppass) {
        alert('Паролі не співпадють!!!');
        e.preventDefault();
        return;
    }
});
$(document).on('change', '#imgChange', function () {
    let a = document.getElementById('imgChange').files[0];
    $('.addImg-reg-company').find('img').attr('src', URL.createObjectURL(a));
})

$('.profile-company-menu a').click(function (e) {
    $(this).parent().find('a').removeClass('active');
    $(this).toggleClass('active');

    let data = $(this).attr('data-target');
    $('.menu-item').addClass('hidden');
    $('.menu-item[data-target=' + data + ']').removeClass('hidden');
})


$('.technoI').on('click', function (e) {
    e.preventDefault();
    if ($(this).toggleClass('active')) {
        $(this).find('input').attr('name', 'technology[]');
        $(this).parent().find('input').attr('required', '-1');
    } else {
        if ($(this).parent().find('active').length == 0) {
            $(this).parent().find('input').attr('required', '');
        }
        $(this).find('input').attr('name', '');
    }
    console.log(e);
})

$('#create-advert').on('submit', function (e) {
    let tech = $(this).find('.technoI.active');
    let city = $(this).find('select');

    console.log(city.val(), tech.val());


    if (city.val() == null) {
        e.preventDefault();
        $(this).find('.selectCity').find('h2').addClass('empty')
        city.addClass('empty');
    } else {
        $(this).find('.selectCity').find('h2').removeClass('empty');
        city.removeClass('empty');
    }
    if (tech.length == 0) {
        e.preventDefault();
        $(this).find('.typeTitle').addClass('empty');
        // tech.addClass('empty');
    }

})

$(document).ready(function () {
    let hash = window.location.hash;
    hash = hash.split('#');
    let link = $('.profile-company-menu').find('a[href*=' + hash[1] + ']');
    link.trigger('click');
});

$(document).on('change', '.changeImg', function (e) {
    let a = $('#image')[0].files[0];
    $('.changeImg-parent').attr('src', URL.createObjectURL(a));
})

$(document).on('click', '.cityItem', function (e) {
    if ($(this).hasClass('cityActive')) {
        $(this).removeClass('cityActive');
    } else {
        $('.cityItem').removeClass('cityActive');
        $(this).addClass('cityActive');
    }
})
$(document).on('click', '.selectFilterPrice', function (e) {
    if ($(this).hasClass('selectFilterPriceActive')) {
        $(this).removeClass('selectFilterPriceActive');
    } else {
        $('.selectFilterPrice').removeClass('selectFilterPriceActive');
        $(this).addClass('selectFilterPriceActive');
    }
})

$('.filterStart').click(function (e) {
    let filter = $('#checkFilter')[0].checked;
    let city = $('.cityActive').attr('data-id');
    let space
    let checkboxes = $('.workspace');
    for (let index = 0; index < checkboxes.length; index++) {
        if (checkboxes[index].checked) {
            space = checkboxes[index].value;
        }
    }
    let lvl = $('.level')
    let lvlid;
    for (let index = 0; index < lvl.length; index++) {
        if (lvl[index].checked) {
            lvlid = lvl[index].value;
        }
    }
    let price = $('.selectFilterPriceActive').attr('data-val');
    let text = $('.searchQuery').val()
    $.ajax({
        method:'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/search',
        data:{
            filterOn:filter,
            city:city,
            workspace:space,
            level:lvlid,
            price:price,
            query:text
        },
        success:(res)=>{
            $('.forSearchBody').html(res.view);
        }
    })

})

$('.backBtnBody').click(function (e) {
    history.back();
})

$('.homeSearch').click(function(e){
        // cityHome,homeQuery
    let query = $('.homeQuery').val();
    let city = $('.cityHome').val();

    if(query == '' || city == null){
        popup.fire({
            title:'Введіть назву вакансії та виберіть місто'
        })
    }else{
        location.href = '/all-advert?mainSearch=true&query='+query+"&city="+city;
    }

})


$(document).on('click','.selectAdvert',function (e) {

        let id = $(this).attr('data-id');
        let curr = $(this);
        $.ajax({
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/changeselectAdvert',
            data:{
                id:id
            },
            success:(res)=>{
                if(res.add){
                    curr.removeClass('far')
                    curr.addClass('fas')
                }else{
                    curr.addClass('far')
                    curr.removeClass('fas')
                }
            }
        })

})
