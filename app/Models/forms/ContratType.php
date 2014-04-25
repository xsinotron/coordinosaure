<?php
/**
 * constructeur de classe CONTRAT
 */
class ContratType {
    public
    $action,
    $legend = "Informations générales",
    $labelContrat = "Nom du contrat",
    $labelProducteur = "Choisissez un producteur",
    $labelProduit = "nombre de produits",
    $nbProd = array(),
    $nb_distrib,
    $lNb_distrib = "Nombre de distribution",
    $pNb_distrib = "0",
    $tNb_distrib = "Nombre de semaines de distributions",
    $id,
    $name,
    $debut,
    $fin,
    $producteur_id,
    $produit_type_id = array(),
    $submit          = "Voici un beau contrat!";
    
    public function __construct($data){
      //print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = array("method"=>"insert", "table"=>"contrat_type");
            } else if ($data['mode'] == 'edit'){
                $this->action = array("method"=>"edit", "table"=>"contrat_type");
                $this->submit = "un beau contrat tout neuf";
            } else if ($data['mode'] == 'delete') {
                $this->action = array("method"=>"delete", "table"=>"contrat_type");
                $this->submit = "va-t-en!";
            } else {
                // Par défaut
            }
        }
        if(isset($data['producteurs'])) {
            $this->producteurs = $data['producteurs'];
        }
        for ($i = 1; $i < 13; $i++) $this->nbProd[] = ($i < 10) ? "0".$i : $i;
        
    }
}
?>
