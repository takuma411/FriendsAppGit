<?php
session_start();

if(!isset($_SESSION['user_unique_id'])){
  $_SESSION = array();
  session_destroy();
  header('Location:/LoginViews/login.php');
  exit();
}
require_once(ROOT_PATH .'Controllers/UserController.php');
$user = new UserController();

//hesd
$info_head = $user->GetSendHead();
// $head = $info_head['user'];
// var_dump($head);



$info_user = $user->GetProfile();
$info = $info_user['info'];

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
    <section class="chat-area">




    <?php if(!empty($info_head[0]['user_img'])):?>
        <div class="head">
          <a href="friends_top.php" class="back-icon"><i class="fas fa-hand-point-left"></i></a>
        
          <img src="<?php echo '/img/'.$info_head[0]['user_img']?>" class="profile_img">
          <div class="details">
            <span><?=$info_head[0]['user_name']?></span><!-- echo $row['fname']. " " . $row['lname']-->
          </div>
    </div>
            <?php else:?>
                <div class="head">
          <a href="friends_top.php" class="back-icon"><i class="fas fa-hand-point-left"></i></a>
        
          <img src="/img/defo.png" alt="" class="click_profile"></a>
          <div class="details">
            <span><?=$info_head[0]['user_name']?></span><!-- echo $row['fname']. " " . $row['lname']-->
          </div>
    </div>

            <?php endif;?>
    
    <div class="profile_head">～プロフィール～

    <div class="friends_profile">
            <div class="f_field_input">
            <p class="f_profile_head">氏名</p><p>　　<?=$info['user_info_name']?></p>
            
            </div>
            <div class="f_three_input">
                <div class="f_field_input">
                <p class="f_profile_head">年齢</p>
                <p>　　<?=$info['user_info_age']?></p>
                
                </div>
                <div class="f_field_input">
                <p class="f_profile_head">出身</p>
                <p>　　<?=$info['user_info_from']?></p>
                </div>
                <div class="f_field_input">
                <p class="f_profile_head">所属</p>
                <p>　　<?=$info['user_info_dept']?></p>
                
                </div>
            </div>
            
            <div class="f_field_input">
            <p class="f_profile_head">趣味　　</p>
            <p class="profile_left"><?=nl2br($info['user_info_hobies'])?></p>
            
            </div>
            <div class="f_field_input">
            <p class="f_profile_head">紹介文</p>
            <p class="profile_left"><?=nl2br($info['user_info_free'])?></p>
           
            </div>
       
    </div>
    

    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>