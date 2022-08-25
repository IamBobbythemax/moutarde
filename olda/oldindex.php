<?php 
    require("header.php");
    
    


    $produits=afficher();

?>






        <!--Section Principal-->
        <section class="main">
            <div class="cards">
                <?php foreach($produits as $produit):?>
                    <div class="card">
                        <img src="<?= $produit->image?>" class="image-card">
                        <div class="card-header">
                            <h4 class="title"><?= $produit->nom?></h4>
                            <h4 class="price"><?= number_format($produit->prix,2); ?>€</h4>
                        </div>
                        <div class="card-body">
                            <small><?= substr($produit->description, 0, 200) ?></small>
                            <div class="button-fiche"> 
                                <button type="button" class="btndetail">Detail</button>
                                <button type="submit" class="btnpanier" name="apanier" href="addpanier.php?id=<?= $produit->id; ?>">Ajouter au panier</button>
                                
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </section>

       

        
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
    </body>
    <footer>

        <div class="contact">
            <p><i class="fa-solid fa-circle-envelope"></i></p>
            <p>Nom de l'entreprise</p>
            <p>Benjamin Müller</p>
            <p>@ : Easy
                utarde@gmail.com</p>
        </div>
    </footer>
</html>

<?php
    if(isset($_POST['apanier'])){
        header("addpanier.php?id=<?= $produit->id; ?>");
    }
?>