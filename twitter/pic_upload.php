<?php
var_dump($_FILES);
 if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "images/".$_FILES["upfile"]["name"])){
    chmod("images/".$_FILES["upfile"]["name"], 0644);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
  }


?>
