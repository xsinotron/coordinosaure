<?php
    /**
     * 
     */
     class Producteurs {
         public
         $list = array();
         protected
         function getList($data) {
             foreach ($data as $producteur) {
                 $this->list[] = $producteur;
             }
         }
         function __construct($data) {
             $this->getList($data);
         }
     }
     
?>