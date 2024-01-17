<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php //error_reporting(E_ALL | E_STRICT);
##-----------------------------------------------------------------------------------------------------------------##
#
#  PHPメールプログラム　フリー版 ver2.0.3 最終更新日2022/02/01
#　改造や改変は自己責任で行ってください。
#	
#  HP: http://www.php-factory.net/
#
#  重要！！サイトでチェックボックスを使用する場合のみですが。。。
#  チェックボックスを使用する場合はinputタグに記述するname属性の値を必ず配列の形にしてください。
#  例　name="当サイトをしったきっかけ[]"  として下さい。
#  nameの値の最後に[と]を付ける。じゃないと複数の値を取得できません！
#
##-----------------------------------------------------------------------------------------------------------------##
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {//PHP5.1.0以上の場合のみタイムゾーンを定義
	date_default_timezone_set('Asia/Tokyo');//タイムゾーンの設定（日本以外の場合には適宜設定ください）
}
/*-------------------------------------------------------------------------------------------------------------------
* ★以下設定時の注意点　
* ・値（=の後）は数字以外の文字列（一部を除く）はダブルクオーテーション「"」、または「'」で囲んでいます。
* ・これをを外したり削除したりしないでください。後ろのセミコロン「;」も削除しないください。
* ・また先頭に「$」が付いた文字列は変更しないでください。数字の1または0で設定しているものは必ず半角数字で設定下さい。
* ・メールアドレスのname属性の値が「Email」ではない場合、以下必須設定箇所の「$Email」の値も変更下さい。
* ・name属性の値に半角スペースは使用できません。
*以上のことを間違えてしまうとプログラムが動作しなくなりますので注意下さい。
-------------------------------------------------------------------------------------------------------------------*/


//---------------------------　必須設定　必ず設定してください　-----------------------

//サイトのトップページのURL　※デフォルトでは送信完了後に「トップページへ戻る」ボタンが表示されますので
$site_top = "https://hair-resort-ai.com/";

//管理者のメールアドレス ※メールを受け取るメールアドレス(複数指定する場合は「,」で区切ってください 例 $to = "aa@aa.aa,bb@bb.bb";)
$to = "koto@hairresort-ai.com";

//送信元メールアドレス（管理者宛て、及びユーザー宛メールの送信元メールアドレスです）
//必ず実在するメールアドレスでかつ出来る限り設置先サイトのドメインと同じドメインのメールアドレスとすることを強く推奨します
//管理者宛てメールの返信先（reply）はユーザーのメールアドレスになります。
$from = "koto@hairresort-ai.com";

//フォームのメールアドレス入力箇所のname属性の値（name="○○"　の○○部分）
$Email = "メールアドレス";
//---------------------------　必須設定　ここまで　------------------------------------


//---------------------------　セキュリティ、スパム防止のための設定　------------------------------------

//スパム防止のためのリファラチェック（フォーム側とこのファイルが同一ドメインであるかどうかのチェック）(する=1, しない=0)
//※有効にするにはこのファイルとフォームのページが同一ドメイン内にある必要があります
$Referer_check = 1;

//リファラチェックを「する」場合のドメイン ※設置するサイトのドメインを指定して下さい。
//もしこの設定が間違っている場合は送信テストですぐに気付けます。
$Referer_check_domain = "hair-resort-ai.com";

/*セッションによるワンタイムトークン（CSRF対策、及びスパム防止）(する=1, しない=0)
※ただし、この機能を使う場合は↓の送信確認画面の表示が必須です。（デフォルトではON（1）になっています）
※【重要】ガラケーは機種によってはクッキーが使えないためガラケーの利用も想定してる場合は「0」（OFF）にして下さい（PC、スマホは問題ないです）*/
$useToken = 1;
//---------------------------　セキュリティ、スパム防止のための設定　ここまで　------------------------------------


//---------------------- 任意設定　以下は必要に応じて設定してください ------------------------

// Bccで送るメールアドレス(複数指定する場合は「,」で区切ってください 例 $BccMail = "aa@aa.aa,bb@bb.bb";)
$BccMail = "";

// 管理者宛に送信されるメールのタイトル（件名）
$subject = "リクルートサイトのエントリー";

// 送信確認画面の表示(する=1, しない=0)
$confirmDsp = 1;

