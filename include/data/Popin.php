<?php
/**
 * 
 */
class Popin {
    public
    $close        = 'X',
    $closeInfos   = 'Fermer le formulaire sans sauvegarder';
	function __construct($data) {
        $this->title   = $data['title'];
        $this->content = $data['content'];
	}
}

?>