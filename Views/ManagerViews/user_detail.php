<?php
session_start();

//再送信表示させない
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require_once(ROOT_PATH .'Controllers/UserController.php');

$user = new UserController();

$params = $user->user_detail();
$param = $params['user'];
if($param){
  $_SESSION['fuser_name']      = $param['user_name'];
  $_SESSION['fuser_name_kana'] = $param['user_name_kana'];
  $_SESSION['fuser_area']      = $param['user_area'];
  $_SESSION['fuser_email']     = $param['user_email'];
  $_SESSION['fuser_unique_id'] = $param['user_unique_id'];
  $_SESSION['frole']           = $param['role'];
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
      
    <div class="conf">
    <div class="conf_text">
            ユーザ情報詳細
        </div>
        <div class="result">
           <p class="left_text">氏名　　　　　：</p><p class="right_text"><?=$param['user_name']?></p>
        </div>
        <div class="result">
        <p class="left_text">氏名カナ　　　：</p><p class="right_text"><?=$param['user_name_kana']?></p>
        </div>
        <div class="result">
        <p class="left_text">勤務エリア　　：</p><p class="right_text"><?=$param['user_area']?></p>
        </div>
        <div class="result">
        <p class="left_text">メールアドレス：</p><p class="right_text"><?=$param['user_email']?></p>
        </div>
        <!-- <div class="result">
        <p class="left_text">FriendsID　　　：</p><p class="right_text"><?=$param['user_unique_id']?></p>
        </div> -->
        <div class="result">
        <p class="left_text">ユーザー　　　：</p>
        
        <p class="right_text">
          <?php if($param['role'] == 1):?>
            <?php echo '管理者';?>
            <?php else:?>
            <?php echo '一般';?> 
            <?php endif;?>
        </p>
        </div>
        <form action="" method="POST">

        <div class="buttum">
          <div class="field_button">
          <a href="user_edit.php?user_unique_id=<?=$param['user_unique_id']?>" class="btn btn-success">編集</a>
          </div>
          <div class="field_button">
            <a href="user_delete_complete.php?user_unique_id=<?=$param['user_unique_id']?>" onclick="return confirm('削除してもよろしいですか？');" class="btn btn-danger">削除</a>
          </div>
        </div>
        </form>

      
    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>