// 送信完了後に自動的に指定のページ(サンクスページなど)に移動する(する=1, しない=0)
// CV率を解析したい場合などはサンクスページを別途用意し、URLをこの下の項目で指定してください。
// 0にすると、デフォルトの送信完了画面が表示されます。
$jumpPage = 1;

// 送信完了後に表示するページURL（上記で1を設定した場合のみ）※httpから始まるURLで指定ください。（相対パスでも基本的には問題ないです）
$thanksPage = "https://hair-resort-ai.com/thanks.html";

// 必須入力項目を設定する(する=1, しない=0)
$requireCheck = 1;

/* 必須入力項目(入力フォームで指定したname属性の値を指定してください。（上記で1を設定した場合のみ）
値はシングルクォーテーションで囲み、複数の場合はカンマで区切ってください。フォーム側と順番を合わせると良いです。 
配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。*/
$require = array("応募種別","希望職種","ご応募内容",'お名前',"フリガナ","メールアドレス","お電話番号","ご住所");


//----------------------------------------------------------------------
//  自動返信メール設定(START)
//----------------------------------------------------------------------

// 差出人に送信内容確認メール（自動返信メール）を送る(送る=1, 送らない=0)
// 送る場合は、フォーム側のメール入力欄のname属性の値が上記「$Email」で指定した値と同じである必要があります
$remail = 1;

//自動返信メールの送信者欄に表示される名前　※あなたの名前や会社名など（もし自動返信メールの送信者名が文字化けする場合ここは空にしてください）
$refrom_name = "代表　古藤知裕";

// 差出人に送信確認メールを送る場合のメールのタイトル（上記で1を設定した場合のみ）
$re_subject = "hair resort Ai ご応募ありがとうございます。";

//フォーム側の「名前」箇所のname属性の値　※自動返信メールの「○○様」の表示で使用します。
//指定しない、または存在しない場合は、○○様と表示されないだけです。あえて無効にしてもOK
$dsp_name = 'お名前';

//自動返信メールの冒頭の文言 ※日本語部分のみ変更可
$remail_text = <<< TEXT

ご連絡ありがとうございます。
順次返信させて頂いておりますが
遅くなる場合がございますので
早急の場合は
公式LINEか電話にてご連絡ください。
09078057803
代表　古藤携帯

TEXT;


//自動返信メールに署名（フッター）を表示(する=1, しない=0)※管理者宛にも表示されます。
$mailFooterDsp = 0;

//上記で「1」を選択時に表示する署名（フッター）（FOOTER～FOOTER;の間に記述してください）
$mailSignature = <<< FOOTER

──────────────────────
株式会社○○○○　佐藤太郎
〒150-XXXX 東京都○○区○○ 　○○ビル○F　
TEL：03- XXXX - XXXX 　FAX：03- XXXX - XXXX
携帯：090- XXXX - XXXX 　
E-mail:xxxx@xxxx.com
URL: http://www.php-factory.net/
──────────────────────

FOOTER;


//----------------------------------------------------------------------
//  自動返信メール設定(END)
//----------------------------------------------------------------------

//メールアドレスの形式チェックを行うかどうか。(する=1, しない=0)
//※デフォルトは「する」。特に理由がなければ変更しないで下さい。メール入力欄のname属性の値が上記「$Email」で指定した値である必要があります。
$mail_check = 1;

//全角英数字→半角変換を行うかどうか。(する=1, しない=0)
$hankaku = 0;

//全角英数字→半角変換を行う項目のname属性の値（name="○○"の「○○」部分）
//※複数の場合にはカンマで区切って下さい。（上記で「1」を指定した場合のみ有効）
//配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。
$hankaku_array = array('電話番号','金額');

//-fオプションによるエンベロープFrom（Return-Path）の設定(する=1, しない=0)　
//※宛先不明（間違いなどで存在しないアドレス）の場合に 管理者宛に「Mail Delivery System」から「Undelivered Mail Returned to Sender」というメールが届きます。
//サーバーによっては稀にこの設定が必須の場合もあります。
//設置サーバーでPHPがセーフモードで動作している場合は使用できませんので送信時にエラーが出たりメールが届かない場合は「0」（OFF）として下さい。
$use_envelope = 0;

//機種依存文字の変換
/*たとえば㈱（かっこ株）や①（丸1）、その他特殊な記号や特殊な漢字などは変換できずに「？」と表示されます。それを回避するための機能です。
確認画面表示時に置換処理されます。「変換前の文字」が「変換後の文字」に変換され、送信メール内でも変換された状態で送信されます。（たとえば「㈱」の場合、「（株）」に変換されます） 
必要に応じて自由に追加して下さい。ただし、変換前の文字と変換後の文字の順番と数は必ず合わせる必要がありますのでご注意下さい。*/

