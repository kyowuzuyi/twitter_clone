<?php

//�T�[�o�[�ɘA������
include 'connect.php';

//�y�[�W��������擾    
$email=htmlspecialchars($_POST["email"]);

             session_start();
            $_SESSION['email']=$email;
           header('Location:./cngpass.html');
?>
