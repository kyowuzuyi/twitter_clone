<?php
  //�T�[�o�[�ɘA������
include 'connect.php';
    
//session����l�����擾
    session_start();
    $email=$_SESSION['email'];

//�y�[�W����tweets���擾
    $new_pass=htmlspecialchars($_POST["new_password"]);

//�p�[�X���[�h���n�b�V��������
$passHash=password_hash($new_pass,PASSWORD_DEFAULT);

var_dump($passHash);
  
try{
    $sth=$dbh->prepare("update users set password ='$passHash' where email ='$email'");


$sth->execute();
header('Location:./twitter.html');
}catch(PDOException $e){
	print"�G���[:".$e->getMessage()."<br/>";
	die();
	}


?>