//変換前の文字
$replaceStr['before'] = array('①','②','③','④','⑤','⑥','⑦','⑧','⑨','⑩','№','㈲','㈱','髙');
//変換後の文字
$replaceStr['after'] = array('(1)','(2)','(3)','(4)','(5)','(6)','(7)','(8)','(9)','(10)','No.','（有）','（株）','高');

//------------------------------- 任意設定ここまで ---------------------------------------------


// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数実行、変数初期化
//----------------------------------------------------------------------
//トークンチェック用のセッションスタート
if($useToken == 1 && $confirmDsp == 1){
	session_name('PHPMAILFORMSYSTEM');
	session_start();
}
$encode = "UTF-8";//このファイルの文字コード定義（変更不可）
if(isset($_GET)) $_GET = sanitize($_GET);//NULLバイト除去//
if(isset($_POST)) $_POST = sanitize($_POST);//NULLバイト除去//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULLバイト除去//
if($encode == 'SJIS') $_POST = sjisReplace($_POST,$encode);//Shift-JISの場合に誤変換文字の置換実行
$funcRefererCheck = refererCheck($Referer_check,$Referer_check_domain);//リファラチェック実行

//変数初期化
$sendmail = 0;
$empty_flag = 0;
$post_mail = '';
$errm ='';
$header ='';

if($requireCheck == 1) {
	$requireResArray = requireCheck($require);//必須チェック実行し返り値を受け取る
	$errm = $requireResArray['errm'];
	$empty_flag = $requireResArray['empty_flag'];
}
//メールアドレスチェック
if(empty($errm)){
	foreach($_POST as $key=>$val) {
		if($val == "confirm_submit") $sendmail = 1;
		if($key == $Email) $post_mail = h($val);
		if($key == $Email && $mail_check == 1 && !empty($val)){
			if(!checkMail($val)){
				$errm .= "<p class=\"error_messe\">【".$key."】はメールアドレスの形式が正しくありません。</p>\n";
				$empty_flag = 1;
			}
		}
	}
}
  
