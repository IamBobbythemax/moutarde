<?php
require "_header.php";
require "headerbis.php";

if(isset($_SESSION['xRttpHo0greL39']))
{
    echo "1";
    if(!empty($_SESSION['xRttpHo0greL39']))
    {

        header("Location: admin/afficher.php");
    } else {
        echo "adfe";
    }
}



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
        <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'unknown-user':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;
                    }
                }
            ?> 


        <div class="col-md-10">
        <a href="inscription.php" class="lien">Pas de compte? Créez-en un ici.</a>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Login</label>
                <input type="email" name="email" required="required" class="form-control" style="width: 500px;" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" required="required" class="form-control" style="width: 500px;">
            </div>
            <br>
            <div class="btnconnexion">
                <input type="submit" name="envoyer" class="btn btn-info" value="Se connecter">
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
    if(!empty($_POST['email']) AND !empty($_POST['password']))
    {
        $email = htmlspecialchars(strip_tags($_POST['email'])) ;
        $password = htmlspecialchars(strip_tags($_POST['password']));

        $email = strtolower($email);

        $admin = getAdmin($email, $password);
        
        $user = getUsers($email, $password);

       

        /*if($admin){
            session_start();
            $_SESSION['xRttpHo0greL39'] = $admin;
            header('Location: admin/afficher.php');
            echo "pas de pb";
        }else{
            
            //header('Location: admin/');
            
        }*/
        
        

        
        $check = $access->prepare('SELECT prenom, nom, email, password, id FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur landing.php
                    clean_php_session();
                    session_start();
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    //$_SESSION['user'] = $data['token'];
                    $_SESSION['email'] = $email;
                    
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['id'] = $data['id'];
                    var_dump($data['id']);
                    var_dump($_SESSION['id']);
                    if($_SESSION['id'] == 1){
                       header('Location: admin/dashboard.php');
                    } else {
                        header('Location: index.php');
                    }
                    
                    die();
                }else{ header('Location: login.php?login_err=password'); die(); }
            }else{ header('Location: login.php?login_err=email'); die(); echo "Mail inconnue";}
        }else{ header('Location: login.php?login_err=unknown-user');echo "Mail inconnue";  die();}
    }else{ header('Location: login.php'); die();} // si le formulaire est envoyé sans aucune données

}

?>