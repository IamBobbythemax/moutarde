<?php 
session_start(); 

require "_header.php";


?>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5/13.0/css/all.css">
        <script src="https://kit.fontawesome.com/0196c3faae.js" crossorigin="anonymous"></script>
        
        
    </head>
    <body>
        

        <nav>
            <h1 class="logo"><a href="index.php">EasyFood</a></h1>
            <div class="search">
                    <form>
                        <input type="search" placeholder="Recherche">
                    </form>
                </div>
            <div class="onglets">
                
                <div class="bloc1">
                    <p class="link">Moutarde</p>
                    <p class="link">Demande spécial</p>
                    
                <?php 
                        
                      
                    if(isset($_SESSION['user'])) : ;
                      
                ?>
                    <p class="link">Bonjour </p>
                    <p class="prenom"><b><?= $_SESSION['prenom'];?> <?= $_SESSION['nom'];?></b></p>
                    <p>Panier</p>
                    <a href="panier.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
                </div>
                
                
                    
                    
                    
                       <form class="bloc2" method="post">
                            <button type="submit" class="btnnavred" name="deconnexion">Deconnexion</button>
                        </form>
                        

                <?php else:?> 

                <a href="login.php">
                    <button class="btnnav">Connexion</button>
                </a>

                <?php endif; ?>
                
                
                
            </div>


            <?php 
                if(isset($_POST['deconnexion']))
                {
                    clean_php_session();
                    header('Location: index.php');
                }
            ?>
            
                
            
        </nav>