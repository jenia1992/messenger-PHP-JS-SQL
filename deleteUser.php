<?php include_once("./db.php");
if(isset($_POST["userid"]))
{
    $userid=$_POST["userid"];
    $query="DELETE FROM `users` WHERE user_id=$userid";
    mysqli_query($mysqli,$query);
    echo "deleted";
}

?>