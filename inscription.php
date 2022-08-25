<?php
// session_start();

include "config/commandes.php";
include "config/connexion.php";
require "headerbis.php";

// if(isset($_SESSION['userxXJppk45hPGu']))
// {
//     if(!empty($_SESSION['userxXJppk45hPGu']))
//     {
//         header("Location: client/");
//     }
// }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="Style.css" rel="stylesheet">
    <title>Login - EasyShop</title>
</head>
<body>
<br>
<br>
<br>
<br>

<div class="container" style="display: flex; justify-content: start-end">
    <div class="row">
        <div class="col-md-10">
        <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email trop long
                            </div>
                        
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div><?php 
                        break;

                        case 'name_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> nom ou prénom trop long
                            </div>
                        <?php 

                    }
                }
                ?>
            <div class="lien"><a href="login.php">Vous avez déjà un compte? Connectez-vous ici.</a></div>
        <form method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="name" required="required" name="nom" class="form-control" style="width: 500px;" >
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="name" name="prenom" required="required" class="form-control" style="width: 500px;" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" required="required" class="form-control" style="width: 500px;" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" required="required" class="form-control" style="width: 500px;">
            </div>
            <br>
            <div class="btninscription">
                <input type="submit" name="envoyer" required="required" class="btn btn-info" value="Inscription">
            </div>
        </form>

        </div>
    </div>
    
    
</div>
    
</body>
</html>

<?php

if(isset($_POST['envoyer']))
{
    if(!empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']))
    {


        
        $email = htmlspecialchars(strip_tags($_POST['email'])) ;
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $nom = htmlspecialchars(strip_tags($_POST['nom']));
        $prenom = htmlspecialchars(strip_tags($_POST['prenom']));
        $password_retype = $password;
        

        $check = $access->prepare('SELECT prenom, nom, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        echo "ok ok";
        $email = strtolower($email);

        if($row == 0){ 
            if(strlen($nom) <= 100 and strlen($prenom) <= 100){
                if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                        if($password === $password_retype){ // si les deux mdp saisis sont bon
                            echo "ok";
                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'adresse IP
                            $ip = $_SERVER['REMOTE_ADDR']; 
                             /*
                              ATTENTION
                              Verifiez bien que le champs token est présent dans votre table utilisateurs, il a été rajouté APRÈS la vidéo
                              le .sql est dispo pensez à l'importer ! 
                              ATTENTION
                            */
                            // On insère dans la base de données
                            $insert = $access->prepare('INSERT INTO utilisateurs(prenom, nom, email, password, ip) VALUES(:prenom, :nom, :email, :password, :ip)');
                            $insert->execute(array(
                                'prenom' => $prenom,
                                'nom' => $nom,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip,
                                //'token' => bin2hex(openssl_random_pseudo_bytes(64))
                            ));
                            header('Location:index.php');
                            die();
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: inscription.php?reg_err=name_length'); die();}   
        }else{ header('Location: inscription.php?reg_err=already'); die();}

        
    }

}

?>