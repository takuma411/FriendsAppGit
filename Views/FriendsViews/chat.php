<?php
session_start();

if(!isset($_SESSION['user_unique_id'])){
  $_SESSION = array();
  session_destroy();
  header('Location:/LoginViews/login.php');
  exit();
}
//$_SESSION['friends_unique_id'] = $_GET['user_unique_id'];
require_once(ROOT_PATH .'Controllers/UserController.php');
$user = new UserController();
// $profile = $user->FriendsHead();
// $value = $profile['user'];
$info_head = $user->GetSendHead();




$msg = $user->Get_Msg();

//メッセージの件数取得
// if($_SERVER['REQUEST_METHOD'] === 'POST'){
// $user->CountMsgGetPoint();
// }

?>
<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
   
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

   
      <div class="chat-box">
      
      </div>
      <div class="up_form">
        <div class="gift_form">
          <form action="#" class="gift_send" method="POST">
                <input type="text" name="outgoing_msg_id" value="<?=$_SESSION['user_unique_id']?>" hidden>
                <input type="text" name="incoming_msg_id" value="<?=$info_head[0]['user_unique_id']?>" hidden>
                <input type="text" class="input-field" name="msg" value="FriendsGiftを送りました！" hidden>
                <button class="gift_button btn btn-warning" type="button"><i class="fas fa-gifts"></i></button> 
          </form>
          </div>

          <div class="pic_form">
          <form action="#" class="img_send" method="POST" enctype="multipart/form-data">
                <input type="text" name="outgoing_msg_id" value="<?=$_SESSION['user_unique_id']?>" hidden>
                <input type="text" name="incoming_msg_id" value="<?=$info_head[0]['user_unique_id']?>" hidden>
                <label>
                  <span class="filelabel" title="ファイルを選択">
                    <img src="/img/defo_camera.jpeg" width="32" height="26" alt="画像">
                    選択
                  </span>
                  <input type="file" name="msg_img" id="filesend" class="input-field">
                </label>
                <button type="button"><i class="fas fa-upload" id="btn"></i></button>
          </form>
          </div>
      </div>
        

        <form action="#" class="typing-area" autocomplete="off" method="POST">
            <input type="text" name="outgoing_msg_id" value="<?=$_SESSION['user_unique_id']?>" hidden>
            <input type="text" name="incoming_msg_id" value="<?=$info_head[0]['user_unique_id']?>" hidden>
            <input type="text" class="input-field" name="msg" placeholder="メッセージを入力">
            <button type="button"><i class="fas fa-paper-plane"></i></button>
        </form>

    </section>
  </div>




    <script src="/js/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>