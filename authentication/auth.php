<?php
include_once('../db.php');
session_start();
$allSet = 1;
if(isset($_POST["id"])){
    $userId = $_POST["id"];
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
    $query = "SELECT * FROM `users` WHERE user_id = $userId ";
    if($result = mysqli_query($mysqli,$query)){
        $row = mysqli_fetch_assoc($result);
        if($row["user_password"] == $password){
            $_SESSION["user_id"] = $userId;
            if($row["authorization"] == 1){
                $_SESSION["admin"] = true;
                echo "admin";
            }
            else{
                $_SESSION["admin"] = false;
                echo "noAdmin";
                    
            }
        }
        else{
            echo '0'; //wrong password
        }
    }
}
?>