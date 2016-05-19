
<?php
    include'connect.php';
    session_start();
    if(isset($_SESSION['email'])):
    ?>
<?php $email=$_SESSION['email']; ?>

<?php
//いたずらを判定
    $sql="SELECT isPrank from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
       $isPrank=$row['isPrank'];
    }
  //var_dump($isPrank);
    ?></h1>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>つぶやき</title>

<?php
if($isPrank):
echo '<link rel="stylesheet" type="text/css" href="tweet2.css"/>';
?>

<?php else:
echo '<link rel="stylesheet" type="text/css" href="tweet.css"/>';
    ?>
<?php endif ?>
<script type="text/javascript" src="twitter.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function()
   {
        $('button').click(function()
        {
            var get_class=$(this).parent().parent().attr('class');
	    var comment=$('#ID'+ get_class).val();
	// alert("comment:"+comment);	
            var data = {request :comment,Classname : get_class};

            $.ajax({
                type: "POST",
                url: "comment.php",
                data: data,
                success: function()
                {
                    //alert(data);
					location.reload();//ページを更新			
                },
               
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                   
                    alert('Error : ' + errorThrown);
                }
            });
            return false;
        });
  });
 </script> 
 

</head>
<body>
<div id="top" style="background-color:#6495ED; text-align:center; padding-bottom:-30px; margin-bottom:30px;  margin-top:5px;">
<img src="images.png" width="50px">
</div>
<div style="width:994px;  border-style:outset; text-align:center;"><a style="text-decoration:none; color:white;" href="./loginOut.php">ログアウト</a></div><br>
<div id="head">
<div class="pic_name" style="margin-top:10px; overflow:hidden; zoom:1;">
<?php
//写真を表示
    $sql="SELECT picURL from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
        $pic_url=$row['picURL'];
    }
   // var_dump($id);
   if ($pic_url != NULL):
echo '<img style="float:left;" src="'.$pic_url.'">';
?>

<?php else:
   echo '<img style="float:left;"src="img/profile.png">';
    ?>
<?php endif ?>
<h1 style="float:left; margin-top:15px;"><?php
    $sql="SELECT name,id from users WHERE email='$email'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
       echo $row['name'];
        $id=$row['id'];
    }
   // var_dump($id);
    ?></h1>
    </div>
<div class="list" style="margin-top:10px;margin-left:10px;">
<ul style="list-style-type: none; margin-left:-40px;color:;">    
<li><a style="text-decoration:none;color:#8B0000;" href="userslist.php">友達を探す</a></li>
<li style="margin-top:10px;"><a style="text-decoration:none;color:#8B0000;" href="followList.php">フォロー</a></li>
<li style="margin-top:10px;"><a style="text-decoration:none;color:#8B0000;" href="followerList.php">フォロワー</a></li>
</ul>
</div>
</div>
</div>

<div id="talk">
<img src="img/profile.png" width="40" height="40">
<form action="post.php" id="a" name="a" method="post">
    <input style="margin-top:40px; margin-left:15px; width:500px;" type="text" name="text" class="input"  id="text" value="What's happen" onfocus="cleartext(this)" onblur="resettext(this)">
    <input type="submit" value="tweet">
</form>
</div>
<div id="parent">
	<h4>つぶやき：</h4>
	<div id="box">
	<div id="update">
<?php
     $sql ="select * from(select endTable.follow_id,endTable.follow,endTable.name,endTable.tweets_id,endTable.newtext,endTable.quotation_id,tweets.text,endTable.created from(select user_follow.id as follow_id,user_follow.follow,midTable.name,midTable.tweets_id,newtext,midTable.quotation_id,created from( select users.id,users.name,tweets.id as tweets_id,tweets.text as newtext,tweets.quotation_id,tweets.created from users inner join tweets on users.id=tweets.user_id) as midTable left outer join user_follow on midTable.id=user_follow.follow) as endTable left outer join tweets on endTable.quotation_id = tweets.id) as endAtable where endAtable.follow_id=$id order by created desc";

    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();

