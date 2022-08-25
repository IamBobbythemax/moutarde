<?php 
require "_header.php";
$json = array('error' => false);
if(isset($_GET['id'])){

    $req = $access->prepare('SELECT id FROM produits WHERE id=:id');
    $data = array('id' => $_GET['id']);
    $req->execute($data);
    $produit = $req->fetchAll(PDO::FETCH_OBJ);

    if(empty($produit)){
        $json['message'] = ("Ce produit n'existe pas");
    }
    $panier->add($produit[0]->id);
    
    //$json['error'] = false;
    //$json['message'] = ('le produit a été ajouté au panier <a href="javascript:history.back()">Retourner au catalogue</a>');

} else {
    //$json['message'] = ("Pas de produits dans le panier");
}
echo json_encode($json);


?>