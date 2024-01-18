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
// planのタブ切り替え
$(document).ready(function () {
    // 初期状態では最初のタブをアクティブにする
    $('.plan__tab:first').addClass('active');
    $('.plan__menu:first').addClass('active');

    // タブがクリックされたときの処理
    $('.plan__tab').on('click', function () {
        // すべてのタブとコンテンツから active クラスを削除
        $('.plan__tab').removeClass('active');
        $('.plan__menu').removeClass('active');

        // クリックされたタブに active クラスを追加
        var tabId = $(this).data('tab');
        $('#' + tabId).addClass('active');
        $(this).addClass('active');
    });
});