if(($confirmDsp == 0 || $sendmail == 1) && $empty_flag != 1){
	
	//トークンチェック（CSRF対策）※確認画面がONの場合のみ実施
	if($useToken == 1 && $confirmDsp == 1){
		if(empty($_SESSION['mailform_token']) || ($_SESSION['mailform_token'] !== $_POST['mailform_token'])){
			exit('ページ遷移が不正です');
		}
		if(isset($_SESSION['mailform_token'])) unset($_SESSION['mailform_token']);//トークン破棄
		if(isset($_POST['mailform_token'])) unset($_POST['mailform_token']);//トークン破棄
	}
	
	//差出人に届くメールをセット
	if($remail == 1) {
		$userBody = mailToUser($_POST,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode);
		$reheader = userHeader($refrom_name,$from,$encode);
		$re_subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($re_subject,"JIS",$encode))."?=";
	}
	//管理者宛に届くメールをセット
	$adminBody = mailToAdmin($_POST,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp);
	$header = adminHeader($post_mail,$BccMail);
	$subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($subject,"JIS",$encode))."?=";
	
	//-fオプションによるエンベロープFrom（Return-Path）の設定(safe_modeがOFFの場合かつ上記設定がONの場合のみ実施)
	if($use_envelope == 0){
		mail($to,$subject,$adminBody,$header);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader);
	}else{
		mail($to,$subject,$adminBody,$header,'-f'.$from);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader,'-f'.$from);
	}
}
else if($confirmDsp == 1){ 

/*　▼▼▼送信確認画面のレイアウト※編集可　オリジナルのデザインも適用可能▼▼▼　*/
?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <!-- meta情報 -->
  <title>
    ヘアリゾートAiリクルートサイト｜スタッフの「もっと」に答える働き方
  </title>
  <meta name="description" content="ヘアリゾートAiは関東を中心に展開している美容サロンです。最短１年でスタイリストになれる特待生制度、アシスタントをしながらアイリストの勉強、カラーとセットメインのAiリストなど、スタッフの【もっと】に応え、実現したそれぞれの働き方が可能です。他のサロンではできない、この働き方がhair resort Aiでできるのには理由があります。ぜひ一緒に働きませんか？
  " />
  <meta name="keywords" content="ヘアリゾートエーアイ,関東,サロン,美容院,求人,スタイリスト,アイリスト,アシスタント,hair resort Ai" />
  <!-- ogp -->
  <meta property="og:title" content="ヘアリゾートAiのリクルートサイト" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="ヘアリゾートAiのリクルートサイト" />
  <meta property="og:description"
    content="ヘアリゾートAiは関東を中心に展開している美容サロンです。最短１年でスタイリストになれる特待生制度、アシスタントをしながらアイリストの勉強、カラーとセットメインのAiリストなど、スタッフの【もっと】に応え、実現したそれぞれの働き方が可能です。他のサロンではできない、この働き方がhair resort Aiでできるのには理由があります。ぜひ一緒に働きませんか？" />
  <!-- ファビコン -->
  <link rel="icon" href="./images/favicon.ico" />
  <!-- グーグルフォント -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Sans:wght@300;400;500;700&family=Yantramanav:wght@500&display=swap"
    rel="stylesheet">
  <!-- css -->
  <link rel="stylesheet" href="./css/styles.css" />

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script defer src="./js/script.js"></script>
  <!-- Google Tag Manager -->
  <script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      "gtm.start": new Date().getTime(),
      event: "gtm.js",
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != "dataLayer" ? "&l=" + l : "";
    j.async = true;
    j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, "script", "dataLayer", "GTM-TPTBBSP");
  </script>
  <!-- End Google Tag Manager -->
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TPTBBSP" height="0" width="0"
      style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <header class="l-header p-header">
    <div class="p-header__inner l-inner">
      <h1 class="p-header__logo">
        <a href="index.html">
          <img src="./images/header-logo.png" alt="ヘアリゾートAi" />
        </a>
      </h1>
      <button class="p-header__hamburger js-drawer-open">
        <span></span>
        <span></span>
        <p class="p-header__menu">menu</p>
      </button>

      <div class="p-header__drawer">
        <nav class="p-header__drawer-nav drawer-menu">
          <ul class="p-header__drawer-nav-items">
            <li class="p-header__drawer-nav-item nav-item1 u-scroll">
              <a href="index.html#hope">特待制度とは</a>
            </li>
            <li class="p-header__drawer-nav-item nav-item2 u-scroll">
              <a href="index.html#voice">働くスタッフの声</a>
            </li>
            <li class="p-header__drawer-nav-item nav-item3 u-scroll">
              <a href="index.html#strength">Aiの強み</a>
            </li>
            <li class="p-header__drawer-nav-item nav-item4 u-scroll">
              <a href="index.html#flow">採用の流れ</a>
            </li>
            <li class="p-header__drawer-nav-item nav-item5">
              <a href="index.html#requirements">募集要項</a>
            </li>
            <li class="p-header__drawer-nav-item nav-item6">
              <a href="index.html#company">会社概要</a>
            </li>
          </ul>
        </nav>

        <div class="p-entry__block p-cv">
          <p class="p-cv__text">＞ まずはサロン見学 & 施術体験</p>
          <a class="p-cv__entry" href="index.html#entry-form">entry<span>ご応募</span></a>
          <p class="p-cv__text">＞ その他ご質問・お問い合わせ</p>
          <a class="p-cv__contact" href="contact.html">contact<span>お問い合わせ</span></a>
        </div>
        <div class="p-header__drawer-sns">
          <div class="p-header__drawer-sns-flow">follow me!</div>
          <div class="p-header__drawer-snsblock">
            <figure class="p-header__drawer-img">
              <a href="https://lin.ee/meiDQOw">
                <img src="./images/line3.png" alt="LINE" />
              </a>
            </figure>
            <figure class="p-header__drawer-img">
              <a href="https://instagram.com/hairresortai_recruit?igshid=YmMyMTA2M2Y=　">
                <img src="./images/insta3.png" alt="Instagram" />
              </a>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="p-recruit2">
    <div class="p-recruit2__inner">
      <h1 class="p-recruit2__title c-section-title">#RECRUIT</h1>
      <div class="p-recruit2__form">
        <form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="POST">
          <p class="p-recruit2__sub">送信内容確認</p>
          <div id="formWrap">
            <?php if($empty_flag == 1){ ?>
            <div align="center">
              <h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
              <?php echo $errm; ?><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
            </div>
            <?php }else{ ?>
            <?php } ?>
          </div><!-- /formWrap -->
          <p class="p-recruit2__list">応募種別*<br><?php echo $_POST['応募種別']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">希望職種*<br><?php echo $_POST['希望職種']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">ご応募内容*<br><?php echo $_POST['ご応募内容']; ?></p>
          <div class="p-recruit2__border"></div>

          <p class="p-recruit2__list">お名前*<br><?php echo $_POST['お名前']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">フリガナ*<br><?php echo $_POST['フリガナ']; ?></p>
          <div class="p-recruit2__border"></div>

          <p class="p-recruit2__list">生年月日<br><?php echo $_POST['生年月日']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">資格<br><?php echo $_POST['資格']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">メールアドレス*<br><?php echo $_POST['メールアドレス']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">お電話番号*<br><?php echo $_POST['お電話番号']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list">ご住所*<br><?php echo $_POST['ご住所']; ?></p>
          <div class="p-recruit2__border"></div>
          <p class="p-recruit2__list3">備考</p>
          <p class="p-recruit2__text">
            <?php echo $_POST['備考']; ?>
          </p>
          <img src="./images/contact2.png" alt="" class="p-contact__img">
        </form>
        <form action="mail.php" method="post">
          <?php echo confirmOutput($_POST);//入力内容を表示?>

          <p class="p-entry-form__button"><input type="submit" value="送信"></p>
          <input type="hidden" name="mail_set" value="confirm_submit">
          <input type="hidden" name="httpReferer" value="<?php echo h($_SERVER['HTTP_REFERER']);?>">
        </form>
      </div>
    </div>
    <p class="p-recruit2__followme">\ FOLLOW ME! /</p>
    <div class="p-recruit2__snsarea">
      <a href="https://lin.ee/meiDQOw">
        <div class="p-recruit2__line">
          <img src="./images/line3.png" alt="Instagram">
        </div>
      </a>
      <a href="https://instagram.com/hairresortai_recruit?igshid=YmMyMTA2M2Y=">
        <div class="p-recruit2__insta">
          <img src="./images/insta3.png" alt="LINE">
        </div>
      </a>
    </div>
    </div>

    <footer class="p-main-footer">
      <div class="p-main-footer__area">
        <div class="p-main-footer-logo">
          <img src="./images/footer-logo.svg" alt="ヘアリゾートAi" />
        </div>
        <p class="p-main-footer__sub">ヘアリゾートAi RECRUIT SITE</p>
        <ul class="p-main-footer__textblock">
          <li class="p-main-footer__text">
            <a href="index.html#hope">特待制度とは</a>
          </li>
          <li class="p-main-footer__text">
            <a href="index.html#voice">働くスタッフの声</a>
          </li>
          <li class="p-main-footer__text">
            <a href="index.html#strength">Aiの強み</a>
          </li>
          <li class="p-main-footer__text">
            <a href="index.html#flow">採用の流れ</a>
          </li>
          <li class="p-main-footer__text">
            <a href="index.html#requirements">募集要項</a>
          </li>
          <li class="p-main-footer__text">
            <a href="index.html#company">会社概要</a>
          </li>
        </ul>
        <div class="p-entry__block p-cv">
          <p class="p-cv__text">＞ まずはサロン見学 & 施術体験</p>
          <a class="p-cv__entry" href="index.html">entry<span>ご応募</span></a>
          <p class="p-cv__text">＞ その他ご質問・お問い合わせ</p>
          <a class="p-cv__contact" href="contact.html">contact<span>お問い合わせ</span></a>
        </div>
        <div class="p-main-footer__snsarea">
          <div class="p-main-footer__snsinsta">
            <a href="https://instagram.com/hairresortai_recruit?igshid=YmMyMTA2M2Y=">
              <img src="./images/instagram.png" alt="Instagram" />
            </a>
          </div>
          <div class="p-main-footer__snstiktok">
            <a href="https://www.tiktok.com/@hair.resort.ai.recruit">
              <img src="./images/tiktok.png" alt="TikTok" />
            </a>
          </div>
          <div class="p-main-footer__snsline">
            <a href="https:/https://lin.ee/meiDQOw">
              <img src="./images/line.png" alt="LINE" />
            </a>
          </div>
        </div>
        <div class="p-main-footer__copyright">
          <small>Copyright © ヘアリゾートAi all rights reserved.</small>
        </div>
      </div>
    </footer>

