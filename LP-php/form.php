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
                <form method="post" action="contact-confirm.php" class="entry__form box wow animated fadeInUp" id="contact">
                    <div class="entry__form__radio">
                        <p class="error-text" style="text-align: center; font-size: 18px;"><?php echo  $total;?></p>
                        <!-- 応募種別 -->
                        <div class="entry__form__inputitems">
                            <p class="entry__form__inputitem">応募種別*</p>
                            <label class="entry__form__label">
                                <input type="radio" name="applicationType" value="BtoB" <?php echo (isset($applicationType) && $applicationType === 'BtoB') ? 'checked' : ''; ?> required> BtoB
                            </label>
                            <label class="entry__form__label">
                                <input type="radio" name="applicationType" value="BtoC" <?php echo (isset($applicationType) && $applicationType === 'BtoC') ? 'checked' : ''; ?> required> BtoC
                            </label>
                        </div>
  
                        <!-- 希望プラン -->
                        <div class="entry__form__inputitems">
                            <p class="entry__form__inputitem">希望プラン*</p>
                            <label class="entry__form__label">
                                <input type="radio" name="hope_plan" value="スタンダード" <?php echo (isset($hope_plan) && $hope_plan === 'スタンダード') ? 'checked' : ''; ?> required> スタンダード
                            </label>
                            <label class="entry__form__label">
                                <input type="radio" name="hope_plan" value="プレミアム" <?php echo (isset($hope_plan) && $hope_plan === 'プレミアム') ? 'checked' : ''; ?> required> プレミアム
                            </label>
                        </div>

                        <!-- ご応募内容 -->
                        <div class="entry__form__inputitems">
                            <p class="entry__form__inputitem">ご応募内容*</p>
                            <label class="entry__form__label">
                                <input type="radio" name="apply" value="開発依頼" <?php echo (isset($apply) && $apply === '開発依頼') ? 'checked' : ''; ?> required> 開発依頼
                            </label>
                            <label class="entry__form__label">
                                <input type="radio" name="apply" value="面接希望" <?php echo (isset($apply) && $apply === '面接希望') ? 'checked' : ''; ?> required> 面接希望
                            </label>
                        </div>


                    </div>
                
                    <!-- 会社名 -->
                    <p for="company_name" class="entry__form__name">会社名*</p>
                    <input type="text" id="company_name" name="company_name" class="entry__form__textbox" value="<?php echo isset($company_name) ? htmlspecialchars($company_name) : ''; ?>">
                
                    <!-- 担当者名 -->
                    <p for="pic" class="entry__form__name">担当者名*</p>
                    <input type="text" id="pic" name="pic" class="entry__form__textbox" value="<?php echo isset($pic) ? htmlspecialchars($pic) : ''; ?>">

                    <!-- フリガナ -->
                    <p for="furigana" class="entry__form__name">フリガナ*</p>
                    <input type="text" id="furigana" name="furigana" class="entry__form__textbox" value="<?php echo isset($furigana) ? htmlspecialchars($furigana) : ''; ?>">

                    <!-- WebサイトURL -->
                    <p for="url" class="entry__form__name">WebサイトURL</p>
                    <input type="text" id="url" name="url" class="entry__form__textbox" value="<?php echo isset($url) ? htmlspecialchars($url) : ''; ?>">

                    <!-- メールアドレス -->
                    <p for="mail_address" class="entry__form__name">メールアドレス*</p>
                    <input type="text" id="mail_address" name="mail_address" class="entry__form__textbox" value="<?php echo isset($mail_address) ? htmlspecialchars($mail_address) : ''; ?>">

                    <!-- お電話番号 -->
                    <p for="tel" class="entry__form__name">お電話番号*</p>
                    <input type="text" id="tel" name="tel" class="entry__form__textbox" value="<?php echo isset($tel) ? htmlspecialchars($tel) : ''; ?>">

                    <!-- 都道府県 -->
                    <p for="prefectures" class="entry__form__name">都道府県*</p>
                    <input type="text" id="prefectures" name="prefectures" class="entry__form__textbox" value="<?php echo isset($prefectures) ? htmlspecialchars($prefectures) : ''; ?>">

                    <!-- 備考 -->
                    <p for="remarks" class="entry__form__name">備考</p>
                    <textarea name="remarks" id="remarks" cols="30" placeholder="ご希望日時などありましたらご記入ください。" rows="10" class="entry__form__textarea"><?php echo isset($remarks) ? htmlspecialchars($remarks) : ''; ?></textarea>

                    <!-- 送信ボタン -->
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