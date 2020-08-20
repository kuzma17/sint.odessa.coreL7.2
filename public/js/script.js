/**
 * Created by kuzma on 09.04.17.
 */

$('.carousel-slogan').html($('.carousel-inner .active a').attr('title'));
$('.carousel').on('slide.bs.carousel', function (e) {
    $('.carousel-slogan').html(e.relatedTarget.children[0].title);
});

$('.edit_panel').hide();
$('.avatar').hover(function() {
    $('.edit_panel').toggle();
});

$('#avatar').on('change', function(){
    $('.avatar-upload').attr('data-text', $(this).val());
});

$('#client_company').click(function () {
    $('#name_account').html('Компания <span class="red">*</span>');
    $('input[name="client_name"]').attr('placeholder', 'Краткое наименование организации.');
    $('.client_company').animate({height: "show"}, 500);
});
$('#client_user').click(function () {
    $('#name_account').html('ФИО <span class="red">*</span>');
    $('input[name="client_name"]').attr('placeholder', 'Фамилия Имя Отчество.');
    $('.client_company').animate({height: "hide"}, 500);
});

$('#payment_b_nal').click(function () {
    $('.payment_b_nal').animate({height: "show"}, 500);
    $('.payment_nds').animate({height: "hide"}, 500);
});
$('#payment_nds').click(function () {
    $('.payment_b_nal').animate({height: "show"}, 500);
    $('.payment_nds').animate({height: "show"}, 500);
});
$('#payment_nal').click(function () {
    $('.payment_b_nal').animate({height: "hide"}, 500);
    $('.payment_nds').animate({height: "hide"}, 500);
});

$('.type_company').click(function () {
    $('.name_account').html('Компания <span class="red">*</span>');
    $('input[name="order_client_name"]').attr('placeholder', 'Краткое наименование организации.');
    $('#all_order').show();
    $('.client_company_order').animate({height: "show"}, 500);
});
$('.type_user').click(function () {
    $('.name_account').html('ФИО <span class="red">*</span>');
    $('input[name="order_client_name"]').attr('placeholder', 'Фамилия Имя Отчество.');
    $('#all_order').hide();
    $('.client_company_order').animate({height: "hide"}, 500);
});

if ($('.error_login_message').length > 0) {
    $('#login-dp').show();
}

