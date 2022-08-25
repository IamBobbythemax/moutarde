<?php


class panier{
    
    private $access;

    public function __construct($access){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();//creation panier vide
        }
        $this->access = $access;
        if(isset($_GET['delPanier'])){
            $this->del($_GET['delPanier']);
        }


    }
    
    public function total(){
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if(empty($ids)){
            $produits = array();
        } else {
            
            $req = $this->access->prepare('SELECT * FROM produits WHERE id IN(' . implode(', ', array_map(array($this->access, 'quote'), $ids)) . ')');
            $req->execute();
            $produits =  $req->fetchAll(PDO::FETCH_OBJ);
            
        }

        foreach( $produits as $produit){
             $total += $produit->prix * $_SESSION['panier'][$produit->id];
        }
        return $total;
    }

    public function count(){
        return array_sum($_SESSION['panier']);
    }


    public function add($produit_id){
        if(isset($_SESSION['panier'][$produit_id])){
            $_SESSION['panier'][$produit_id]++;
        } else {
            $_SESSION['panier'][$produit_id] = 1;
        }
        
    }
    public function del($produit_id){
        unset($_SESSION['panier'][$produit_id]);
    }


    

    /*public function query($sql, $data = array()){
        $req = $access->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
      }*/
     




}


?>