<?php
//�T�[�o�[�ɘA��
 include'connect.php';

    session_start();
    $email=$_SESSION['email'];
   // var_dump($email);
    

//
    $sql="SELECT id from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
         $id=$row['id'];
    }

 try{
    $sth=$dbh->prepare(" update users set isPrank = 0 where id = $id");

//���s����
$sth->execute();
header('Location:./tweet.php');
}catch(PDOException $e){
	print"�G���[:".$e->getMessage()."<br/>";
	die();
	}    header('Location:./twitter.html');       ?>
