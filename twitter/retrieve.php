<?php

//サーバーに連続する
include 'connect.php';

//ページから情報を取得    
$email=htmlspecialchars($_POST["email"]);

             session_start();
            $_SESSION['email']=$email;
           header('Location:./cngpass.html');
?>
