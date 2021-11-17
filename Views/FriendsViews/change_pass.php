<?php
session_start();
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
require_once(ROOT_PATH .'Controllers/Validation.php');

$user = new UserController();
// $profile = $user->SelectProfile();
// $value = $profile['user'];


$profile2 = $user->ImgAndUser();
$value2 = $profile2['user'];




function h($s){
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
$vali = new Validation();
$user = new UserController();
$errors =[];
$pass_suc =[];
$user_new_password_conf = "";
$user_password = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $user_new_password_conf = h($_POST['user_new_password_conf']);
  $user_password = h($_POST['user_password']);
  

  $errors = $vali->PassChangeV();
  $count = array_count_values($errors);
  if(!$count){
    if($user_password === $user_new_password_conf){
      $result = $user->ChangePass();
      if($result){
        $pass_suc['report'] = 'パスワードの変更が完了しました。';
      }

    }else{
      $errors['dont_match'] = 'パスワードが一致しません。<br>二つのパスワードをもう一度ご確認ください';
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
    <?php if(!empty($value2[0]['user_img'])):?>
    <div class="head">
          <a href="friends_top.php" class="back-icon"><i class="fas fa-hand-point-left"></i></a>
        
          <img src="<?php echo '/img/'.$value2[0]['user_img']?>" class="profile_img">
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

    <div class="explain">
      パスワードは半角英数字６文字以上でご入力ください。
    </div>
    <?php if(isset($pass_suc['report'])):?>
          <div class="suc_text"><?=$pass_suc['report']?></div>
    <?php endif;?>
    <?php if(isset($errors['user_password'])):?>
          <div class="err_text"><?=$errors['user_password']?></div>
    <?php endif;?>

      <form action="#" method="POST">
        
        <div class="field_input_pass">
          <label>新しいパスワード</label>
          <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="パスワードを入力してください"><i class="toggle-pass fas fa-eye"></i>
        
        </div>
        <div class="field_input_pass">
          <label>パスワード再入力</label>
          <input type="password" name="user_new_password_conf" class="form-control" id="exampleInputPassword1" placeholder="パスワードをもう一度入力してください"><i class="toggle-pass fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="送信" class="btn btn-success">
        </div>
      </form>
    </section>
  </div>
  
  <script>
        $(function() {
  $('.toggle-pass').on('click', function() {
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
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>
    

  