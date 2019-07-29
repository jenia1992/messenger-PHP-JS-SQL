<?php
include_once('../db.php');
session_start();

$allSet = 1;
if(isset($_POST["userName"])){
    $userName = $_POST["userName"];
}
else{
   $allSet = 0; 
}
if(isset($_POST["password"])){
    $password = $_POST["password"];
}
else{
   $allSet = 0; 
}
if($allSet){
    $query = "INSERT INTO `users`(`user_name`, `user_password`) VALUES ('$userName',$password)";
    mysqli_query($mysqli,$query);
    echo 1;
        
}
?>