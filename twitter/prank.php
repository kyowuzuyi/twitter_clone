<?php//サーバーに連続 include'connect.php';    session_start();    $email=$_SESSION['email'];   // var_dump($email);    //    $sql="SELECT id from users WHERE email='$email'";    $sth=$dbh->prepare($sql);    $sth->execute();    $result=$sth->fetchAll();    foreach($result as $row){         $id=$row['id'];    }          $pranked_id=htmlspecialchars($_POST["pranked_id"]);    try{    $sth=$dbh->prepare(" update users set isPrank = 1 where id = $pranked_id");//実行する$sth->execute();header('Location:./tweet.php');}catch(PDOException $e){	print"エラー:".$e->getMessage()."<br/>";	die();	}    ?>