<?php
  //サーバーに連続する
include 'connect.php';
    
//sessionから個人情報を取得
    session_start();
    $email=$_SESSION['email'];

//ページからtweetsを取得
    $new_pass=htmlspecialchars($_POST["new_password"]);

//パースワードをハッシュ化する
$passHash=password_hash($new_pass,PASSWORD_DEFAULT);

var_dump($passHash);
  
try{
    $sth=$dbh->prepare("update users set password ='$passHash' where email ='$email'");


$sth->execute();
header('Location:./twitter.html');
}catch(PDOException $e){
	print"エラー:".$e->getMessage()."<br/>";
	die();
	}


?>
