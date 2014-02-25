<?php
    /**
     * 
     */
     class Contrats {
         public
         $list = array();
         protected
         function getList($data) {
             foreach ($data as $contrat) {
                 $this->list[] = $contrat;
             }
         }
         function __construct($argument) {
             $this->getList($argument);
         }
     }
     
?>