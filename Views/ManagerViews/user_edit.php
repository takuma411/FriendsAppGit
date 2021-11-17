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

$params = $user->user_detail();
$param = $params['user'];

$role = "";
//SESSION受け取り
$user_name = "";
$user_name_kana = "";
$user_email = "";
$user_unique_id = "";
$user_area = "";
$role = "";
$user_name = $_SESSION['fuser_name'];
$user_name_kana = $_SESSION['fuser_name_kana'];
$user_area = $_SESSION['fuser_area'];
$user_email = $_SESSION['fuser_email'];
$user_unique_id = $_SESSION['fuser_unique_id'];
$role = $_SESSION['frole'];


$errors =[];

//バリデーション
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $user_name = h($_POST['user_name']);
  $user_name_kana = h($_POST['user_name_kana']);
  $user_email = h($_POST['user_email']);
  $user_area = $_POST['user_area'];
  

  $errors = $vali->ManagerE();
  $count = array_count_values($errors);
      if(!$count){
          $_SESSION['fuser_name'] = h($_POST['user_name']);
          $_SESSION['fuser_name_kana'] = h($_POST['user_name_kana']);
          $_SESSION['fuser_email'] = h($_POST['user_email']);
          $_SESSION['fuser_area'] = $_POST['user_area'];
          if(isset($_POST['role'])){
            $_SESSION['frole'] = $_POST['role'];
          }
          header('Location:user_edit_confirm.php');
      }else{
        if(isset($_POST['user_name']) && isset($_POST['user_name_kana']) && isset($_POST['user_email']) && isset($_POST['user_area'])){
        $user_name = h($_POST['user_name']);
        $user_name_kana = h($_POST['user_name_kana']);
        $user_email = h($_POST['user_email']);
        $user_area = $_POST['user_area'];
        }
      }
}else{
      
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
      
      <form action="#" method="POST">
        <div class="error-text"></div>
        <div class="field_input">
          <label>氏名</label>
          <input type="text" name="user_name" class="form-control" id="exampleInputPassword1"value="<?php if(isset($_POST['user_name'])):?><?=$_POST['user_name']?><?php elseif(!isset($_POST['user_name'])):?><?=$param['user_name']?><?php endif;?>">
          <?php if(isset($errors['user_name'])):?>
          <div class="err_text"><?=$errors['user_name']?></div>
          <?php endif;?>
        </div>
        <div class="field_input">
          <label>氏名カナ</label>
          <input type="text" name="user_name_kana" class="form-control" id="exampleInputPassword1" value="<?php if(isset($_POST['user_name_kana'])):?><?=$_POST['user_name_kana']?><?php elseif(!isset($_POST['user_name_kana'])):?><?=$param['user_name_kana']?><?php endif;?>">
          <?php if(isset($errors['user_name_kana'])):?>
          <div class="err_text"><?=$errors['user_name_kana']?></div>
          <?php endif;?>
        </div>
        <div class="field_input">
          <label>勤務エリア</label>
          <select name="user_area" value="<?php if(isset($_POST['user_area'])):?><?=$_POST['user_area']?><?php elseif(!isset($_POST['user_area'])):?><?=$param['user_area']?><?php endif;?>">
            <option value="エリア">エリア</option>
            <option value="東京" <?php if($user_area =='東京'):?><?='selected'?><?php endif;?>>東京</option>
            <option value="大阪" <?php if($user_area =='大阪'):?><?='selected'?><?php endif;?>>大阪</option>
            <option value="名古屋" <?php if($user_area =='名古屋'):?><?='selected'?><?php endif;?>>名古屋</option>
            <option value="福岡" <?php if($user_area =='福岡'):?><?='selected'?><?php endif;?>>福岡</option>
            <option value="北海道" <?php if($user_area =='北海道'):?><?='selected'?><?php endif;?>>北海道</option>
            <option value="仙台" <?php if($user_area =='仙台'):?><?='selected'?><?php endif;?>>仙台</option>
          </select>
          <?php if(isset($errors['user_area'])):?>
          <div class="err_text"><?=$errors['user_area']?></div>
          <?php endif;?>
        </div>
        <div class="field_input">
          <label>メールアドレス</label>
          <input type="text" name="user_email" class="form-control" id="exampleInputPassword1"value="<?php if(isset($_POST['user_email'])):?><?=$_POST['user_email']?><?php elseif(!isset($_POST['user_email'])):?><?=$param['user_email']?><?php endif;?>">
          <?php if(isset($errors['user_email'])):?>
          <div class="err_text"><?=$errors['user_email']?></div>
          <?php endif;?>
        </div>
        <!-- <div class="field_input">
          <label>FriendsID</label>
          <input type="text" name="user_unique_id" class="form-control" id="exampleInputPassword1"value="<?=$user_unique_id?>">
          <?php if(isset($errors['user_unique_id'])):?>
          <div class="err_text"><?=$errors['user_unique_id']?></div>
          <?php endif;?>
        </div> -->
        <div class="field_input">
          <label>管理者登録の場合はチェック</label>
          <input name="role" type="hidden" value="0">
          <input type="checkbox" name="role" value="1"<?php if($role == 1):?><?='checked'?><?php endif;?>>
        </div>
        
        <div class="field_button">
          <input type="submit" name="submit" value="編集確認へ" class="btn btn-success">
        </div>
      </form>
      
    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>