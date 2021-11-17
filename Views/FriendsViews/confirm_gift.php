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
$profile = $user->SelectProfile();
$value = $profile['user'];


$profile2 = $user->ImgAndUser();
$value2 = $profile2['user'];

$data = $user->GetByData();

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
    <?php if(!empty($value['user_img'])):?>
    <div class="head">
          <a href="friends_top.php" class="back-icon"><i class="fas fa-hand-point-left"></i></a>
        
          <img src="<?php echo '/img/'.$value['user_img']?>" class="profile_img">
          <div class="details">
            <span><?=$value2[0]['user_name']?></span>
            
          </div>
    </div>
    <?php else:?>
      <div class="head">
          <a href="friends_top.php" class="back-icon"><i class="fas fa-hand-point-left"></i></a>
        
          <img src="/img/defo.png" alt="" class="click_profile"></a>
          <div class="details">
            <span><?=$value2[0]['user_name']?></span>
            
          </div>
    </div>
    <?php endif;?>
    <div class="profile_head">
      現在のFriendsポイントは<span class="gift_point_color"><?=$data['gift_point']?>P</span>です。<br>
     <p class="stock_gift">プレゼントできるGiftは残り<span class="gift_point_color"><?=$data['gift']?>P</span>です。</p> 
  </div>
  <!-- <div class="profile_head">
     <div class="profile_head_1">現在のFriendsポイントは <span class="gift_point_color"><?=$_SESSION['gift_point']?></span>Pです。</div>
     <div class="profile_head_2">プレゼントできるGiftは残り<h2 class="gift_point_color"><?=$_SESSION['gift']?></h2>Pです。</div>
  </div> -->

    <table class="shop_table">
        <tr>
            <th>商品名</th>
            <th>所持数</th>
        </tr>

        <tr>
            <td>500円商品券</td>
            <td><?=$data['own_item1']?></td>
        </tr>
        <tr>
            <td>1000円商品券</td>
            <td><?=$data['own_item2']?></td>
        </tr>
        <tr>
            <td>自社化粧品</td>

            <td><?=$data['own_item3']?></td>
        </tr>
        
        <tr>
            <td>自社パーカー</td>
            <td><?=$data['own_item4']?></td>
    </tr>
    </table>

    </div>
    
    

    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>