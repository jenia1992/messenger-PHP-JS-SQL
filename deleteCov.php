<?php include_once('./db.php');


$q="DELETE FROM `conversations` WHERE conversations_id <> 1";
 mysqli_query($mysqli,$q);
echo 1;

?>