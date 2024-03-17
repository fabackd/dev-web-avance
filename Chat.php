<?php
    session_start();
    if (!isset($_SESSION['user'])) {
       header('Location:Accueil.php');
    }
    require_once('Connexion.php');

    $pdstat = $bd->prepare("SELECT * FROM utilisateurs");
    $user = $_SESSION['user'];
    $pdstat1 = $bd->prepare("SELECT pseudo FROM utilisateurs pseudo=$user");

    $pdstat->execute();
    $pdstat1->execute();

    $users = $pdstat->fetchAll();
    $users1 = $pdstat1->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <script>
        var from=NULL , start=0;
        document.ready(function(){
            from = prompt('Please enter your name');
            alert("Hello "+from);
        })
    </script>
    <title>Chat</title>
    <style>
        .author{
            float: left;
            margin-left: 2px;
            font-family: 'Times New Roman', Times, serif;
            color: black;
            font-weight: bold;
            background-color: dimgrey;
            color: white;
            border-radius: 0px 0px 0px 0px;
            opacity: 0.7;
            height: 80px;
            width: 80px;
            border-radius: 50px 50px;
            text-align: center;
            border-color: 1px solid transparent;
            padding-top: 25px;
        }
        .content{
            float: right;
            color: darkkhaki;
            margin-top: 4px;
            margin-right: 2px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .created_at{
            background-color: black;
            color: cyan;
            margin-right: 2px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .chat{
            float: left;
            width : 100%;
            height: auto;
            background-color: white;
            border-color: 1px solid transparent;
            scroll-margin-right: auto;
            margin-left: 3px;
            overflow-x: hidden;
            overflow-y: scroll;
            box-shadow: 0px 3px 3px 0px rgba(122, 117, 117, 0.2);
        }
        .message{
            float: left;
            border-radius: 0px 10px 10px 10px;
            border-color: 1px solid transparent;
            background-color: rgb(230, 225, 225);
            color : black;
            height: auto;
            width: 320px;
            padding: 3px 5px;
            margin: 5px;
            box-shadow: 0px 3px 3px 0px rgba(122, 117, 117, 0.2);
        }
        body{ 
            background:#eee; 
        } 
        h1{
            text-align: center;
        }
        .card{
            width: 100%;
        }
        a{
            margin-left: 4px;
        }
        h3{
            color: mediumaquamarine;
            height: 90px;
            width: 90px;
            border-radius: 50px 50px;
            text-align: center;
            border-color: 1px solid transparent;
            padding-top: 25px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            background-color: dimgrey;
            margin-top: 10px;
        }
        img{
            width: 2.0em;
            height: 2.0em;
            border-color: 1px solid transparent;
        }
        .icon{
            position: relative;
        }
        .icon button {
            position: absolute;
            left: 495px;
            top: 0px;
        }
        .contener-left{
            float: left;
            width: 500px;
            margin-left: 5px;
            height: auto;
            background-color: white;
            margin: 4px;
            border: 1px solid transparent;
            border-radius: 2px 2px 2px 2px;
            box-shadow: 0px 3px 3px 0px rgba(122, 117, 117, 0.2);
        }
    </style>
</head>
<body>
    <div class="container content chat"> 
        <a href="Deconnexion.php" ><img src="images/switch.png" alt="deconnexion"></a>
        <div class="row"> 
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-12 col-12"> 	
                <div class="card"> 		
                    <div class="card-header"><h3><?php echo $_SESSION['user']; ?></h3>en ligne<h1> Wakhtaan Chat</h1></div> 		
                        <div class="card-body height3"> 			
                            <div class="chat-list"> 														
                                <div class="chat-body">
                                    <div class="chat-message messages"> 							
                                                                
                                    </div> 
                                </div> 				
                            </div>
                        </div>
                        <div class="user-inputs">
                            <form action="Handler.php?task=write" method="post" class="icon">
                                <input type="text" name="author" id="author" value="<?php echo $_SESSION['user'] ?>" class="form-control rounded-left" hidden>
                                <input type="text" name="content" id="content" placeholder="Ecrire votre message" class="form-control rounded-left">
                                <button type="submit"><img src="images/send-message.png" alt="send"></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="contener-left row">
                    <h3>Les membres en ligne</h3>
                </div>
            </div>  
        </div>
    </div>
    <script src="App.js"></script>
</body>
</html>