</html>
<style type="text/css">
.p-recruit2 {
  background-color: #dddddd;
  padding-top: 7.0625rem;
}

.p-recruit2__title.c-section-title {
  text-align: center;
}

.p-recruit2__form {
  background-color: #fff;
  margin: 0rem 0.625rem 2.5rem;
  border-radius: 0.625rem;
  padding: 0rem 1.1875rem 2.5rem 1.1875rem;
  width: calc(100% - 20px);
  margin-top: -0.4375rem;
}

.p-recruit2__sub {
  text-align: center;
  font-family: "Noto Sans JP", YuGothic, "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック", "Yu Gothic", sans-serif;
  padding-top: 2.5rem;
  margin-bottom: 2.25rem;
}

.p-recruit2_item {
  font-size: 0.875rem;
  font-family: "Noto Sans", sans-serif;
  font-weight: 300;
  margin-bottom: 0.9375rem;
}

.p-recruit2__list1 {
  font-size: 0.875rem;
  font-family: "Noto Sans JP", YuGothic, "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック", "Yu Gothic", sans-serif;
  margin-bottom: 0.625rem;
  line-height: 2;
}

.p-recruit2__list {
  font-size: 0.875rem;
  font-family: "Noto Sans JP", YuGothic, "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック", "Yu Gothic", sans-serif;
  margin-bottom: 0.625rem;
  line-height: 1.85;
}

