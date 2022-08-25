<?php 
    //include("index.php");
    require("config/commandes.php");


?>
<h1><?php 
$produits=afficher();


foreach($produits as $produit){ echo $produit->nom . " ,"; }?></h1>




<title><?php $produits[0]; ?></title>