<?php
    /**
     * 
     */
     class Produits {
         public
         $list = array();
         protected
         function getList($data) {
             foreach ($data as $produit) {
                 $this->list[] = $produit;
             }
         }
         function __construct($data) {
             $this->getList($data);
         }
     }
     
?>