.p-recruit2__list3 {
  font-size: 0.875rem;
  font-family: "Noto Sans JP", YuGothic, "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック", "Yu Gothic", sans-serif;
  line-height: 1.85;
}

.p-recruit2__border {
  border-bottom: 0.0625rem dotted #000000;
  margin: 0rem -0.34375rem 0.375rem -0.34375rem;
}

.p-recruit2__text {
  font-size: 0.875rem;
  font-family: "Noto Sans";
  margin-bottom: 2.5rem;
}

.p-contact__img {
  max-width: 14.8125rem;
  display: block;
  margin: 0 auto 2.5rem auto;
}

.p-recruit2__button {
  font-size: 0.875rem;
  font-family: "Noto Sans JP", YuGothic, "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック", "Yu Gothic", sans-serif;
  display: block;
  text-align: center;
  border: 0.0625rem solid #000000;
  border-radius: 1.75rem;
  padding: 0.96875rem 0rem;
  margin: 0rem 1.5625rem;
}

.p-recruit2__snsarea {
  padding: 1.25rem 1.5625rem 3.125rem 1.5625rem;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  gap: 20px;
}

.p-recruit2__followme {
  text-align: center;
}

.p-entry-form__button input {
  display: block;
  text-align: center;
  border: 1px solid #000;
  padding: rem(15.5);
  border-radius: rem(28);
  margin: rem(28) rem(10) rem(0) rem(10);
  min-width: rem(320);
}

.p-entry-form__button {
  position: relative;
}

.p-entry-form__button::before {
  content: ">";
  position: absolute;
  top: 47%;
  left: 42%;
  transform: translate(-50%, -50%);
  width: rem(14);
  height: rem(14);
  z-index: 10;
  display: block;
}
</style>

<body>

  <!-- ▲ Headerやその他コンテンツなど　※自由に編集可 ▲-->

  <!-- ▼************ 送信内容表示部　※編集は自己責任で ************ ▼-->

  <!-- ▲ *********** 送信内容確認部　※編集は自己責任で ************ ▲-->

  <!-- ▼ Footerその他コンテンツなど　※編集可 ▼-->
</body>

</html>
<?php
/* ▲▲▲送信確認画面のレイアウト　※オリジナルのデザインも適用可能▲▲▲　*/
}

