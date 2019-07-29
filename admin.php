<?php
session_start();
$myId = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>YEVGENY STATE</title>
</head>
<body>
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">YEVGENY STATE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <input onclick="logoutHandler()" class="nav-link" type="button" value="Logout"/>
      </li>
      <li class="nav-item active">
        <input onclick="openreg()" class="nav-link" type="button" value="AAD USER"/>
      </li>
    </ul>
  </div>
</nav>
<form id="usereg" style="display:none">
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
</form>

<div  class="container" >
       <div class="row">
            <div id="chat" class="col">

            </div>
            <h5>chat users</h5>
            <div class="col" id="users" class="col" style="border:2px solid black">
        
            </div>
        </div>
        <div class="row">
            <div class="col" id="userOptions"></div>
            <div>
            <h5>user to edit</h5>
            <div class="col" id="edit"></div>
          </div>
    </div>
   
    </div>

</body>
<script>
        var userName;
        var password;
        var myId = <?php echo $myId; ?>;
        var otherId;
        function openreg(){
            if(document.getElementById("usereg").style.display == "block")
            document.getElementById("usereg").style.display = "none";
            else {
                document.getElementById("usereg").style.display = "block";
//                document.getElementById("chat").style.display = "none";
                
            }
        
        }
        function logoutHandler(){
            $.ajax({
                url:"session.php",
                data:{logout:"logout"},
                method:"POST",
                
            }).done(function(data){
                if(data == 1){
                    window.location.href = "http://localhost/php/icqMessanger/login.php";
                }
            })
        }
        function load_cov(){
            $.ajax({
                url:"conversations/conversation.php",
                method:"POST",
                data:{myId:myId,otherId:otherId}
            }).done(function(data){
                
                if(data == '99'){
                    load_cov();
                    
                }
                    else{
                    $('#chat').html(data);
                    window.setInterval(function(){
                      load_messages();
                    }, 2000);
                }
                
                
            })
            }
        function load_messages(){
            $.ajax({
                url:"messages/loadMessages.php",
                method:"POST",
                data:{myId:myId,otherId:otherId}
            }).done(function(data){
                $('#messages').html(data);
                
            })
            }
        function load_users(){
            $.ajax({
                url:"users/user.php",
                method:"POST",
                data:{myId:myId}
            }).done(function(data){
                $('#users').html(data);
                
                $('li').click(function(){
                    otherId = $(this)[0].id;
                    load_cov();
                })
            })
            }
    function load_users2(){
        var otherId2;
            $.ajax({
                url:"users/user.php",
                method:"POST",
                data:{myId:myId}
            }).done(function(data){
                $('#userOptions').html(data);
                
                $('li').click(function(){
                    otherId2 = $(this)[0].id;
                    $.ajax({
                        url:"loadOptions.php",
                        method:"POST",
                        data:{otherid:otherId2}
                    }).done(function(data){
                        $('#edit').html(data);
                        
                    })
                })
            })
            }
        function addMessage(cov_id){
            $.ajax({
                url:'messages/addMessage.php',
                method:"POST",
                data:{myId:myId,cov_id:cov_id,msgBody:$('textarea').val()}
            }).done(function(){
                $('textarea').val("");
            });
        }
             function deleteCov(){
        $.ajax({
            url:'deleteCov.php',
        }).done(function(data){
            if(data==1){
            alert("!");

            }
        })
        }
    function editHandler(event,eNum){
        if(eNum == "userName"){
            userName = event.target.value;
        }
        if(eNum == "password"){
            password = event.target.value;
        }
    }
    function submitHandler(userid){
        if(userName && password ){   
        $.ajax({
            url:"editUser.php",
            data:{userid:userid,password:password,userName:userName},
            method:"POST"
        }).done(function(data){
            if(data == "bothChanged"){
                alert("both changed");
                load_users2()
            }
        })
    }
        else if(userName){
        $.ajax({
            url:"editUser.php",
            data:{userid:userid,userName:userName},
            method:"POST"
        }).done(function(data){
            if(data == "userChanged"){
                alert("user name changed");
                load_users2()
            }
        })
            }
        else if(password){
            $.ajax({
            url:"editUser.php",
            data:{userid:userid,password:password},
            method:"POST"
        }).done(function(data){
            if(data == "passwordChanged"){
                alert("password changed");
                load_users2()
            }
        })
        }
        else alert("kaka");
    }
    function deleteUserHandler(userid){
        $.ajax({
            url:"deleteUser.php",
            data:{userid:userid},
            method:"POST"
        }).done(function(data){
            if(data == "deleted"){
                alert("DELETED");
                load_users2()
            }
        })
        
    }
        
    $( document ).ready(function(){
        load_users();
        load_users2();
       $('form').on('submit',function(event){
           event.preventDefault();
           var formData = $(this).serialize();
           $.ajax({
               url:'authentication/regauth.php',
               data: formData,
               method: 'POST'
           }).done(function(data){
               if(data == 1){
                   load_users();
                   
               }
           })
       }) 
    });
    
</script>
</html>