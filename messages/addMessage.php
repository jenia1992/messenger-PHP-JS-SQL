<?php
include_once('../db.php');

if(isset($_POST["myId"]))
{
    $myId=$_POST["myId"];
}
if(isset($_POST["msgBody"]))
{
    $msgBody=$_POST["msgBody"];
}
if(isset($_POST["cov_id"]))
{
    $covId=$_POST["cov_id"];
}
$sql = "INSERT INTO `messages`( `message_body`, `user_id`, `conversetion_id`) VALUES ('$msgBody',$myId,$covId)";
mysqli_query($mysqli,$sql);




?>