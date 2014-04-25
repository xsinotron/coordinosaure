<?php
/**
 * constructeur de classe AMAPIEN
 */
class Producteur {
    public
    $coord    = "Coordonnées",
    $name,
    $pName    = "nom",
    $surname,
    $pSurname = "prénom",
    $email,
    $pEmail   = "email",
    $address,
    $pAddress = 'adresse',
    $zipcode,
    $pZipcode = 'code postal',
    $city,
    $pCity    = 'ville',
    $phone,
    $pPhone   = 'téléphone',
    $infos    = 'Infos supplémentaires',
    $submit   = "Et Hop! un nouveau Producteur!",
    $tSubmit  = 'Ajouter un producteur local',
    $action   = "";
    public function __construct($data){
        //print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = array("method"=>"insert", "table"=>"producteur");
            } else if ($data['mode'] == 'edit'){
                $this->action = array("method"=>"edit", "table"=>"producteur");
                $this->submit = "Te voilà un Amapien différent";
            } else if ($data['mode'] == 'delete') {
                $this->action = array("method"=>"delete", "table"=>"producteur");
                $this->submit = "Hors de ma vue, disparait!";
            } else {
                // Par défaut
            }
        } 
    }
}
?>
