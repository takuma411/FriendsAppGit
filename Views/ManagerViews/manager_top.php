<?php
// $referer = $_SERVER["HTTP_REFERER"];
// $url = '/LoginViews/login.php';
// if(!strstr($referer,$url)){
//   header("location:/LoginViews/login.php");
// }
session_start();
$_SESSION['manager_role'] = $_SESSION['role'];
// $role = $_SESSION['manager_role'];


if(!isset($_SESSION['manager_role'])){
    $_SESSION = array();
    session_destroy();
    header('Location:/LoginViews/login.php');
    exit();
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
    <div class="container">
        <div class="row">
          <div class="tpo_buttun1 col-12 col-sm-6">
          <button class="register-click" onclick="location.href='register.php'">登録</button>
          </div>
          <div class="col-12 col-sm-6">
          <button class="search-click" onclick="location.href='search_users.php'">検索</button>
          </div>
      </div>
    </div>
    <!-- <div class="manager-top">
      <div class="register-buttoum">
          <button class="register-click">登録</button>
      </div>
      <div class="search-buttoum">
          <button class="search-click">検索</button>
      </div>
    </div> -->
      
    </section>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>