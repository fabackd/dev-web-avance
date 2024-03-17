<?php
    session_start();
    require_once("Connexion.php");

	if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirmpassword = htmlspecialchars($_POST['confirmpassword']);
        $image = htmlspecialchars($_POST['image']);

        $sql = "SELECT pseudo, email FROM utilisateurs WHERE email= ? ";
        $result = $bd->prepare($sql);
        $result->execute(array($email));

        $data = $result->fetch();
        $row = $result->rowCount();

        if ($row == 0) {
            if (strlen($pseudo) <= 100) {
                if (strlen($email) <= 100) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if ($password == $confirmpassword) {
                            $password = hash('sha256',$password);
                            //$ip = $_SERVER['REMOTE_ADDR'];
                            $insert = $bd->prepare('INSERT INTO utilisateurs VALUES (NULL, :pseudo, :email, :password, :image)');
                            $insert->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
                            $insert->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
                            $insert->bindValue(':password',$_POST['password'], PDO::PARAM_STR);
                            $insert->bindValue(':image',$_POST['image'], PDO::PARAM_STR);
                            $insert->execute();
                            header('Location:Compte.php?reg_err=success');
                        }
                        else
                            header('Location:Compte.php?reg_err=password');
                    }
                    else
                        header('Location:Compte.php?reg_err=email');
                }
                else
                    header('Location:Compte.php?reg_err=email_length');
            }
            else
                header('Location:Compte.php?reg_err=pseudo_length');
        }
        else 
            header('Location:Compte.php?reg_err=already');
    }	
?>
