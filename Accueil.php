<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Accueil</title>
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $("document").ready(function(){
            var checkbox = $("#affichepassword");
            var password = $("#password");
                // permet d'afficher les mots de passe
                checkbox.click(function(){
                if(checkbox.prop("checked")){
                    password.attr("type", "text");
                }
                else{
                    password.attr("type", "password");
                }
            });
            }); 
    </script>
    <style>
        a {
            color : white;
            text-decoration: none;
        }
        body{
            background:#eee; 
        }
    </style>
</head>
<body>
    <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Wakhtaan Chat Connexion</h3>
						<form method="post" action="Valider_connexion.php" class="login-form">
                        <?php 
            if (isset($_GET['login_err'])) {
                $err = htmlspecialchars($_GET['login_err']);

                switch($err){
                    case 'password' :
                        ?> 
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> mot de passe incorrect
                        </div>
                        <?php
                        break;

                    case 'email' : 
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email incorrect
                        </div>
                        <?php
                        break;

                    case 'already' : 
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Compte non existant
                        </div>
                        <?php
                        break;
                }
            }
         ?>
		      	<div class="form-group">
		      		<input type="text" class="form-control rounded-left" name="email" id="email" placeholder="E-mail" required>
		      	</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" name="password" id="password" placeholder="Mot de Passe" required>
	            </div>
                <div class="col-12">
                    <input type="checkbox" name="check" id="affichepassword">
                    <label for="affichepassword">Voir mot de Passe</label>
                </div>
					<div class="col-12">
                        <button class="btn btn-primary rounded submit p-2 px-3" type="submit"><a href="Compte.php">Inscription</a></button>
					</div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">Se connecter</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>