<?php
session_start();
//$user_data = $_SESSION;

//再送信表示させない
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

if(!isset($_SESSION['user_unique_id'])){
  $_SESSION = array();
  session_destroy();
  header('Location:/LoginViews/login.php');
  exit();
}

require_once(ROOT_PATH .'Controllers/UserController.php');


function h($s){
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
require_once(ROOT_PATH .'Controllers/UserController.php');
$user = new UserController();

//初期化
$user_info_name = "";
$user_info_name_kana = "";
$user_info_age = "";
$user_info_from = "";
$user_info_dept = "";
$user_info_hobies = "";
$user_free ="";
$user_img ="";

$suc_text =[];

//画像Uprold
// $file           = $_FILES['img'];
// $filename       = basename($_FILES['name']);
// $file_tmp_path  = $_FILES['tmp_name'];
// $file_err       = $_FILES['error'];
// $file_size      = $_FILES['size'];

//$upload_dir =  '/public/img/';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $user_info_name       = h($_POST['user_info_name']);
  $user_info_age        = h($_POST['user_info_age']);
  $user_info_from       = h($_POST['user_info_from']);
  $user_info_dept       = h($_POST['user_info_dept']);
  $user_info_hobies     = h($_POST['user_info_hobies']);
  $user_info_free       = h($_POST['user_info_free']);

  if(isset($_FILES['user_img'])){
    $user_img_name      = $_FILES['user_img']['name'];
    $user_img_type      = $_FILES['user_img']['type'];
    $user_img_tmp_name  = $_FILES['user_img']['tmp_name'];

    $user_img_explode = explode('.',$user_img_name);
    $user_img_txt     = end($user_img_explode);
    $extensions       = ["png","jpag","jpg"];

    if(in_array($user_img_txt,$extensions) === true){
      $time = time();
      $new_img_name = $time.$user_img_name;
      if(move_uploaded_file($user_img_tmp_name,"img/".$new_img_name)){
        $_SESSION['user_img'] = $new_img_name;

      }
    }
  }

  $result = $user->UpdataProfole();
  if($result){
    $suc_text['massage'] = 'プロフィール登録完了';
  }
  

}
//DBから取得
$profile = $user->SelectProfile();

$value = $profile['user'];

$profile2 = $user->ImgAndUser();
$value2 = $profile2['user'];



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

    <div class="profile_head">～プロフィール～
          <?php if(isset($suc_text['massage'])):?>
          <div class="err_text"><?=$suc_text['massage']?></div>
          <?php endif;?>
          </div> 
    <div class="input_side">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="field_input">
            <label>氏名</label>
            <input type="text" name="user_info_name" class="form-control" id="exampleInputPassword1" value="<?=$value['user_info_name']?>">
            </div>
            <div class="three_input">
                <div class="field_input">
                <label>年齢</label>
                <input type="text" name="user_info_age" class="form-control" id="exampleInputPassword1" value="<?=$value['user_info_age']?>">
                </div>
                <div class="field_input">
                <label>出身</label>
                <input type="text" name="user_info_from" class="form-control" id="exampleInputPassword1" value="<?=$value['user_info_from']?>">
                </div>
                <div class="field_input">
                <label>所属</label>
                <input type="text" name="user_info_dept" class="form-control" id="exampleInputPassword1" value="<?=$value['user_info_dept']?>">
                </div>
            </div>
            <div class="field_file">
            <div class="title_file">
            <label>プロフィール写真</label>
            </div>
            <div class="select_file">
                  <label>
                  <span class="filelabel" title="ファイルを選択">
                    <img src="/img/defo_camera.jpeg" width="32" height="26" alt="画像">
                    選択
                  </span>
                  <input type="file" name="user_img" id="filesend" multiple accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" value="<?=$value['user_img']?>">
                </label>   

                
                <!-- <input type="file" name="user_img" value="<?=$value['user_img']?>"> -->
                </div>
            </div>
            <?php if(!empty($value['user_img'])):?>
              <img src="<?php echo '/img/'.$value['user_img']?>" class="profile_img">
                <?php else:?>
                  <img src="/img/defo.png" class="profile_img">
                <?php endif;?>
           
            <div class="field_input">
            <label>趣味</label>
            <textarea name="user_info_hobies" class="form-control" id="exampleInputPassword1" cols="30" rows="2"><?=$value['user_info_hobies']?></textarea>
            </div>
            <div class="field_input">
            <label>紹介文</label>
            <textarea name="user_info_free" class="form-control" id="exampleInputPassword1" cols="30" rows="8"><?=$value['user_info_free']?></textarea>
            </div>
            <div class="field_button-pro">
            <input type="submit" name="submit" value="登録" class="btn btn-success">
            </div>
        </form>
    </div>
    

    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>