<?php
    $id=0;
    try{
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=kyowu','kyowu','1234');
    	//session_start();
	//$_SESSION['test']='test';
    }catch(PDOException $e){
        print"エラー:".$e->getMessage()."<br/>";
        die();
    }
?>