if(($jumpPage == 0 && $sendmail == 1) || ($jumpPage == 0 && ($confirmDsp == 0 && $sendmail == 0))) { 

/* ▼▼▼送信完了画面のレイアウト　編集可 ※送信完了後に指定のページに移動しない場合のみ表示▼▼▼　*/
?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <meta name="format-detection" content="telephone=no">
  <title>完了画面</title>
</head>

<body>
  <div align="center">
    <?php if($empty_flag == 1){ ?>
    <h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
    <div style="color:red"><?php echo $errm; ?></div>
    <br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
  </div>
</body>

</html>
<?php }else{ ?>
送信ありがとうございました。<br />
送信は正常に完了しました。<br /><br />
<a href="<?php echo $site_top ;?>">トップページへ戻る&raquo;</a>
</div>
<?php copyright(); ?>
<!--  CV率を計測する場合ここにAnalyticsコードを貼り付け -->
</body>

</html>
<?php 
/* ▲▲▲送信完了画面のレイアウト 編集可 ※送信完了後に指定のページに移動しない場合のみ表示▲▲▲　*/
  }
}
//確認画面無しの場合の表示、指定のページに移動する設定の場合、エラーチェックで問題が無ければ指定ページヘリダイレクト
else if(($jumpPage == 1 && $sendmail == 1) || $confirmDsp == 0) { 
	if($empty_flag == 1){ ?>
<div align="center">
  <h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
  <div style="color:red"><?php echo $errm; ?></div><br /><br /><input type="button" value=" 前画面に戻る "
    onClick="history.back()">
</div>
<?php 
	}else{ header("Location: ".$thanksPage); }
}

// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数定義(START)
//----------------------------------------------------------------------
function checkMail($str){
	$mailaddress_array = explode('@',$str);
	if(preg_match("/^[\.!#%&\-_0-9a-zA-Z\?\/\+]+\@[!#%&\-_0-9a-zA-Z]+(\.[!#%&\-_0-9a-zA-Z]+)+$/", "$str") && count($mailaddress_array) ==2){
		return true;
	}else{
		return false;
	}
}
function h($string) {
	global $encode;
	return htmlspecialchars($string, ENT_QUOTES,$encode);
}
function sanitize($arr){
	if(is_array($arr)){
		return array_map('sanitize',$arr);
	}
	return str_replace("\0","",$arr);
}
//Shift-JISの場合に誤変換文字の置換関数
function sjisReplace($arr,$encode){
	foreach($arr as $key => $val){
		$key = str_replace('＼','ー',$key);
		$resArray[$key] = $val;
	}
	return $resArray;
}
//送信メールにPOSTデータをセットする関数
function postToMail($arr){
	global $hankaku,$hankaku_array;
	$resArray = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		
		if (version_compare(PHP_VERSION, '5.1.0', '<=')) {//PHP5.1.0以下の場合のみ実行（7.4でget_magic_quotes_gpcが非推奨になったため）
			if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		}
		
		//全角→半角変換
		if($hankaku == 1){
      $out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		if($out != "confirm_submit" && $key != "httpReferer") {
			$resArray .= "【 ".h($key)." 】 ".h($out)."\n";
		}
	}
	return $resArray;
}
//確認画面の入力内容出力用関数
function confirmOutput($arr){
	global $hankaku,$hankaku_array,$useToken,$confirmDsp,$replaceStr;
	$html = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		
		if (version_compare(PHP_VERSION, '5.1.0', '<=')) {//PHP5.1.0以下の場合のみ実行（7.4でget_magic_quotes_gpcが非推奨になったため）
			if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		}
		
		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		
		$out = nl2br(h($out));//※追記 改行コードを<br>タグに変換
		$key = h($key);
		$out = str_replace($replaceStr['before'], $replaceStr['after'], $out);//機種依存文字の置換処理
		
		// $html .= "<tr><th>".$key."</th><td>".$out;
		$html .= '<input type="hidden" name="'.$key.'" value="'.str_replace(array("<br />","<br>"),"",$out).'" />';
		$html .= "</td></tr>\n";
	}
	//トークンをセット
	if($useToken == 1 && $confirmDsp == 1){
		$token = sha1(uniqid(mt_rand(), true));
		$_SESSION['mailform_token'] = $token;
		$html .= '<input type="hidden" name="mailform_token" value="'.$token.'" />';
	}
	
	return $html;
}

//全角→半角変換
function zenkaku2hankaku($key,$out,$hankaku_array){
	global $encode;
	if(is_array($hankaku_array) && function_exists('mb_convert_kana')){
		foreach($hankaku_array as $hankaku_array_val){
			if($key == $hankaku_array_val){
				$out = mb_convert_kana($out,'a',$encode);
			}
		}
	}
	return $out;
}
//配列連結の処理
function connect2val($arr){
	$out = '';
	foreach($arr as $key => $val){
		if($key === 0 || $val == ''){//配列が未記入（0）、または内容が空のの場合には連結文字を付加しない（型まで調べる必要あり）
			$key = '';
		}elseif(strpos($key,"円") !== false && $val != '' && preg_match("/^[0-9]+$/",$val)){
			$val = number_format($val);//金額の場合には3桁ごとにカンマを追加
		}
		$out .= $val . $key;
	}
	return $out;
}

