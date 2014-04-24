<?php
/**
 * constructeur de classe AMAPIEN
 */
class Amapien {
    public
    $title       = "Nouvel Amapien",
    $coord       = "Coordonnées",
    $name        = "",
    $surname     = "",
    $email       = "",
    $add         = "+",
    $addTitle    = "Ajouter un contact",
    $address     = "",
    $zipcode     = "",
    $city        = "",
    $phone       = "",
    $arrived     = "",
    $defaultname    = "nom",
    $defaultsurname = "prénom",
    $defaultemail   = "email",
    $defaultaddress = 'adresse',
    $defaultzipcode = 'code postal',
    $defaultcity    = 'ville',
    $defaultphone   = 'téléphone',
    $defaultarrived = 'date d\'arrivée',
    $active      = 'Inscript',
    $updated     = 'À jour',
    $infos       = 'Infos supplémentaires',
    $submitTitle = 'Ajouter cet amapien',
    $submit      = "Et Hop! un nouvel Amapien!",
    $action      = "";
    public function __construct($data){
        //print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = array("method"=>"insert", "table"=>"amapien");
            } else if ($data['mode'] == 'edit'){
              //print_r($data);
                $this->title     = "Modifier l'amapien";
                $this->name      = $data['content']->name;
                $this->surname   = $data['content']->surname;
                $this->address   = $data['content']->address;
                $this->zipcode   = $data['content']->zipcode;
                $this->city      = $data['content']->city;
                $this->phone     = $data['content']->phone;
                $this->arrived   = $data['content']->arrived;
                $this->active    = $data['content']->active;
                $this->updated   = $data['content']->updated;
                $this->infosContent = $data['content']->infos;
                $this->email1   = $data['content']->email1;
                $this->email2   = $data['content']->email2;
                $this->email3   = $data['content']->email3;
                $this->action = array("method"=>"edit", "table"=>"amapien");
                $this->submit = "Te voilà différent!";
            } else if ($data['mode'] == 'delete') {
                $this->title  = "Supprimer l'amapien";
                $this->name = $data['content']->name;
                $this->surname = $data['content']->surname;
                $this->address   = $data['content']->address;
                $this->zipcode   = $data['content']->zipcode;
                $this->city   = $data['content']->city;
                $this->phone  = $data['content']->phone;
                $this->arrived   = $data['content']->arrived;
                $this->active  = $data['content']->active;
                $this->updated   = $data['content']->updated;
                $this->infosContent   = $data['content']->infos;
                $this->email1   = $data['content']->email1;
                $this->email2   = $data['content']->email2;
                $this->email3   = $data['content']->email3;
                $this->action = "raptor.php?delete=amapien";
                $this->submit = "Hors de ma vue, disparait!";
            } else {
                $this->action = "toto";
                // Par défaut
            }
        }
    }
}
?>
