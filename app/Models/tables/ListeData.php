<?php
    /**
     * 
     */
     class ListeData {
         public
         $list          = array(),
         $header_action = "Actions",
         $tModify = "Modifier les donn&eacute;es",
         $tDuplic = "Dupliquer les donn&eacute;es",
         $tDelete = "Supprimer les donn&eacute;es";
         /**
          * 
          */
         protected function getList($data) {
             foreach ($data as $elt) {
                 $this->list[] = $elt;
             }
         }
         /**
          * 
          */
         public function __construct($data) {
             $this->getList($data);
         }
     }
     
?>