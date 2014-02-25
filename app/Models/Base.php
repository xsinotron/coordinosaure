<?php
    /**
     * class Base
     */
     class Base {
         public
         $version;
         protected function getMainMenu () {
             
         }
         function __construct($data) {
             if (gettype($data) == 'array') {
                 $this->version = $data['version'];
             }
         }
     }
     
?>