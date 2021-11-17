<?php
session_start();
if(!isset($_SESSION['user_unique_id'])){
  header('Location:/LoginViews/login.php');
  exit();
}
// HPMailer のクラスをグローバル名前空間（global namespace）にインポート
// スクリプトの先頭で宣言する必要があります
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
// Composer のオートローダーの読み込み（ファイルの位置によりパスを適宜変更）
require 'vendor/autoload.php';
 
//mbstring の日本語設定
mb_language("japanese");
mb_internal_encoding("UTF-8");
 
// インスタンスを生成（引数に true を指定して例外 Exception を有効に）
$mail = new PHPMailer(true);
//session受け取り・emailとunique_id
$user_email = $_SESSION['user_email'];

$user_unique_id = $_SESSION['user_unique_id'];
//リンク
// $link_url_text = 'こんにちは。パスワード再設定用のリンクを以下に貼りました。クリックしてパスワードの再設定を行ってください。http://localhost/LoginViews/re_pass.phpです。';
//$main_text =  nl2br(preg_replace("(http)(://[[:alnum:]\S\$\+\?\.-=_%,:@!#~*/&]+)","<a href=\"\\1\\2\">\\1\\2</a>",$link_url_text));
 
//日本語用設定
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";
 
try {
  //サーバの設定
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // デバグの出力を有効に（テスト環境での検証用）
  $mail->SMTPDebug = 0;
  $mail->isSMTP();   // SMTP を使用
  $mail->Host       = 'smtp.gmail.com';  // ★★★ Gmail SMTP サーバーを指定
  $mail->SMTPAuth   = true;   // SMTP authentication を有効に
  $mail->Username   = 'greeceikitai@gmail.com';  // ★★★ Gmail ユーザ名
  $mail->Password   = 'yrnxmrtxjozdtyau';  // ★★★ Gmail パスワード
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ★★★ 暗号化（TLS)を有効に 
  $mail->Port = 587;  //★★★ ポートは 587 
 
  //受信者設定
  //差出人アドレス, 差出人名 
  $mail->setFrom('greeceikitai@gmail.com', mb_encode_mimeheader('Friends App')); 
  // 受信者アドレス, 受信者名（受信者名はオプション）
  $mail->addAddress($user_email, mb_encode_mimeheader("")); 
//   // 追加の受信者（受信者名は省略可能）
//   $mail->addAddress('xxxxxx@example.com'); 
//   //返信用アドレス（差出人以外に必要であれば）
//   $mail->addReplyTo('info@example.com', mb_encode_mimeheader("お問い合わせ"));  
  //Cc 受信者の指定
  //$mail->addCC('atc_chris411@yahoo.co.jp'); 
 
  //コンテンツ設定
  $mail->isHTML(true);   // HTML形式を指定
  //メール表題（タイトル）
  $mail->Subject = mb_encode_mimeheader('Friends Appパスワード再設定'); 
  //本文（HTML用）
  $text = "こんにちは。パスワード再設定用のリンクを以下に貼りました。クリックしてパスワードの再設定を行ってください。http://localhost/LoginViews/re_pass.php?user_unique_id={$user_unique_id}です。";
  $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
  $replace = '<a href="$1">$1</a>';
  $text    = preg_replace( $pattern, $replace, $text );

  $mail->Body  = mb_convert_encoding($text,"JIS","UTF-8");  
  //テキスト表示の本文
  $mail->AltBody = mb_convert_encoding('プレインテキストメッセージ non-HTML mail clients',"JIS","UTF-8"); 
 
  $result = $mail->send();  //送信
  if($result){
    $_SESSION['suc_verify'] = '認証成功。メールアドレス宛にリンクを送信しました。';
    // header('Location:/re_pass_verify.php');
    // exit();
  }else{
    // header('Location:/re_pass_fail.php');
    // exit();
  }
} catch (Exception $e) {
}
?>
<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Friends</title>
  </head>
  <body>

  <div class="wrapper">
    <section class="form_login">
      <header><a href="/LoginViews/login.php" class="title">Welcome to Friends App</a></header>
      <div class="re_pass_comp">
          メール認証に成功しました。<br>
          メールアドレス宛にリンクが届きます。
      </div>
      <div class="back_login">
          ログイン画面は<a href="/LoginViews/login.php">こちら</a>をクリック
      </div>
    </section>
  </div>
  
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>