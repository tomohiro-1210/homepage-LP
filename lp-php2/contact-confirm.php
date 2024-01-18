<?php 
    // 会社名が入っていない時の処理
    if(!empty($_POST['会社名'])){
        $company_name_total = 1;
    }else{
        // エラー出力文
        $company_name_error = '会社名が入力されていません';
    }

    // 担当者名が入っていない時の処理
    if(!empty($_POST['担当者名'])){
        $pic_total = 1;
    }else{
        // エラー出力文
        $pic_error = '担当者名が入力されていません';
    }

    // フリガナが入っていない時の処理
    if(!empty($_POST['フリガナ'])){
        $furigana_empty_total = 1;
    }else{
        // エラー出力文
        $furigana_empty_error = 'フリガナが入力されていません';
    }

    // フリガナがカタカナで入っていないかを判定する処理
    if (preg_match("/^[ァ-ヶー　]+$/u", $_POST['フリガナ'])) {
        $firigana_match_total = 1;
    } else {
        $furigana_match_error = "フリガナはカタカナで入力してください";
    }

    // メールアドレスが入っていない時の処理
    if(!empty($_POST['メールアドレス'])){
        $mail_address_empty_total = 1;
    }else{
        // エラー出力文
        $mail_address_empty_error = 'メールアドレスが入力されていません';
    }

    // メールアドレスの形式が正しいかチェック
    if (filter_var($_POST['メールアドレス'], FILTER_VALIDATE_EMAIL)) {
        $mail_address_match_total = 1;
    }else{
        $mail_address_match_error = "メールアドレスは正しい入力形式を使ってください";
    }

    // 電話番号が入っていない時の処理
    if(!empty($_POST['お電話番号'])){
        $tel_empty_total = 1;
    }else{
        // エラー出力文
        $tel_empty_error = 'お電話番号が入力されていません';
    }

    // 電話番号が半角英数字であるかチェック
    if (ctype_digit($_POST['お電話番号'])) {
        $tel_match_total = 1;
    }else{
        // エラー出力文
        $tel_match_error = "お電話番号は半角英数字<br>(ハイフン抜き)で入力してください";
    }

    // 都道府県が入っていない時の処理
    if(!empty($_POST['都道府県'])){
        $prefectures_total = 1;
    }else{
        // エラー出力文
        $prefectures_error = '都道府県が入力されていません';
    }

    // エラーのトータル表示
    $no_error = 
     $company_name_total + 
     $pic_total + 
     $furigana_empty_total + 
     $firigana_match_total + 
     $mail_address_empty_total + 
     $mail_address_match_total + 
     $tel_empty_total + 
     $tel_match_total + 
     $prefectures_total;

    
    // 上記のエラーを全て足して、エラーを出すか、メールを送るかを判断している
    if($no_error != 9){ 
            $total_error = '入力されていない必須項目または<br>修正する項目があります<br>お問い合わせフォームに戻ってください';
    }else {
        $total_error = '以下の内容で送信します。<br>よろしければ確認ボタンを押してください。';
        // $to = "express22212270@gmail.com"; // 送信先のメールアドレス
        // $subject = "お問い合わせがありました"; // メールの件名

        // // メール本文の作成
        // $message = "応募種別: $applicationType\n";
        // $message .= "希望プラン: $hope_plan\n";
        // $message .= "ご応募内容: $apply\n";
        // // 以下同様に各項目を追加

        // $headers = "From: sender@example.com"; // 送信元のメールアドレス

        // // メール送信
        // if (mail($to, $subject, $message, $headers)) {
        //     $mail_send = "お問い合わせが送信されました。";
        // } else {
        //     $mail_send = "お問い合わせの送信に失敗しました。";
        // }
    }


    // 確認欄から受け取ったデータを取得する
    // 応募種別
    $applicationType = isset($_POST["applicationType"]) ? htmlspecialchars($_POST["applicationType"]) : "";

    // 希望プラン
    $hope_plan = isset($_POST["hope_plan"]) ? htmlspecialchars($_POST["hope_plan"]) : "";

    // ご応募内容
    $apply = isset($_POST["apply"]) ? htmlspecialchars($_POST["apply"]) : "";

    // 会社名
    $company_name = isset($_POST["company_name"]) ? htmlspecialchars($_POST["company_name"]) : "";

    // 担当者名
    $pic = isset($_POST["pic"]) ? htmlspecialchars($_POST["pic"]) : "";

    // フリガナ
    $furigana = isset($_POST["furigana"]) ? htmlspecialchars($_POST["furigana"]) : "";

    // WebサイトURL
    $url = isset($_POST["url"]) ? htmlspecialchars($_POST["url"]) : "";

    // メールアドレス
    $mail_address = isset($_POST["mail_address"]) ? htmlspecialchars($_POST["mail_address"]) : "";

    // 電話番号
    $tel = isset($_POST["tel"]) ? htmlspecialchars($_POST["tel"]) : "";

    // 都道府県
    $prefectures = isset($_POST["prefectures"]) ? htmlspecialchars($_POST["prefectures"]) : "";

    // 備考
    $remarks = isset($_POST["remarks"]) ? htmlspecialchars($_POST["remarks"]) : "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームからのデータを取得
        $subject = "メールフォームより";
        
        $message = "この度はお問合せいただきありがとうございます。" . "\n";
        $message .= "下記の内容でお問い合わせを受け付けました。" . "\n"."\n";
        $message .= "応募種別: " . $_POST['応募種別'] . "\n";
        $message .= "希望プラン: " . $_POST['希望プラン'] . "\n";
        $message .= "ご応募内容: " . $_POST['ご応募内容'] . "\n"."\n";
        $message .= "会社名: " . $_POST['会社名'] . "\n";
        $message .= "担当者名: " . $_POST['担当者名'] . "\n";
        $message .= "フリガナ: " . $_POST['フリガナ'] . "\n";
        $message .= "WebサイトURL: " . $_POST['WebサイトURL'] . "\n";
        $message .= "メールアドレス: " . $_POST['メールアドレス'] . "\n";
        $message .= "お電話番号: " . $_POST['お電話番号'] . "\n";
        $message .= "都道府県: " . $_POST['都道府県'] . "\n"."\n";
        $message .= "備考: " . $_POST['text'] . "\n"."\n";
        $message .= "株式会社LINK　赤星智大";
    
        $to = "express22212270@gmail.com"; // 送信先のメールアドレス
        $headers = "From: " . $_POST['メールアドレス']; // 送信元のメールアドレス
    
        // メール送信
        if (mail($to, $subject, $message, $headers)) {
            $mail_success = "お問い合わせが送信されました。";
        } else {
            $mail_success = "お問い合わせの送信に失敗しました。";
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style.css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>お問い合わせ確認</title>
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
                            <a href="#" class="entry-contact__button__text">
                                <span class="entry-contact__button__text--en">ENTRY</span>
                                <span class="entry-contact__button__text--ja">ご応募</span>
                            </a>
                        </div>
                    </div>
                    <div class="entry-contact__item">
                        <p class="entry-contact__word">＞ その他ご質問・お問い合わせ</p>
                        <div class="entry-contact__button">
                            <a href="#" class="entry-contact__button__text">
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
                </div>
                <!-- /follow-me -->
            </div>

            <!-- contact -->
            <h2 class="contact-title">#CONTACT</h2>
        <!-- フォーム確認 -->
            <form class="contact-confirm">

                <div class="error-wrap">
                    <p class="error-text"><?php echo $company_name_error; ?></p>
                    <p class="error-text"><?php echo $pic_error; ?></p>
                    <p class="error-text"><?php echo $furigana_empty_error; ?></p>
                    <p class="error-text"><?php echo $furigana_match_error; ?></p>
                    <p class="error-text"><?php echo $mail_address_empty_error; ?></p>
                    <p class="error-text"><?php echo $mail_address_match_error; ?></p>
                    <p class="error-text"><?php echo $tel_empty_error; ?></p>
                    <p class="error-text"><?php echo $tel_match_error; ?></p>
                    <p class="error-text"><?php echo $prefectures_error; ?></p>
                    <p class="error-text"><?php echo $total_error;?></p>
                    <p class="error-text"><?php echo $mail_success;?></p>
                </div>

                <table class="contact-confirm__table">

                    <!-- 送信内容確認 -->
                    <p class="contact-confirm__p">送信内容確認</p>

                    <!-- 応募種別 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">応募種別*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['応募種別']; ?></td>
                    </tr><!-- /応募種別 -->

                    <!-- 希望プラン -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">希望プラン*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['希望プラン']; ?></td>
                    </tr><!-- /希望プラン -->

                    <!-- ご応募内容 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">ご応募内容*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['ご応募内容']; ?></td>
                    </tr><!-- /ご応募内容 -->

                    <!-- 会社名 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">会社名*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['会社名']; ?></td>
                    </tr><!-- /会社名 -->

                    <!-- 担当者名 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">担当者名*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['担当者名']; ?></td>
                    </tr><!-- /担当者名 -->

                    <!-- フリガナ -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">フリガナ*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['フリガナ']; ?></td>
                    </tr><!-- /フリガナ -->

                    <!-- WebサイトURL -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">WebサイトURL</th>
                        <td class="contact-confirm__text"><?php echo $_POST['WebサイトURL']; ?></td>
                    </tr><!-- /WebサイトURL -->

                    <!-- メールアドレス -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">メールアドレス*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['メールアドレス']; ?></td>
                    </tr><!-- /メールアドレス -->

                    <!-- お電話番号 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">お電話番号(ハイフン抜き)*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['お電話番号']; ?></td>
                    </tr><!-- /お電話番号 -->

                    <!-- 都道府県 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">都道府県*</th>
                        <td class="contact-confirm__text"><?php echo $_POST['都道府県']; ?></td>
                    </tr><!-- /都道府県 -->

                    <!-- 備考 -->
                    <tr class="contact-confirm__item">
                        <th class="contact-confirm__title">備考</th>
                        <td class="contact-confirm__text"><?php echo $_POST['text']; ?>
                        </td>
                    </tr><!-- /備考 -->

                </table>

                <!-- お問い合わせページの場所 -->
                <div class="contact-flow">
                    <div class="contact-flow__position">入力</div>
                    <div class="contact-flow__line"></div>
                    <div class="contact-flow__position show">確認</div>
                    <div class="contact-flow__line"></div>
                    <div class="contact-flow__position">完了</div>
                </div>

                    <!-- ボタン 確認 -->
                    <form method="post" action="contact-complete.php" class="contact-confirm__item">
                        <input class="contact-confirm__riset-submit" type="submit" value="＞　確　認　"><!-- /ボタン 確認 -->
                    </form>
                
            </form>
        <!-- /フォーム確認 -->

        <!-- follow-me -->
        <section class="follow-me">
            <div class="follow-me__up">
                <p class="follow-me__catch">FOLLOW ME!</p>
            </div>
            <div class="follow-me__under">
                <div class="follow-me__btn follow-me__btn--line"><a href="#"><img src="./assets/img/sns-line.png" alt="line">LINE</a></div>
                <div class="follow-me__btn follow-me__btn--instagram"><a href="#"><img src="./assets/img/sns-instagram.png" alt="instagram">Instagram</a></div>
            </div>
        </section>

        <!-- アスタリスクとメニュー -->
        <div class="asterisk-under">
            <div class="asterisk-under__wrap">
                <p class="asterisk-under__logo">*</p>
                <p class="asterisk-under__title--big">asterisk</p>
                <p class="asterisk-under__title--little">アステリスク LP SITE</p>
            </div>
            <ul class="asterisk-under__menu">
                <li class="asterisk-under__list">
                    <a href="#desire">アステリスクとは</a>ステステ
                </li>
                <li class="asterisk-under__list">
                    <a href="#why">秘密</a>
                </li>
                <li class="asterisk-under__list">
                    <a href="#flow">＊の強み</a>
                </li>
                <li class="asterisk-under__list">
                    <a href="#development">納品までの流れ</a>
                </li>
                <li class="asterisk-under__list">
                    <a href="#plan">プラン/料金</a>
                </li>
                <li class="asterisk-under__list">
                    <a href="#company">会社概要</a>
                </li>
            </ul>
        </div>

        <!-- お問い合わせ誘導ボタン -->
        <section class="entry-contact">
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
        </section>

        </main>

        <!-- footer -->
        <footer class="l-footer">
            <ul class="l-footer__sns">
                <li class="l-footer__sns__item">
                    <a href="https://twitter.com/kazuto_1618">
                        <img src="./assets/img/sns-twitter.png" alt="twitter">
                    </a>
                </li>
                <li class="l-footer__sns__item">
                    <a href="https://www.instagram.com/link___japan">
                        <img src="./assets/img/sns-instagram.png" alt="instagram">
                    </a>
                </li>
                <li class="l-footer__sns__item">
                    <a href="https://lin.ee/NBiZPO2">
                        <img src="./assets/img/sns-line.png" alt="line">
                    </a>
                </li>
            </ul>
            <p class="l-footer__copy">Copyright © アステリスク all rights reserved.</p>
        </footer>
    </div>

    <!-- jquery/js -->
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script src="./assets/js/common.js"></script>

</body>
</html>