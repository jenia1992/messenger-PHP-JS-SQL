    <?php
    session_start();
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
        <title>Document</title>
    </head>
    <body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">icqMesssanger</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <input onclick="logoutHandler()" class="nav-link" type="button" value="Logout"/>
      </li>
      
    </ul>
  </div>
</nav>
    <div  class="container" >
       <div class="row">
            <div id="chat" class="col">

            </div>
            <div id="users" class="col" style="border:2px solid black">

            </div>
        </div>
    </div>
    </body>
    <script>
        var myId = "<?php echo $_SESSION["user_id"]; ?>";
        var otherId;
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
                    
                }else{
                    $('#chat').html(data);
                    // loop that loads the messages every 3 sec
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
        $(document).ready(function(){
            load_users();
            
        })
   
    </script>
    </html>