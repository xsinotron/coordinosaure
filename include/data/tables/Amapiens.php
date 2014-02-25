<?php
    /**
     * 
     */
     class Amapiens {
         public
         $list = array();
         protected
         function getList($data) {
             foreach ($data as $amapien) {
                 $this->list[] = $amapien;
             }
         }
         function __construct($argument) {
             $this->getList($argument);
         }
     }
     
?>