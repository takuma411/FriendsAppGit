<?php
session_start();


if(isset($_SESSION['user_unique_id'])){
    require_once(ROOT_PATH .'Controllers/UserController.php');
    $user = new UserController();
    $user->Send_Msg();
    //回数を数える
    $user->CountMsgGetPoint();
    
    //ギフトを送った側のマイナス処理
    $user->UserGiftMinus();
    //ギフトを受け取った側のプラス処理
    $user->UserGiftPointPlus();


}



?>