<?php include_once("./db.php");

if(isset($_POST["userid"]))
{
    $userid = $_POST["userid"];
    $query="SELECT * FROM `users` WHERE user_id =$userid";
    if($result = mysqli_query($mysqli,$query))
    {
       while ($row = mysqli_fetch_assoc($result))
        {
           if(isset($_POST["userName"]) && isset($_POST["password"]))
           {
               $newName=$_POST["userName"];
               $newPassword=$_POST["password"];
               $query1="UPDATE `users` SET `user_name`='$newName',`user_password`=$newPassword WHERE `user_id` = $userid";
               mysqli_query($mysqli,$query1);
               echo "bothChanged";
           }
           else if(isset($_POST["userName"]))
           {
               $newName=$_POST["userName"];
               $query1="UPDATE `users` SET `user_name`='$newName' WHERE `user_id` = $userid";
               mysqli_query($mysqli,$query1);
               echo "userChanged";
           }
           else if(isset($_POST["password"]))
           {
               $newPassword=$_POST["password"];
               $query1="UPDATE `users` SET `user_password`=$newPassword WHERE `user_id` = $userid";
               mysqli_query($mysqli,$query1);
               echo "passwordChanged";
           }
           else echo "no changes";
                
        }
    }
}


?>