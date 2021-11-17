<?php
session_start();
require_once(ROOT_PATH .'Controllers/UserController.php');
$user = new UserController();

$err = [];
$user_unique_id ="";
if($_SESSION['role'] ==1){
  $result = $user->regist_manager();
  if($result){
    $user_unique_id = $_SESSION['user_unique_id'];
    $value = $user->GetUnique_reg();
    if($value){
      $_SESSION['user_unique_id'] = $value['user_unique_id'];
    $user->create_info();
    
    }
  }
}else{
  $result = $user->regist_user();
  if($result){
    $user_unique_id = $_SESSION['user_unique_id'];
    $value = $user->GetUnique_reg();
    if($value){
    $_SESSION['user_unique_id'] = $value['user_unique_id'];
    $user->create_info();
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
     <!-- JS -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Friends</title>
  </head>
  <body>

  <div class="wrapper">
    <section class="users">
      <?php include('manager_header.php')?>
    <?php if(isset($err['fail_regist'])):?>
      <div class="conp">
        <?=$err['fail_regist']?>
    </div>
    <?php else:?>
    <div class="conp">
        登録が完了しました。
    </div>
    <?php endif;?>
    <div class="con_register text-center">
    <button onclick="location.href='register.php'" class="btn btn-success">登録を続ける</button> 
    </div>
    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>