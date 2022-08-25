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
                                <button  type="button" class="btndetail">Detail</button>
                                <button onclick="monalert()" type="submit" class="btnpanier" name="apanier" href="addpanier.php?id=<?= $produit->id; ?>">Ajouter au panier</button>      
                            </div>
                            <script>
                                function monalert() {
                                   
                                    //location.reload(true);
                                }
                            </script>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </section>

       

        
       
        
    </body>
    <?php require("footer.php");?>