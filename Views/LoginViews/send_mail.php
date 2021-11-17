<?php
session_start();
// HPMailer のクラスをグローバル名前空間（global namespace）にインポート
// スクリプトの先頭で宣言する必要があります
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 

// Composer のオートローダーの読み込み（ファイルの位置によりパスを適宜変更）
require '/Mailer/vendor/autoload.php';
//エラーメッセージ用日本語言語ファイルを読み込む場合（25行目の指定も必要）
require '/phpmailer/phpmailer/language/phpmailer.lang-ja.php';
 
 
//エラーメッセージ用言語ファイルを使用する場合に指定
$mail->setLanguage('ja', 'vendor/phpmailer/phpmailer/language/');

    //session受け取り・emailとunique_id
    $user_email = $_SESSION['user_email'];
    $user_unique_id = $_SESSION['user_unique_id'];
    //リンク
    $link_url_text = "こんにちは。パスワード再設定用のリンクを以下に貼りました。クリックしてパスワードの再設定を行ってください。http://localhost/LoginViews/login.php?user_unique_id='$user_unique_id'ですよ。";
    $main_text =  nl2br(preg_replace("(http)(://[[:alnum:]\S\$\+\?\.-=_%,:@!#~*/&]+)","<a href=\"\\1\\2\">\\1\\2</a>",$link_url_text));

 
    //mbstring の日本語設定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    
    // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
    $mail = new PHPMailer(true);
    
    //日本語用設定
    $mail->CharSet = "iso-2022-jp";
    $mail->Encoding = "7bit";

    $success_send =[];

    try {
      //サーバの設定
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // デバグの出力を有効に（テスト環境での検証用）
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
      $mail->addAddress('{$user_email}', mb_encode_mimeheader("ユーザー様")); 
      //Cc 受信者の指定
      $mail->addCC('atc_chris411@yahoo.co.jp'); 
    
      //コンテンツ設定
      $mail->isHTML(true);   // HTML形式を指定
      //メール表題（タイトル）
      $mail->Subject = mb_encode_mimeheader('Friendsパスワード再設定用メール'); 
      //本文（HTML用）
      $mail->Body  = mb_convert_encoding('',"JIS","UTF-8");  
      //テキスト表示の本文
      $mail->AltBody = mb_convert_encoding('プレインテキストメッセージ non-HTML mail clients',"JIS","UTF-8"); 
    
      $mail->send();  //送信
      $success_send = '送信完了';
      header('Location:re_pass_suc.php');
      exit();
    } catch (Exception $e) {
      $success_send = "メール送信に失敗しました。: {$mail->ErrorInfo}";
    }
