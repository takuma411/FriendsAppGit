<?php
session_start();


if(isset($_SESSION['user_unique_id'])){
    require_once(ROOT_PATH .'Controllers/UserController.php');
    $user = new UserController();
    print_r($_FILES['msg_img']);
    $user->InsertMsgImg();
    //回数を数える
    $user->CountMsgGetPoint();
    
}



?>