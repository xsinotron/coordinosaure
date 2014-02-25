<?php
/**
 * constructeur de classe AMAPIEN
 */
class Producteur {
    public
    $coord       = "Coordonnées",
    $name        = "nom",
    $surname     = "prénom",
    $email       = "email",
    $address     = 'adresse',
    $zipcode     = 'code postal',
    $city        = 'ville',
    $phone       = 'téléphone',
    $infos       = 'Infos supplémentaires',
    $submitTitle = 'Ajouter un producteur local',
    $submit      = "Et Hop! un nouveau Producteur!",
    $action      = "";
    public function __construct($data){
        //print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = "core.php?insert=producteur";
            } else if ($data['mode'] == 'edit'){
                $this->action = "core.php?edit=producteur";
                $this->submit = "Te voilà un Amapien différent";
            } else if ($data['mode'] == 'delete') {
                $this->action = "core.php?delete=producteur";
                $this->submit = "Hors de ma vue, disparait!";
            } else {
                // Par défaut
            }
        } 
    }
}
?>
