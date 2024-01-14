// headerのハンバーガーメニュー
$(".l-header__hamburger").click(function () {
    $(this).toggleClass('open');
    $(".sp-menu").toggleClass('open');
});

// lp-topのfaq
$(".faq__question--1").click(function() {
    $(".faq__answer--1").slideToggle();
});
$(".faq__question--2").click(function() {
    $(".faq__answer--2").slideToggle();
});
$(".faq__question--3").click(function() {
    $(".faq__answer--3").slideToggle();
});
$(".faq__question--4").click(function() {
    $(".faq__answer--4").slideToggle();
});
