<?php

//サーバーへ接続
try{
	$dbh = new PDO('mysql:host=127.0.0.1;dbname=kyowu','kyowu','1234');
   }catch(PDOException $e){
	print"エラー:".$e->getMessage()."<br/>";
	die();
	}


//ページからデータを取得
$name=htmlspecialchars($_POST["name"]);
$email=htmlspecialchars($_POST["email"]);
$password=htmlspecialchars($_POST["pass"]);
$pic_save_url="profile_image/".$_FILES["upfile"]["name"];

var_dump($_FILES);

$error=array('size'=>1,
	'type'=>1,
	'noUpload'=>1,
	'user_no_exist'=>1
);//複数のエラーを表示する
//写真をuploadする
if($_FILES['upfile']['name']){//NULL時,写真をuploadしない
	if($_FILES["upfile"]["type"] == "image/png" || $_FILES["upfile"]["type"]== "image/jpg" || $_FILES["upfile"]["type"] == "image/jpeg"){
	if($_FILES['upfile']['size'] <= 160000){
   if(move_uploaded_file($_FILES["upfile"]["tmp_name"],$pic_save_url)){
    chmod($pic_save_url, 0644);//ファイルの権限を設定
   // echo $_FILES["upfile"]["name"] . "をアップロードしました.";
  } else {
        
	$error['noUpload'] = 0;
   	
  }
}else{
        $error['size'] = 0;

}
}else{
	$error['type'] = 0;
}

if( !$error['size'] || !$error['type'] || !$error['noUpload']){//いずれの値が0になるなら、エラー出た
	session_start();
  $_SESSION['error']=$error;
	header('Location:./twitterError2.php');
	exit;
}

}else{
	$pic_save_url=NULL;
}

//user存在かを判定する $istrue
$isture=0;
//パースワードをハッシュ化する
$passHash=password_hash($password,PASSWORD_DEFAULT);

//判定
  $sql="SELECT email from users";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
        if($email === $row['email'])
      	$isture=1;
    }
if($isture===0){

//新規登録:ユーザー情報をdbに登録
try{

//有効なsql文事前に準備する
$sth=$dbh->prepare("INSERT INTO users(name, email, password) VALUE('$name','$email','$passHash')");
//実行する
$sth->execute();
echo '成功';
}catch(Exception $e){
echo $e->getMessage();
}
    

//emailに一致のidを取得

    $sql="SELECT id from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
        var_dump($row['id']);
        $id=$row['id'];
    }
$newPicUrl = "profile_image/".$id.'.jpg';

rename($pic_save_url,$newPicUrl);

try{
$sth=$dbh->prepare("update users set picURL = '$newPicUrl' where id = '$id'");
//実行する
$sth->execute();
echo '成功';
}catch(Exception $e){
echo $e->getMessage();
}

//新規登録後自分のIdをfollowに入れる
    try{
		$dbh->query("insert into user_follow(id,follow) value($id,$id)");
		
    /*    $dbh->beginTransaction();
        $dbh->exec(
                   "insert into user_follow
                   (id,follow)
                   value($id,$id)"
                   );
        $dbh->commit();
        */
	header('Location:./twitter.html');
    }catch(Exception $e){
        $dbh->rollBack();
        echo $e->getMessage();
    }
}else{
	$error['user_no_exist'] = 0;
	session_start();
       $_SESSION['error']=$error;
	header('Location:./twitterError2.php');
	exit ;
}
?>
