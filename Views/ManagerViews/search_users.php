<?php
session_start();

//再送信表示させない
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require_once(ROOT_PATH .'Controllers/UserController.php');

$user = new UserController();



//検索バー
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(isset($_POST['search_name']) && !empty($_POST['search_name']) && $_POST['search_area'] == 'エリア'){
    $search_name = filter_input(INPUT_POST, 'search_name');
    $name_list = $user->user_search();
  }
  if(isset($_POST['search_area']) && !empty($_POST['search_area'])){
    $search_area = filter_input(INPUT_POST, 'search_area');
    $area_list = $user->area_search();
  }
  if(empty($_POST['search_name']) && ($_POST['search_area'] =='エリア')){
    $list = $user->user_list();
  }

}else{
  $list = $user->user_list();
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
      <div class="search">
        <input type="text" name="search_name" placeholder="名前を入力して検索">
        <select name="search_area" value="">
          <option value="エリア">エリア</option>
          <option value="東京">東京</option>
          <option value="大阪">大阪</option>
          <option value="名古屋">名古屋</option>
          <option value="福岡">福岡</option>
          <option value="北海道">北海道</option>
          <option value="仙台">仙台</option>
        </select>
        
        <button type="submit"><i class="fab fa-searchengin"></i></button>
      </div>
      <!-- <div class="err_text">
        全て未入力で全ユーザー表示
      </div> -->
      
          
      <!-- <div class="err_text">*未入力で全リスト表示</div> -->
      </form>

      
      <?php if(isset($list['user']) && empty($area_list['area']) && empty($area_list['name'])):?>
        <h2>ユーザ一</h2>
      <table class="shop_table">
        <tr>
            <th>氏名</th>
            <th>エリア</th>
            <th>詳細</th>
        </tr>
        <?php foreach($list['user'] as $user): ?>
        <tr>
            <td><?=$user['user_name']?></td>
            <td><?=$user['user_area']?></td>
            <td><a href="user_detail.php?user_unique_id=<?=$user['user_unique_id']?>">詳細</a></td>
            
        </tr>
        <?php endforeach;?>
        <?php endif;?>


        <?php if(isset($area_list['area']) && !($_POST['search_area'] == 'エリア')):?>
          <h2>ユーザ一</h2>
      <table class="shop_table">
        <tr>
            <th>氏名</th>
            <th>エリア</th>
            <th>詳細</th>
        </tr>
        <?php foreach($area_list['area'] as $name): ?>
        <tr>
            <td><?=$name['user_name']?></td>
            <td><?=$name['user_area']?></td>
            <td><a href="user_detail.php?user_unique_id=<?=$name['user_unique_id']?>">詳細</a></td>
            
        </tr>
        <?php endforeach;?>
        <?php endif;?>


        <?php if(isset($name_list['name'])):?>
          <h2>ユーザ一</h2>
      <table class="shop_table">
        <tr>
            <th>氏名</th>
            <th>エリア</th>
            <th>詳細</th>
        </tr>
        <?php foreach($name_list['name'] as $area): ?>
        <tr>
            <td><?=$area['user_name']?></td>
            <td><?=$area['user_area']?></td>
            <td><a href="user_detail.php?user_unique_id=<?=$area['user_unique_id']?>">詳細</a></td>
            
        </tr>
        <?php endforeach;?>
        <?php endif;?>
    </table>

    <div class="paging">
    <?php if(isset($list['user'])):?>
    <?php
    for($i = 0;$i <=$list['pages'];$i++){
        if(isset($_GET['page']) && $_GET['page'] == $i){
            echo $i+1;
            echo " ";
        }else{
            echo "<a href ='?page=".$i."'>".($i+1)."</a>";
            echo " ";
        }
    }
    ?>
    <?php endif;?>
    </div>
      
      
    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>