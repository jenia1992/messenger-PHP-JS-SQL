<?php
$server = "localhost";
$DBuser = "root";
$DBpassword = "";
$DBname = "messanger";
$mysqli = mysqli_connect($server,$DBuser,$DBpassword,$DBname);
    if(mysqli_connect_errno($mysqli)){
        echo "faild to connect to mySQL: ". mysqli_connect_error();
    }

?>