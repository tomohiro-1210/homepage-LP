<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ラジオボタンで選択したデータを取得
    $applicationType = $_POST["applicationType"]; // 応募種別
    $hope_plan = $_POST["hope_plan"]; // 希望プラン
    $apply = $_POST["apply"]; // ご応募内容

    // テキスト欄から受け取ったデータを取得
    $company_name = $_POST['company_name']; //会社名
    $pic = $_POST['pic']; //担当者名
    $furigana = $_POST['furigana']; //フリガナ
    $url = $_POST['url']; //URL
    $mail_address = $_POST['mail_address']; //メールアドレス
    $tel = $_POST['tel']; //電話番号
    $prefectures = $_POST['prefectures']; //都道府県
    $remarks = $_POST['remarks']; //備考

    // 応募種別が入っていないときの処理
    if(!empty($applicationType) && !empty($applicationType)){
        $applicationType_total = 1;
    }else{
        // エラー出力文
        $applicationType_error = '応募種別が選択されていません';
    }

    // 希望プランが入っていないときの処理
    if(!empty($hope_plan) && !empty($hope_plan)){
        $hope_plan_total = 1;
    }else{
        // エラー出力文
        $hope_plan_error = '希望プランが選択されていません';
    }

    // ご応募内容が入っていないときの処理
    if(!empty($apply) && !empty($apply)){
        $apply_total = 1;
    }else{
        // エラー出力文
        $apply_error = 'ご応募内容が選択されていません';
    }

    // 会社名が入っていない時の処理
    if(!empty($company_name) && !empty($company_name)){
        $company_name_total = 1;
    }else{
        // エラー出力文
        $company_name_error = '会社名が入力されていません';
    }

    // 担当者名が入っていない時の処理
    if(!empty($pic) && !empty($pic)){
        $pic_total = 1;
    }else{
        // エラー出力文
        $pic_error = '担当者名が入力されていません';
    }

    // フリガナが入っていない時の処理
    if(!empty($furigana) && !empty($furigana)){
        $furigana_total = 1;
    }else{
        // エラー出力文
        $furigana_error = 'フリガナが入力されていません';
    }

    // メールアドレスが入っていない時の処理
    if(!empty($mail_address) && !empty($mail_address)){
        $mail_address_total = 1;
    }else{
        // エラー出力文
        $mail_address_error = 'メールアドレスが入力されていません';
    }

    // 電話番号が入っていない時の処理
    if(!empty($tel) && !empty($tel)){
        $tel_total = 1;
    }else{
        // エラー出力文
        $tel_error = '電話番号が入力されていません';
    }

    // 都道府県が入っていない時の処理
    if(!empty($prefectures) && !empty($prefectures)){
        $prefectures_total = 1;
    }else{
        // エラー出力文
        $prefectures_error = '都道府県が入力されていません';
    }

    // エラーのトータル表示
    $no_error = $applicationType_total + $hope_plan_total + $apply_total + $company_name_total + $pic_total + $furigana_total + $mail_address_total + $tel_total + $prefectures_total;
    $empty_total = 9 - $no_error;




    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- style.css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- animate.css -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css"
    />
    <!-- wow.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <title>アステリスク</title>
