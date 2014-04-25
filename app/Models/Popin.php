<?php
/**
 * 
 */
class Popin {
    public
    $close        = 'X',
    $closeInfos   = 'Fermer le formulaire sans sauvegarder';
	function __construct($data) {
        //print_r($data);
        $this->title   = $data['title'];
        $this->content = $data['content'];
        if ($data["mode"] === "edit")   $this->mode = "bg-success";
        if ($data["mode"] === "delete") $this->mode = "bg-danger";
        if ($data["mode"] === "new")    $this->mode = "bg-primary";
	}
}

?>