//表示
    foreach($result as $row){
	 $tweets_id=$row['tweets_id'];
	 $tweets_quotation_id=$row['quotation_id'];
	 $tweet_quotation_text=$row['text'];	
	 $tweet_id_name=$row['name'];
	 $tweet_id_text=$row['newtext'];
	 
	 	

//写真をget	 
	$sql="SELECT picURL from users WHERE name='$tweet_id_name'";
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll();
    foreach($result as $row){
        $pic_url=$row['picURL'];
    }
   echo '<div class="'.$tweets_id.'" style="border-top:1px solid #DCDCDC;zoom:1;">';
   if ($pic_url != NULL){
   echo '<img style="float:left;margin-top:5px;margin-left:5px;" src="'.$pic_url.'" height=60px width=60px;>';
   }else{
	 echo '<img style="float:left; margin-top:5px;margin-left:5px;" src="img/profile.png" height=60px width=60px;>';
   }

//ここからつぶやきです

	echo '<div class="nameAndText" style="float:left; width:600px; padding-top:10px;">&nbsp<b style="color:#0000CD;">'.$tweet_id_name.'</b>';
       echo '<p>&nbsp'.$tweet_id_text.'</p>';
       echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp'.$tweet_quotation_text.'</p></div>';


	  
//ここからコメントです
	$sql_comment="select comment_user_name,comment from comment where twitter_id=$tweets_id order by comment_created desc";
	$sth_comment=$dbh->prepare($sql_comment);
    	$sth_comment->execute();
    	$result_comment=$sth_comment->fetchAll();
		$comment_len=count($result_comment);

/*------------ここからgoodpress人数を取得-------------------*/
	$user_count = 0;
	$sth = "select ispressed from good_press where tweet_id=$tweets_id";
 	$sth=$dbh->prepare($sth);
    $sth->execute();
    $result=$sth->fetchAll();
   
    foreach($result as $key=>$row){
		 $temp = (int)($row['0']);
		  if($temp === 1){
		  $user_count++;
		  }
		  
	}

/*------------------------------------------------------------*/

	echo '<table class="_table" border="0" width="700px"><th class="'.$tweets_id.'">comment('.$comment_len.')</th><th class="'.$tweets_id.'">retweet</th>
<th class="'.$tweets_id.'" id="'.$id.'">いいね('.$user_count.')</th></table>';
	echo '<form class="comment_'.$tweets_id.'" style="display:none;" id="'.$tweets_id.'"'.'method="post">
	<input style="margin-top:10px;margin-left:10px;" type="text" id="ID'.$tweets_id.'"'.'><button>コメント</button></form>';
	
	 foreach($result_comment as $row_comment){
	echo '<div class="comment_'.$tweets_id.'" style="font-style:normal;display:none;margin-top:10px;margin-left:60px;margin-bottom:10px;">&nbsp<b>'.$row_comment['comment_user_name'].'</b>のコメント:'.$row_comment['comment'].'</div>';
		}
//ここからretweetする
	echo '<form class="retweet_'.$tweets_id.'" style="display:none;background-color:#D3D3D3;" id="'.$tweets_id.'"'.'method="post" action="retweet.php">
	<input type="text" id="ID'.$tweets_id.'" name="text" '.'>
	<input type="hidden" name="tweetid" value="'.$tweets_id.'">
<input type="submit" value="retweet"></form>';

	echo '</div>';
    }
    ?>
</div></div>

</div>

<!-- jQuery -->
<script src="js/jquery.js">
</script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
var resources=document.querySelector("#update");
resources.addEventListener('click',Click,false);
function Click(ev){
	var target = ev.target;
  //  var stringName = target.innerText;//firefox対応できない
  var stringName = target. textContent;//firefox対応
//文字列の先頭文字によって,操作を選んで
	if(stringName[0] == 'r'){ 
	var retweet_classname=target.className;
	var retweet=document.querySelector(".retweet_"+retweet_classname);
	var nextDom=document.querySelectorAll(".comment_"+retweet_classname);
		for(var i=nextDom.length;i--;){
		nextDom[i].style.display = "none";//隣のcommentをnoneにする
			}
	if(retweet.style.display === "none"){
		retweet.style.display = "block";
	}else{
		retweet.style.display = "none";
		}
	}else if (stringName[0] == 'い'){
//いいね機能
 //alert(target.textContent);
		 $.ajax({
            type: "POST",
            url: "goodpress.php",
            data: {
                "tweetid": target.className
            },
            success: function(j_data){
			//	target.innerText = 'いいね('+j_data+')';
				target.textContent = 'いいね('+j_data+')';
		//		alert(j_data);
            }
        });
	}else if (stringName[0] == 'c'){
	var comment_classname=target.className;
	var comment_list_class=document.querySelectorAll(".comment_"+comment_classname);
	var nextDom=document.querySelector(".retweet_"+comment_classname);
		nextDom.style.display = "none";//隣のretweetをnoneにする
	for(var i=comment_list_class.length;i--;){
			if(comment_list_class[i].style.display === "block")
			{comment_list_class[i].style.display="none";}
			else{comment_list_class[i].style.display="block";}
	}
		}

}
</script>
</body>
</html>
<?php else:
    include'loginWarning.php';
?>
<?php endif ?>
