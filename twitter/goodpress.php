<?php
include 'connect.php';
header("Content-type: text/plain; charset=UTF-8");
//session�����l�������擾
    session_start();
    $email=$_SESSION['email'];
   
//eamil���v��name���擾����    
    $sql="SELECT id from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
         $id=$row['id'];
    }


if (isset($_POST['tweetid']))
{
    //�����ɉ��������̏����������iDB�o�^���t�@�C���ւ̏������݂Ȃǁj
   // echo "OK";    //echo $_POST['tweetid'];
    $tweetid=$_POST['tweetid'];
    $pre = 0;
    
 	$sth = "select good_press_user_id,ispressed from good_press where tweet_id= $tweetid";
 	$sth=$dbh->prepare($sth);
    $sth->execute();
    $result=$sth->fetchAll();
  //  var_dump($result);
    foreach($result as $key=>$good_user_id){

		if($id === $good_user_id['good_press_user_id']){
			//ispressed=0
			$pre = 1;
			break;
		}		
	}
	
	//echo $pre;
	if($pre === 0){//�Ȃ� �o�^
		 try{
   	 $sth=$dbh->prepare("INSERT INTO good_press(tweet_id,good_press_user_id,ispressed) VALUE('$tweetid','$id',1)");
//���s����
	$sth->execute();
//header('Location:./tweet.php');
	}catch(PDOException $e){
	print"�G���[:".$e->getMessage()."<br/>";
	die();
	}	
		
	}else{//�����@�X�V�@
			$switch = (int)($good_user_id['ispressed']);
//	var_dump($switch);
			if($switch === 1){ 
			$switch = 0;
			}else{							
			$switch = 1;
		}
	//var_dump($switch);
		 try{
    $sth=$dbh->prepare("update good_press set ispressed = '$switch' where  good_press_user_id='$id' AND tweet_id = '$tweetid' ");
//���s����
//update good_press set ispressed = 1 where  good_press_user_id=48 AND tweet_id = 180;
$sth->execute();
//header('Location:./tweet.php');
}catch(PDOException $e){
	print"�G���[:".$e->getMessage()."<br/>";
	die();
	}
	}
//pressed�l�����擾
	$user_count = 0;
	$sth = "select ispressed from good_press where tweet_id=$tweetid";
 	$sth=$dbh->prepare($sth);
    $sth->execute();
    $result=$sth->fetchAll();
   
    foreach($result as $key=>$row){
		 $temp = (int)($row['0']);
		  if($temp === 1){
		  $user_count++;
		  }
		  
	}
	echo $user_count;

}
else
{
    echo 'The parameter of "request" is not found.';
}
?>