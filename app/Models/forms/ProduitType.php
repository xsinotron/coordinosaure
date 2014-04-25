<?php
/**
 * constructeur de classe PRODUIT
 */
class ProduitType {
    public
    $action       = "",
    $legend       = "Informations générales",
    $name,
    $pName = "Nom du produit",
    $tName = "Donne un nom à ce produit du labeur",
    $contrat_id,
    $lContrat = "Contrat",
    $prix_unitaire,
    $lPrix_unitaire = "Prix unitaire",
    $pPrix_unitaire   = "0.00€",
    $tPrix_unitaire   = "Prix en euros",
    $id,
    $submit      = "Il est vraiment bien ce produit, je l'ajoute!";
    
    public function __construct($data){
        print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = array("method"=>"insert", "table"=>"produit_type");
            } else if ($data['mode'] == 'edit'){
                $this->action = array("method"=>"edit", "table"=>"produit_type");
                $this->submit = "un beau contrat tout neuf";
            } else if ($data['mode'] == 'delete') {
                $this->action = array("method"=>"delete", "table"=>"produit_type");
                $this->submit = "va-t-en!";
            } else {
                // Par défaut
            }
        }
        if(isset($data['contrats'])) {
            $this->contrats = $data['contrats'];
        }
        for ($i = 1; $i < 13; $i++) $this->nbProd[] = ($i < 10) ? "0".$i : $i;
        
    }
}
?>
