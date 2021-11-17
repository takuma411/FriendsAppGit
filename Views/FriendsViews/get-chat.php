<?php
session_start();


if(isset($_SESSION['user_unique_id'])){
    require_once(ROOT_PATH .'Controllers/UserController.php');
    $user = new UserController();
    
    $chat = $user->Get_Msg();
    echo $chat;
    
}



?>