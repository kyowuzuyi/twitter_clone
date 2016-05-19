<?php

$img = file_get_contents("img.png");
header('Content-type: image/png');
echo $img;

?>