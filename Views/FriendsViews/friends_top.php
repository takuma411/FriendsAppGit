<?php
// $referer = $_SERVER["HTTP_REFERER"];
// $url = '/LoginViews/login.php';
// if(!strstr($referer,$url)){
//   header("location:/LoginViews/login.php");
// }
session_start();

if(!isset($_SESSION['user_unique_id']) && !isset($_SESSION['user_name']) && !isset($_SESSION['user_email']) && !isset($_SESSION['user_password']) && !isset($_SESSION['role'])){
  $_SESSION = array();
  session_destroy();
  header('Location:/LoginViews/login.php');
  exit();
}
require_once(ROOT_PATH .'Controllers/UserController.php');
$user = new UserController();

$profile = $user->ImgAndUser();
$value = $profile['user'];

$data = $user->GetByData();
//DBからユーザを取得
$friends_users = $user->FriendsUser();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(isset($_POST['search_name']) && !empty($_POST['search_name'])){
    $search_name = filter_input(INPUT_POST, 'search_name');
    $name_list = $user->user_search_friends();
    if(!$name_list){
      $friends_users = $user->FriendsUser();
    }
    
  }
}else{
  $friends_users = $user->FriendsUser();
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
    <header>
<div id="navArea">

    <nav>
        <div class="inner">
        <ul>
            <li><a href="my_profile.php?user_unique_id=<?=$_SESSION['user_unique_id']?>">プロフィール</a></li>
            <li><a href="change_pass.php?user_unique_id=<?=$_SESSION['user_unique_id']?>">パスワード変更</a></li>
        </ul>
        </div>
    </nav>

    <div class="toggle_btn">
        <span></span>
        <span></span>
        <span></span>
    </div>

<div id="mask"></div>

</div>

<div class="friends-icon">
   <button onclick="location.href='friends_top.php'" class="btn btn-success">Friends</button> 
</div>
<div class="friends-icon">
<button onclick="location.href='logout.php'" class="btn btn-danger">ログアウト</button> 
</div>
</header>
      <div class="head">
      <?php if(!empty($value[0]['user_img'])):?>
        <div class="content">
        <img src="<?php echo '/img/'.$value[0]['user_img']?>" class="profile_img">
          <div class="details">
            <span><?=$value[0]['user_name']?></span><!-- echo $row['fname']. " " . $row['lname']-->
          </div>
        </div>
        <?php else:?>
          <div class="content">
          <img src="/img/defo.png" alt="" class="click_profile"></a>
          <div class="details">
            <span><?=$value[0]['user_name']?></span><!-- echo $row['fname']. " " . $row['lname']-->
          </div>
        </div>
        <?php endif;?>
      </div>
      <form action="#" autocomplete="off" method="POST">
      <div class="search-users">
        <input type="text" placeholder="名前を入力して検索" name="search_name">
        <button type="submit"><i class="fab fa-searchengin"></i></i></button>
        </form>
      </div>

      <!-- ここから検索された場合の処理 -->
      <?php if(isset($name_list) && !empty($name_list)):?>
        

        <div class="users-list">
          <?php if(!empty($name_list[0]['user_img'])):?>
            <div class="content">
            <a href="friends_profile.php?user_unique_id=<?=$name_list[0]['user_unique_id']?>" class="profile_a">
            <img src="<?php echo '/img/'.$name_list[0]['user_img']?>" alt="" class="click_profile"></a>
                <a href="chat.php?user_unique_id=<?=$name_list[0]['user_unique_id']?>" class="user_a">
                <div class="details">
                    <span><?=$name_list[0]['user_name']?></span>
                </div>
                </a>
            </div>
            <?php else:?>
              <div class="content">
              <a href="friends_profile.php?user_unique_id=<?=$name_list[0]['user_unique_id']?>" class="profile_a">
            <img src="/img/defo.png" alt="" class="click_profile"></a>
                <a href="chat.php?user_unique_id=<?=$name_list[0]['user_unique_id']?>" class="user_a">
                <div class="details">
                    <span><?=$name_list[0]['user_name']?></span>
                </div>
                </a>
            </div>
            <?php endif;?>

      

       
      </div>
      <?php elseif(!isset($name_list['user_name'])):?>

      
      <?php foreach($friends_users as $f_user):?>
        <?php foreach($f_user as $value):?>
        
      <div class="users-list">
          <?php if(!empty($value['user_img'])):?>
            <div class="content">
            <a href="friends_profile.php?user_unique_id=<?=$value['user_unique_id']?>" class="profile_a">
            <img src="<?php echo '/img/'.$value['user_img']?>" alt="" class="click_profile"></a>
                <a href="chat.php?user_unique_id=<?=$value['user_unique_id']?>" class="user_a">
                <div class="details">
                    <span><?=$value['user_name']?></span>
                </div>
                </a>
            </div>
            <?php else:?>
              <div class="content">
              <a href="friends_profile.php?user_unique_id=<?=$value['user_unique_id']?>" class="profile_a">
            <img src="/img/defo.png" alt="" class="click_profile"></a>
                <a href="chat.php?user_unique_id=<?=$value['user_unique_id']?>" class="user_a">
                <div class="details">
                    <span><?=$value['user_name']?></span>
                </div>
                </a>
            </div>

            <?php endif;?>

       
      </div>
      <?php endforeach;?>
      <?php endforeach;?>
      <?php endif;?>
      <?php include('footer.php')?>
    </section>
  </div>
  <script>
  (function($) {
var $nav   = $('#navArea');
var $btn   = $('.toggle_btn');
var $mask  = $('#mask');
var open   = 'open'; // class
// menu open close
$btn.on( 'click', function() {
if ( ! $nav.hasClass( open ) ) {
  $nav.addClass( open );
} else {
  $nav.removeClass( open );
}
});
// mask close
$mask.on('click', function() {
$nav.removeClass( open );
});
} )(jQuery);
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>