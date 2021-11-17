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
$user_password ="";
$user_email = "";

$user_data = [];
$pass_err =[];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $user_email = h($_POST['user_email']);
  $user_password = h($_POST['user_password']);
  

  $errors = $vali->LoginV();
  $count = array_count_values($errors);
  if(!$count){
    $data = $user->ChackEmail();
    if($data['user'] != false){
      $user_data = $data['user'];
    
        if(password_verify($user_password,$user_data['user_password'])){
          $_SESSION = $user_data;
          var_dump($_SESSION);
          if($_SESSION['role'] ==1){
            header('Location:/ManagerViews/manager_top.php');
            exit();
          }else{
            header('Location:/FriendsViews/friends_top.php');
            exit();
          }
        }else{
          $pass_err['pass'] = 'パスワードが正しくありません。';
        }
    }else{
      $pass_err['email'] = 'メールアドレスが見つかりません。';
    }
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
    <link rel="stylesheet"  href="/js/action.js">
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
    <header class="title">Welcome to Friends App</header>
      <form action="#" method="POST">
        <div class="field_input">
          <label>メールアドレス</label>
          <input type="text" name="user_email" class="form-control" id="exampleInputPassword1" placeholder="メールアドレスを入力してください" value="<?=$user_email?>">
          <?php if(isset($errors['user_email'])):?>
          <div class="err_text"><?=$errors['user_email']?></div>
          <?php endif;?>
          <?php if(isset($pass_err['email'])):?>
          <div class="err_text"><?=$pass_err['email']?></div>
          <?php endif;?>
        </div>
        <div class="field_input_pass">
          <label>パスワード</label>
          <input type="password" name="user_password" class="pass form-control" id="exampleInputPassword1"  placeholder="パスワードを入力してください" value="<?=$user_password?>"><i class="toggle-pass_login fas fa-eye"></i>
          <?php if(isset($errors['user_password'])):?>
          <div class="err_text"><?=$errors['user_password']?></div>
          <?php endif;?>
          <?php if(isset($pass_err['pass'])):?>
          <div class="err_text"><?=$pass_err['pass']?></div>
          <?php endif;?>
          <div class="link">パスワードを忘れた方は<a href="re_pass_verify.php">こちら</a></div>
        </div>
        <div class="field_button">
          <input type="submit" name="submit" value="LoginFriends" class="btn btn-success">
        </div>
      </form>
    </section>
  </div>
  <script>
        $(function() {
  $('.toggle-pass_login').on('click', function() {
    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $(this).prev('input');
    if (input.attr('type') == 'text') {
      input.attr('type','password');
    } else {
      input.attr('type','text');
    }
  });
});
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>