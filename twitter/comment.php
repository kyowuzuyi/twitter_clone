<?php
include 'connect.php';
header("Content-type: text/plain; charset=UTF-8");
//session����l�����擾
    session_start();
    $email=$_SESSION['email'];
    

//eamil��v��name���擾����    
    $sql="SELECT name from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
         $name=$row['name'];
    }


if (isset($_POST['request']))
{
    //�����ɉ�������̏����������iDB�o�^��t�@�C���ւ̏������݂Ȃǁj
   // echo "OK";
   // echo $_POST['request'];
    //echo $_POST['Classname'];
    $comment=$_POST['request'];
    $twitter_id=$_POST['Classname'];
    
    try{
    $sth=$dbh->prepare("INSERT INTO comment(twitter_id,comment_user_name,comment,comment_created) VALUE('$twitter_id','$name',' $comment',now())");

//���s����
$sth->execute();
//header('Location:./tweet.php');
}catch(PDOException $e){
	print"�G���[:".$e->getMessage()."<br/>";
	die();
	}

}
else
{
    echo 'The parameter of "request" is not found.';
}
?>