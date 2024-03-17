<?php
    session_start();
    require_once("Connexion.php");
	if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);

       
        $result = $bd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email= ?');
        $result->execute(array($email));

        $data = $result->fetch();
        $row = $result->rowCount();

        if ($row == 1) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $password = hash('sha256',$pass);
                if ($data['password'] === $pass) {
                    $_SESSION['user'] = $data['pseudo'];
                    header('Location:Chat.php');
                }
                else
                    header('Location:Accueil.php?login_err=password');
            }
            else
                header('Location:Accueil.php?login_err=email');
        }
        else
            header('Location:Accueil.php?login_err=already');
        
    }
    else
        header('Location:Accueil.php');	
?>
