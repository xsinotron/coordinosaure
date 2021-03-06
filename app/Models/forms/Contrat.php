<?php
/**
 * constructeur de classe CONTRAT
 */
class Contrat {
    public
    $action = "",
    $legend = "Informations générales",
    $labelContrat = "Nom du contrat",
    $labelProducteur = "Choisissez un producteur",
    $labelProduit = "nombre de produits",
    $nbProd = array(),

    $id,
    $name,
    $debut,
    $fin,
    $producteur_id,
    $produit_type_id = array(),
    $submit      = "Voici un beau contrat!";
    
    public function __construct($data){
      //print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = "raptor.php?insert=contrat";
            } else if ($data['mode'] == 'edit'){
                $this->action = "raptor.php?edit=contrat";
                $this->submit = "un beau contrat tout neuf";
            } else if ($data['mode'] == 'delete') {
                $this->action = "raptor.php?delete=contrat";
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
