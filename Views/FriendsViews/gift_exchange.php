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
$err = [];
if (isset($_POST['500card'])) {
  if($data['gift_point'] < 50){
    $err['500card'] = 'ポイントが不足しています';

  }else{
    header('Location:item1.php?user_unique_id='.$_SESSION['user_unique_id']);
    exit();
  }
}

if (isset($_POST['1000card'])) {
  if($data['gift_point'] < 100){
    $err['1000card'] = 'ポイントが不足しています';

  }else{
    header('Location:item2.php?user_unique_id='.$_SESSION['user_unique_id']);
    exit();
  }
}

if (isset($_POST['50_pro'])) {
  if($data['gift_point'] < 50){
    $err['50_pro'] = 'ポイントが不足しています';

  }else{
    header('Location:item3.php?user_unique_id='.$_SESSION['user_unique_id']);
    exit();
  }
}

if (isset($_POST['150_pro'])) {
  if($data['gift_point'] < 150){
    $err['150_pro'] = 'ポイントが不足しています';

  }else{
    header('Location:item4.php?user_unique_id='.$_SESSION['user_unique_id']);
    exit();
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
    <div class="profile_head">現在のFriendsポイントは<span class="gift_point_color"><?=$data['gift_point']?>P</span>です</div>
    <?php if(isset($err['500card'])):?>
      <div class="err_text"><?=$err['500card']?></div>
      <?php endif;?>
      <?php if(isset($err['1000card'])):?>
      <div class="err_text"><?=$err['1000card']?></div>
      <?php endif;?>
      <?php if(isset($err['50_pro'])):?>
      <div class="err_text"><?=$err['50_pro']?></div>
      <?php endif;?>
      <?php if(isset($err['150_pro'])):?>
      <div class="err_text"><?=$err['150_pro']?></div>
      <?php endif;?>
      
   

    <table class="shop_table">
        <tr>
            <th>商品名</th>
            <th>交換ポイント数</th>
            <th>　　　　</th>
        </tr>

        <tr>
            <td>500円商品券</td>
            <td>50P</td>
            <form action="#" method="POST">
              <input type="text" name="500card" value="500card" hidden>
            <td><button class="btn btn-warning">交換</button></td>
            
            </form>
        </tr>
        <tr>
            <td>1000円商品券</td>
            <td>100P</td>
            <form action="#" method="POST">
              <input type="text" name="1000card" value="1000card" hidden>
              <td><button class="btn btn-warning">交換</button></td>
            
            </form>
            
        </tr>
        <tr>
            <td>自社化粧品</td>
            <td>50P</td>
            <form action="#" method="POST">
              <input type="text" name="50_pro" value="50_pro" hidden>
              <td><button class="btn btn-warning">交換</button></td>
            
            </form>
        </tr>
        
        <tr>
            <td>自社パーカー</td>
            <td>150P</td>
            <form action="#" method="POST">
              <input type="text" name="150_pro" value="150_pro" hidden>
              <td><button class="btn btn-warning">交換</button></td>
            
            </form>
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