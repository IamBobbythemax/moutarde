<?php
    require "_header.php";


    

?>
<?php
    
     

?>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/0196c3faae.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        
        
    </head>
    
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="index.php" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continuez vos achats</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <h4 class="mb-1">Panier d'achat</h4>
                    <p class="mb-0">Il y a <?= $panier->count();?> objets dans le panier</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>

                <?php
                    $ids = array_keys($_SESSION['panier']);
                    if(empty($ids)){
                        $produits = array();
                    } else {
                        
                        $req = $access->prepare('SELECT * FROM produits WHERE id IN(' . implode(', ', array_map(array($access, 'quote'), $ids)) . ')');
                        $req->execute();
                        $produits =  $req->fetchAll(PDO::FETCH_OBJ);
                        
                    }      
                    foreach($produits as $produit):
                ?>


                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img src=<?= $produit->image?> style="width: 50px;">
                        </div>
                        <div class="ms-3">
                          <h5 class="mb-0"><?= $produit->nom; ?></h5>
                          <p class="small mb-0"></p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 80px;">
                          <h5 class="mb-0"><?= $_SESSION['panier'][$produit->id];?></h5>
                        </div>
                       
                        <input class="moninput" type="number" value="<?= $_SESSION['panier'][$produit->id];?>" min="0" max="100"/>
                       
                        <div style="width: 80px;">
                          <h5 class="mb-0"><?= number_format($produit->prix,2); ?>€</h5>
                        </div>
                        <a href="panier.php?delPanier=<?= $produit->id; ?>" style="color: #cecece;"><i src="images/trash-can-solid.svg"class="fa-solid fa-trash-can"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                    endforeach;

                ?>


                

                






                

              </div>
              <div class="col-lg-5">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                        class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                    </div>

                    <p class="small mb-2">Card type</p>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                    <form class="mt-4">
                      <div class="form-outline form-white mb-4">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2">$20.00</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2"><?= number_format($panier->total(),2 );  ?>€</p>
                    </div>

                    <button type="button" class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <!--<span><?= number_format($panier->total(),2 ); ?>€ </span>-->
                        <span> Payer <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>

                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
            