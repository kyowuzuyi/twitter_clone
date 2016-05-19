<?php
  //サーバーに連続する
include 'connect.php';
    
//sessionから個人情報を取得
    session_start();
    $email=$_SESSION['email'];
    

//eamil一致のidを取得する    
    $sql="SELECT id from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
         $id=$row['id'];
    }

//ページからtweetsを取得
$text = htmlspecialchars($_POST["text"]);
$tweetid = htmlspecialchars($_POST['tweetid']);
var_dump($tweetid);
var_dump($text); 
  

try{
    $sth=$dbh->prepare("INSERT INTO tweets(user_id,text,quotation_id,created) VALUE('$id','$text','$tweetid',now())");

//実行する
$sth->execute();
header('Location:./tweet.php');
}catch(PDOException $e){
	print"エラー:".$e->getMessage()."<br/>";
	die();
	}
?>
