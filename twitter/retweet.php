<?php
  //�T�[�o�[�ɘA������
include 'connect.php';
    
//session����l�����擾
    session_start();
    $email=$_SESSION['email'];
    

//eamil��v��id���擾����    
    $sql="SELECT id from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
         $id=$row['id'];
    }

//�y�[�W����tweets���擾
$text = htmlspecialchars($_POST["text"]);
$tweetid = htmlspecialchars($_POST['tweetid']);
var_dump($tweetid);
var_dump($text); 
  

try{
    $sth=$dbh->prepare("INSERT INTO tweets(user_id,text,quotation_id,created) VALUE('$id','$text','$tweetid',now())");

//���s����
$sth->execute();
header('Location:./tweet.php');
}catch(PDOException $e){
	print"�G���[:".$e->getMessage()."<br/>";
	die();
	}
?>
