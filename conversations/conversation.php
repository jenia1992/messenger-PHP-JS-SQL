<?php include_once('../db.php');
if(isset($_POST["myId"])){
    $myId=intval($_POST["myId"]);
}
if(isset($_POST["otherId"])){
    $otherId=intval($_POST["otherId"]);  
}
if($otherId == $myId){
        die();
}

$sql = "SELECT * FROM `conversations` WHERE (user_1 = $myId OR  user_2 = $myId) AND (user_1 = $otherId OR user_2 = $otherId)";
$cov_id;
$right="text-align:right";
$left="text-align:left";
if($result = mysqli_query($mysqli,$sql))
{
    if($result->num_rows != 0){
    while ($row = mysqli_fetch_assoc($result))
    {
        
//        if(($row["user_1"] == $myId || $row["user_1"] == $otherId )&&($row["user_2"] == $myId || $row["user_2"] == $otherId))
        {
            $cov_id = $row["conversations_id"];
            $sql = "SELECT messages.*,users.* FROM `messages` JOIN `users` WHERE conversetion_id = $cov_id AND users.user_id = messages.user_id";
            if($result = mysqli_query($mysqli,$sql))
            {
                echo '<div id="messages">';
                while ($row = mysqli_fetch_assoc($result))
                {
                    if($_POST["myId"] == $row["user_id"])
                        $style=$left;
                    else $style=$right;
                    $img = base64_encode($row["user_img"]);
                    echo '<div style="'.$style.'">
                    <img width="50px" height="50px" src="data:image/jpeg;base64, '.$img.' "/>
                    <p>'.$row["user_name"].'</p>
                    <span class="time-right">'.$row["message_time"].'</span>
                    <p>'.$row["message_body"].'</p>
                    </div>';
                }
                echo '</div>';
            }
        }

      
    }
    }
            else{
            $sql = "INSERT INTO `conversations`(`user_1`, `user_2`) VALUES ($myId,$otherId)";
            $result = mysqli_query($mysqli,$sql);
            echo 99;
            die();
            //create convvvv
        }
}
echo '<div id="'.$cov_id.'">
        
        <textarea style="border-radius:12px" placeholder="Type message.." name="msg" required rows="10" cols="70"></textarea>
       <button class="btn btn-warning" onclick="addMessage('.$cov_id.')" style="display:block">
        
        </div>';


?>
