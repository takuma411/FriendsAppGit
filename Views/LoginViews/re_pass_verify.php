<?php
session_start();
//再送信表示させない
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require_once(ROOT_PATH .'Controllers/UserController.php');
require_once(ROOT_PATH .'Controllers/Validation.php');

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
$vali = new Validation();
$user = new UserController();

$user_email = "";
$err_email =[];
$success_email = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $user_email = h($_POST['user_email']);

  $errors = $vali->verify_email();
  $count = array_count_values($errors);

  if(!$count){
    //$_SESSION['user_email'] = $user_email;
    $get_email = $user->ChackEmail();
    if($get_email['user'] != false){
      $user_data = $get_email['user'];
          
        if(!isset($user_data['user_email'])){
          $err_email['not_exist'] = 'このメールアドレスは登録されていません。<br/> もう一度ご確認の上、ご入力ください。';
        }else{     
          $success_email['find_email'] = "認証に成功しました！<br/> メールアドレス宛にパスワード再設定用のメールが届きます。";
          $_SESSION['user_email'] = $user_data['user_email'];
          $_SESSION['user_unique_id'] = $user_data['user_unique_id'];
          echo $_SESSION['user_email'];
          header('Location:/php_mailer/re_pass_suc.php');
          exit();
        }
    }    
  }
}else{
  if(isset($_POST['user_email'])){
  $user_email = h($_POST['user_email']);
  }
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
      <header class="title"><a href="login.php" class="title">Welcome to Friends App</a></header>
      <form action="#" method="POST">
        <div class="field_input">
        <!-- <?php foreach($get_email['user'] as $value):?>
          <?=$value['user_unique_id']?>
          <?php endforeach;?> -->
            <p>登録済みのメールアドレスをご入力ください。<br>
            登録が確認できましたら、ご入力頂いたメールアドレスに<br>
            パスワード再設定用のリンクが届きます。
            </p>
            <?php if(isset($err_email['not_exist'])):?>
          <div class="err_text"><?=$err_email['not_exist']?></div>
          <?php endif;?>
            <?php if(isset($errors['user_email'])):?>
          <div class="err_text"><?=$errors['user_email']?></div>
          <?php endif;?>
          <label>メールアドレス</label>
          <input type="text" name="user_email" class="form-control" id="exampleInputPassword1" placeholder="メールアドレスを入力してください" value="<?=$user_email?>">
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="送信" class="btn btn-success">
        </div>
      </form>
    </section>
  </div>
  
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>