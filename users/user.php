<?php include_once('../db.php');
$myId=$_POST["myId"];
$sql = "SELECT * FROM `users` WHERE user_id <> $myId";

if($result = mysqli_query($mysqli,$sql))
{
    
    echo '<ul class="list-group">';
    while ($row = mysqli_fetch_assoc($result))
    {
        $img = base64_encode($row["user_img"]);
        echo '<li id="'.$row["user_id"].'" class="list-group-item"><img width="50px" height="50px" src="data:image/jpeg;base64, '.$img.' "/>'.$row["user_name"].'</li>';
        
    
    }
    echo '</ul>';
}

?>