</head>
<body>
    <!-- lp本体 -->
    <div class="lp-wrap">
        <!-- header -->
        <header class="l-header">
            <div class="l-header__contain">
                <p class="l-header__logo">＊</p>
                <h1 class="l-header__name">ASTERISK</h1>
                <div class="l-header__hamburger">
                    <span></span>
                    <span></span>
                    <p class="l-header__menu">MENU</p>
                </div>
            </div>
        </header>
        <main>
            <!-- スマホメニュー -->
            <div class="sp-menu">
                <ul class="sp-menu__list">
                    <li class="sp-menu__item">
                        <a href="#desire">
                            <span class="sp-menu__number">01</span>
                            <span class="sp-menu__name">アステリスクとは</span>
                        </a>
                    </li>
                    <li class="sp-menu__item">
                        <a href="#why">
                            <span class="sp-menu__number">02</span>
                            <span class="sp-menu__name">秘密</span>
                        </a>
                    </li>
                    <li class="sp-menu__item">
                        <a href="#flow">
                            <span class="sp-menu__number">03</span>
                            <span class="sp-menu__name"><span class="mark">＊</span>の強み</span>
                        </a>
                    </li>
                    <li class="sp-menu__item">
                        <a href="#development">
                            <span class="sp-menu__number">04</span>
                            <span class="sp-menu__name">納品の流れ</span>
                        </a>
                    </li>
                    <li class="sp-menu__item">
                        <a href="#plan">
                            <span class="sp-menu__number">05</span>
                            <span class="sp-menu__name">プラン/料金</span>
                        </a>
                    </li>
                    <li class="sp-menu__item">
                        <a href="#company">
                            <span class="sp-menu__number">06</span>
                            <span class="sp-menu__name">会社概要</span>
                        </a>
                    </li>
                </ul>
    
                <!-- お問い合わせ誘導ボタン -->
                <div class="entry-contact">
                    <div class="entry-contact__item">
                        <p class="entry-contact__word">＞ まずはご相談 & 開発依頼</p>
                        <div class="entry-contact__button">
                            <a href="#entry" class="entry-contact__button__text">
                                <span class="entry-contact__button__text--en">ENTRY</span>
                                <span class="entry-contact__button__text--ja">ご応募</span>
                            </a>
                        </div>
                    </div>
                    <div class="entry-contact__item">
                        <p class="entry-contact__word">＞ その他ご質問・お問い合わせ</p>
                        <div class="entry-contact__button">
                            <a href="#contact" class="entry-contact__button__text">
                                <span class="entry-contact__button__text--en">CONTACT</span>
                                <span class="entry-contact__button__text--ja">お問い合わせ</span>
                            </a>
                        </div>
                    </div>
                </div>
    
                <!-- follow-me -->
                <div class="follow-me">
                    <div class="follow-me__up">
                        <p class="follow-me__catch">FOLLOW ME!</p>
                    </div>
                    <div class="follow-me__under">
                        <div class="follow-me__btn follow-me__btn--line"><a href="https://lin.ee/NBiZPO2"><img src="./assets/img/sns-line.png" alt="line">LINE</a></div>
                        <div class="follow-me__btn follow-me__btn--instagram"><a href="https://www.instagram.com/link___japan"><img src="./assets/img/sns-instagram.png" alt="instagram">Instagram</a></div>
                    </div>
                </div><!-- /follow-me -->
            </div><!-- /スマホメニュー -->

            <!-- fv -->
            <div class="fv">
                <div class="fv__area">
                    <div class="fv__img">
                        <img src="./assets/img/fv-roppongi.png" alt="六本木">
                    </div>
                    <div class="fv__arrow">
                        <img src="./assets/img/fv-scroll.png" alt="scroll">
                    </div>
                </div>
            </div>
            <!-- /fv -->

            <!-- entry -->
            <section class="entry" id="entry">
                <h2 class="sec-title box wow animated fadeInUp">
                    <span class="sec-title--en">ENTRY</span>
                    <span class="sec-title--ja">ご応募はLINE、DM、下記エントリーフォームの<br>
                        いずれかで必要事項記入の上、送信をお願いします。</span>
                </h2>
                <!-- フォーム -->
                <!-- <form method="post" action="mail.php" class="entry__form box wow animated fadeInUp" id="contact"> -->
                <form method="post" class="entry__form box wow animated fadeInUp" id="contact">
                    <div class="entry__form__radio">
                        <div class="entry__form__inputitems">
                            <p class="entry__form__inputitem">応募種別*</p>
                            <label class="entry__form__label">
                                <input type="radio" name="applicationType" value="BtoB" required> BtoB
                            </label>
                            <label class="entry__form__label">
                                <input type="radio" name="applicationType" value="BtoC" required> BtoC
                            </label>
                        </div>
                        <p class="error-text"><?php echo  $applicationType_error;?></p>

                        <div class="entry__form__inputitems">
                            <p class="entry__form__inputitem">希望プラン*</p>
                            <label class="entry__form__label">
                                <input type="radio" name="hope_plan" value="スタンダード" required> スタンダード
                            </label>
                            <label class="entry__form__label">
                                <input type="radio" name="hope_plan" value="プレミアム" required> プレミアム
                            </label>
                        </div>

                        <div class="entry__form__inputitems">
                            <p class="entry__form__inputitem">ご応募内容*</p>
                            <label class="entry__form__label">
                                <input type="radio" name="apply" value="開発依頼" required> 開発依頼
                            </label>
                            <label class="entry__form__label">
                                <input type="radio" name="apply" value="面接希望" required> 面接希望
                            </label>
                        </div>

                    </div>
                
                    <p for="company_name" class="entry__form__name">会社名*</p>
                    <input type="text" id="company_name" name="company_name" class="entry__form__textbox">
                    <p class="error-text"><?php echo  $company_name_error;?></p>
                
                    <p for="pic" class="entry__form__name">担当者名*</p>
                    <input type="text" id="pic" name="pic" class="entry__form__textbox">
                    <p class="error-text"><?php echo  $pic_error;?></p>
                
                    <p for="furigana" class="entry__form__name">フリガナ*</p>
                    <input type="text" id="furigana" name="furigana" class="entry__form__textbox">
                    <p class="error-text"><?php echo  $furigana_error;?></p>
                
                    <p for="url" class="entry__form__name">WebサイトURL</p>
                    <input type="text" id="url" name="url" class="entry__form__textbox">
                
                    <p for="mail_address" class="entry__form__name">メールアドレス*</p>
                    <input type="text" id="mail_address" name="mail_address" class="entry__form__textbox">
                    <p class="error-text"><?php echo  $mail_address_error;?></p>
                
                    <p for="tel" class="entry__form__name">お電話番号*</p>
                    <input type="text" id="tel" name="tel" class="entry__form__textbox">
                    <p class="error-text"><?php echo  $tel_error;?></p>
                
                    <p for="prefectures" class="entry__form__name">都道府県*</p>
                    <input type="text" id="prefectures" name="prefectures" class="entry__form__textbox">
                    <p class="error-text"><?php echo  $prefectures_error;?></p>
                
                    <p for="remarks" class="entry__form__name">備考</p>
                    <textarea name="remarks" id="remarks" cols="30" placeholder="ご希望日時などありましたらご記入ください。" rows="10" class="entry__form__textarea"></textarea>
                    
                    <p class="entry__form__button">
                        <button type="submit">＞　確　認</button>
                    </p>
                </form>
            </section><!-- /entry -->
    </div>

    <!-- jquery/js -->
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script src="./assets/js/common.js"></script>
    <script>
        new WOW().init();
    </script>

</body>
</html>