<?php
include 'connect.php';
header("Content-type: text/plain; charset=UTF-8");
//sessionから個人情報を取得
    session_start();
    $email=$_SESSION['email'];
    

//eamil一致のnameを取得する    
    $sql="SELECT name from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
         $name=$row['name'];
    }


if (isset($_POST['request']))
{
    //ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）
   // echo "OK";
   // echo $_POST['request'];
    //echo $_POST['Classname'];
    $comment=$_POST['request'];
    $twitter_id=$_POST['Classname'];
    
    try{
    $sth=$dbh->prepare("INSERT INTO comment(twitter_id,comment_user_name,comment,comment_created) VALUE('$twitter_id','$name',' $comment',now())");

//実行する
$sth->execute();
//header('Location:./tweet.php');
}catch(PDOException $e){
	print"エラー:".$e->getMessage()."<br/>";
	die();
	}

}
else
{
    echo 'The parameter of "request" is not found.';
}
?>