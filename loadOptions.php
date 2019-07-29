<?php include_once("./db.php");
if(isset($_POST["otherid"]))
{
    $userid = $_POST["otherid"];
    $query="SELECT * FROM `users` WHERE user_id =$userid";
    if($result = mysqli_query($mysqli,$query))
{
    while ($row = mysqli_fetch_assoc($result))
    {
       echo '<div>
                <p>'.$row["user_name"].'</p>
                <p>'.$row["user_id"].'</p>
                <p>'.$row["user_password"].'</p>
                <p>user Name</p>
                <input type="text" onchange=editHandler(event,"userName") />
                <p>user Password</p>
                <input type="number" onchange=editHandler(event,"password") />
                <input type="submit" value="Submit" onclick=submitHandler('.$row["user_id"].') />
                <input type="button" value="DELETE user" class="btn btn-danger" onclick=deleteUserHandler('.$row["user_id"].') />
            </div>';
    }
}
}



?>