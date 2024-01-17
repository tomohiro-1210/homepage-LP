jQuery(function($) {
    // ページトップボタン
    var topBtn = $(".js-pagetop");
    topBtn.hide();

    // ページトップボタンの表示設定
    $(window).scroll(function() {
        if ($(this).scrollTop() > 70) {
            // 指定px以上のスクロールでボタンを表示
            topBtn.fadeIn();
        } else {
            // 画面が指定pxより上ならボタンを非表示
            topBtn.fadeOut();
        }
    });

    // ページトップボタンをクリックしたらスクロールして上に戻る
    topBtn.click(function() {
        $("body,html").animate({
                scrollTop: 0,
            },
            300,
            "swing"
        );
        return false;
    });

    // スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動。ヘッダーの高さ考慮。)
    $(document).on("click", 'a[href*="#"]', function() {
        let time = 400;
        let header = $("header").innerHeight();
        let target = $(this.hash);
        if (!target.length) return;
        let targetY = target.offset().top - header;
        $("html,body").animate({ scrollTop: targetY }, time, "swing");
        return false;
    });

    $(".p-header__hamburger").click(function() {
        $(".js-drawer-open").toggleClass("open");
        $(".p-header__drawer").toggleClass("open");
        $(".p-footer").toggleClass("open");
        $("html").toggleClass("is-fixed");
    }); //
    $(".p-header__drawer-nav-item a, .p-cv__entry").click(function() {
        $(".p-header__drawer").removeClass("open");
        $(".js-drawer-open").removeClass("open");
    }); //

    $(function() {
        $("p-job__img2").on("click", function() {
            $(".p-job__panel, .p-job__img2").removeClass("active");

            $(this).addClass("active");

            var index = $(".p-job__img2").index(this);
            $(".p-job__panel").eq(index).addClass("active");
        });
    });
});

$(function() {
    $(".tab").on("click", function() {
        $(".tab, .panel").removeClass("active");
        $(this).addClass("active");
        var index = $(".tab").index(this);
        $(".panel").eq(index).addClass("active");
    });
});

$(function() {
    $(".js-accordion-title").on("click", function() {
        $(".js-accordion-title").not(this).removeClass("open");
        $(".js-accordion-title").not(this).next().slideUp(300);
        $(this).toggleClass("open");
        $(this).next().slideToggle(300);
    });
});
$(function() {
    $(".p-requirements__items").on("click", function() {
        $(".p-requirements__items, .p-requirements__list").removeClass("active");
        $(this).addClass("active");
        var index = $(".p-requirements__items").index(this);
        $(".p-requirements__list").eq(index).addClass("active");
    });
});

$(function() {
    $(".p-company__button").click(function() {
        $(this).toggleClass("active");
        $(this).prev(".p-company-pull__history").slideToggle();
    });
});

// モーダル
$(function() {
    $(".p-voice__card").on("click", function() {
        let modalTarget = $(this).data("target");
        let modal = document.querySelector("." + modalTarget);
        $(modal).toggleClass("is-show");
    });
    $(".p-modal__close").on("click", function() {
        $(this).parents(".p-modal").toggleClass("is-show");
    });
});

// フェードイン
$(window).scroll(function() {
    $(".slide").each(function() {
        let trigger_point = $(this).offset().top - $(window).height() / 1.5;

        if ($(window).scrollTop() > trigger_point) {
            $(this).addClass("in");
        } else {}
    });
});