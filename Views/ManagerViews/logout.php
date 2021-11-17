<?php
session_start();

$_SESSION = array();
session_destroy();
header('Location:/LoginViews/login.php');
exit();
?>