//管理者宛送信メールヘッダ
function adminHeader($post_mail,$BccMail){
	global $from;
	$header="From: $from\n";
	if($BccMail != '') {
	  $header.="Bcc: $BccMail\n";
	}
	if(!empty($post_mail)) {
		$header.="Reply-To: ".$post_mail."\n";
	}
	$header.="Content-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
	return $header;
}
//管理者宛送信メールボディ
function mailToAdmin($arr,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp){
	$adminBody="「".$subject."」からメールが届きました\n\n";
	$adminBody .="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$adminBody.= postToMail($arr);//POSTデータを関数からセット
	$adminBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$adminBody.="送信された日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	$adminBody.="送信者のIPアドレス：".@$_SERVER["REMOTE_ADDR"]."\n";
	$adminBody.="送信者のホスト名：".getHostByAddr(getenv('REMOTE_ADDR'))."\n";
	if($confirmDsp != 1){
		$adminBody.="問い合わせのページURL：".@$_SERVER['HTTP_REFERER']."\n";
	}else{
		$adminBody.="問い合わせのページURL：".@$arr['httpReferer']."\n";
	}
	if($mailFooterDsp == 1) $adminBody.= $mailSignature;
	return mb_convert_encoding($adminBody,"JIS",$encode);
}

//ユーザ宛送信メールヘッダ
function userHeader($refrom_name,$to,$encode){
	$reheader = "From: ";
	if(!empty($refrom_name)){
		$default_internal_encode = mb_internal_encoding();
		if($default_internal_encode != $encode){
			mb_internal_encoding($encode);
		}
		$reheader .= mb_encode_mimeheader($refrom_name)." <".$to.">\nReply-To: ".$to;
	}else{
		$reheader .= "$to\nReply-To: ".$to;
	}
	$reheader .= "\nContent-Type: text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
	return $reheader;
}
//ユーザ宛送信メールボディ
function mailToUser($arr,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode){
	$userBody = '';
	if(isset($arr[$dsp_name])) $userBody = h($arr[$dsp_name]). " 様\n";
	$userBody.= $remail_text;
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.= postToMail($arr);//POSTデータを関数からセット
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	if($mailFooterDsp == 1) $userBody.= $mailSignature;
	return mb_convert_encoding($userBody,"JIS",$encode);
}
//必須チェック関数
function requireCheck($require){
	$res['errm'] = '';
	$res['empty_flag'] = 0;
	foreach($require as $requireVal){
		$existsFalg = '';
		foreach($_POST as $key => $val) {
			if($key == $requireVal) {
				
				//連結指定の項目（配列）のための必須チェック
				if(is_array($val)){
					$connectEmpty = 0;
					foreach($val as $kk => $vv){
						if(is_array($vv)){
							foreach($vv as $kk02 => $vv02){
								if($vv02 == ''){
									$connectEmpty++;
								}
							}
						}
						
					}
					if($connectEmpty > 0){
						$res['errm'] .= "<p class=\"error_messe\">【".h($key)."】は必須項目です。</p>\n";
						$res['empty_flag'] = 1;
					}
				}
				//デフォルト必須チェック
				elseif($val == ''){
					$res['errm'] .= "<p class=\"error_messe\">【".h($key)."】は必須項目です。</p>\n";
					$res['empty_flag'] = 1;
				}
				
				$existsFalg = 1;
				break;
			}
			
		}
		if($existsFalg != 1){
				$res['errm'] .= "<p class=\"error_messe\">【".$requireVal."】が未選択です。</p>\n";
				$res['empty_flag'] = 1;
		}
	}
	
	return $res;
}
//リファラチェック
function refererCheck($Referer_check,$Referer_check_domain){
	if($Referer_check == 1 && !empty($Referer_check_domain)){
		if(strpos($_SERVER['HTTP_REFERER'],$Referer_check_domain) === false){
			return exit('<p align="center">リファラチェックエラー。フォームページのドメインとこのファイルのドメインが一致しません</p>');
		}
	}
}
function copyright(){
	echo '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP工房 -</a>';
}
//----------------------------------------------------------------------
//  関数定義(END)
//----------------------------------------------------------------------
?>