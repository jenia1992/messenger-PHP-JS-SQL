<?php include_once('./db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="registerStyle.css">
    <title>Document</title>
</head>
    <body>
        <form>
          <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="email"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="userName" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <input type="submit" class="registerbtn" value="Register"/>
              </div>

              <div class="container signin">
                <p>Already have an account? <a href="./login.php">Sign in</a>.</p>
              </div>
</form>
    </body>
    <script>
        $( document ).ready(function(){
       $('form').on('submit',function(event){
           event.preventDefault();
           var formData = $(this).serialize();
           $.ajax({
               url:'authentication/regauth.php',
               data: formData,
               method: 'POST'
           }).done(function(data){
               if(data == 1){
                   window.location.href = "http://localhost/php/icqMessanger/login.php";
               }
           })
       }) 
    });
    </script>
</html>