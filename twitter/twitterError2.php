<?php
session_start();    
$error=$_SESSION['error'];
var_dump($error);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>welcome twitter</title>
<script type="text/javascript" src="twitter.js"></script>
 <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#8EF7A3;">
      
<div id="top" style="background-color:#6495ED; text-align:center; padding-bottom:-30px;">
<img src="images.png" width=50px; >
</div>
<div id="homepage" style="background-color:#8EF7A3; width:600px; margin:0 auto; padding-top:100px;">
<form action="login.php" method="post" id="a" style="padding-top:20px;width:600px; background-color:#8EF7A3;">




<div style="margin-bottom:50px;" id="email">
<div id="1" style="float:left; width:130px;">e-mail</div>


<div class="form-group col-xs-12 floating-label-form-group controls">
<label>e-mail</label>
<input style="color:#9A9A9A;width:400px;margin-left:50px;" type="text" name="email"  value="" class="form-control" placeholder="e-mail" required data-validation-required-message="e-mailを入力してください" onfocus="cleartext(this)" onblur="resettext(this)">
</div>
</div>



<br>
<div id="2" style="float:left; width:130px;">パスワード</div>

<div style="wi"class="form-group col-xs-12 floating-label-form-group controls">
<label>パスワード</label>
<input style="color:#9A9A9A;width:400px; margin-left:50px;;" type="password" name="pass" value="" class="form-control" placeholder="パスワード" required data-validation-required-message="パスワードを入力してください" onfocus="cleartext(this)" onblur="resettext(this)">

</div>


<input style=" margin-right:100px; ;float:right; margin-top:10px; background-color:#3BAEEF; color:white; margin-left:40px; " type='submit' value='ログイン'>
<p>
<Input style="margin-left:0px; margin-top:50px;"type="Checkbox" >保存する ・<a href="http://techc.codephase.net/~kyowu/twitter/retrieve.html">パスワードを忘れた場合はこちら</a>
</form>

<br>
<br>

<br>

<form action="confirm.php" method="post" name="b" style="background-color:#8EF7A3;; width:600px;">
<p style="padding-top:17px; text-align:center;font-size:35px;">Twitter始めませんか?</p>
<hr>

<h1 style="color:red; text-align:center; ">
<?php
	if($error['size'] === 0) echo'写真のサイズが大きすぎる<br>';	
	if($error['type'] === 0) echo'png | jpg |jpeg 拡張子の写真を選んでください<br>';
	if($error['noUpload'] === 0) echo'アプロッド失敗<br>';
	if($error['user_no_exist'] === 0) echo'email既に存在しています<br>';
?>
</h1>
<div style="margin-bottom:70px; margin-top:50px;" id="名前">
<div id="3" style="float:left; width:130px;">名前</div>

<div class="form-group col-xs-12 floating-label-form-group controls">
<label>名前</label>
<input style="color:#9A9A9A;width:400px;margin-left:50px;" name="start_name" type="text" value="" class="form-control" placeholder="名前" required data-validation-required-message="名前を入力してください" onfocus="cleartext(this)" onblur="resettext(this)">
</div>
</div>


<br>

<div style="margin-top:30px;" id="名前">
<div id="6" style=" float:left; width:130px;">e-mail</div>

<div class="form-group col-xs-12 floating-label-form-group controls">
<label>e-mail</label>
<input style="color:#9A9A9A;width:400px;margin-left:50px;" name="start_email" type="text" value="" class="form-control" placeholder="e-mail" required data-validation-required-message="e-mailを入力してください" onfocus="cleartext(this)" onblur="resettext(this)">
</div>




<br>

<div style="margin-top:50px;" id="パスワード">
<div id="5" style="float:left; width:130px;">パスワード</div>

<div class="form-group col-xs-12 floating-label-form-group controls">
<label>パスワード</label>
<input style="color:#9A9A9A;width:400px;margin-left:50px;" name="start_pass" type="password" value="" class="form-control" placeholder="パスワード" required data-validation-required-message="パスワードを入力してください" onfocus="cleartext(this)" onblur="resettext(this)">
</div>
</div>



<p>
<input style="background:#EC8A29; margin-left:230px; margin-top:10px; margin-bottom:10px;" type='submit' value='Twitterに登録する'></p>
</form>
</div>

<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    
  

    
  

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
</body>
</html>
